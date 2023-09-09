<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\CarComments;
use App\Models\Cars;
use App\Models\News;
use App\Models\NewsComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


class NewsController extends Controller
{

    public function NewsPage()
    {
        $news = News::with('getauthor')->OrderBy('created_at', 'DESC')->simplePaginate(10);
        $trendnews = News::select('id','title','image')->OrderBy('reads', 'DESC')->get()->take(1);
        $latest = Cache::remember('latestnews', 600, function () {
            return News::select('id','title','image','created_at')->OrderBy('created_at', 'DESC')->get()->take(5);
        });
        return view('news/news-index',compact('news','trendnews','latest'));

    }

    public function NewsBrand($marka)
    {
        if (!Brands::where('brand', $marka)->exists()) {
            return redirect('/');
        }
        $news = News::with('getauthor')->OrderBy('created_at', 'DESC')->where('brand', $marka)->paginate(10);
        $brands = Brands::where('brand', $marka)->FirstorFail();
        $trendnews = News::select('id','title','image')->OrderBy('reads', 'DESC')->get()->take(1);
        $latestnews = Cache::remember('latestnews', 600, function () {
            return News::select('id','title','image','created_at')->OrderBy('created_at', 'DESC')->get()->take(5);
        });
        return view('news/news-brand-index')->with('news', $news)->with('trendnews', $trendnews)->with('latest', $latestnews)->with('Brands', $brands);
    }

    public function NewsDetail($id)
    {
        if (!News::where('id', $id)->exists()) {
            return redirect('/');
        }
        $news = News::where('id', $id)->First();
        $othernew = News::OrderBy('reads', 'DESC')->get()->take(5);
        $latest = Cache::remember('latestnews', 600, function () {
            return News::OrderBy('created_at', 'DESC')->get()->take(5);
        });
        $comments = NewsComments::with('commentby')->where('news_id',$id)->get();
        $news->reads++;
        $news->save();
        return view('news/single-news',compact('news','othernew','latest','comments'));
    }

    public function NewsEdit(News $news)
    {
        $response = Gate::inspect('update', $news);
        if ($response->allowed()) {
            $brands = Brands::all();
            return view('news/edit-news', ['news' => $news])->with('brands', $brands);
        }
        return back();
    }

    public function NewsEditSave(request $request)
    {
        $id = $request->id;
        $request->validate([
            'title' => 'required', 'string',
            'contentt' => 'string',
            'file' => ['nullable', 'max:10000'],
            'brand_name' => ['nullable', 'string'],
        ]);
        $user = Auth::user();
        if ($request->has('file')) {
            $titlecut = substr($request->title, 0, 10);
            $img = $titlecut . '-' . uniqid() . '.png';
            $imgData = Image::make($request->file('file'))->encode('png');
        }
        $news = News::where('id', $id)->FirstOrFail();
        $news->title = $request->title;
        $news->content = $request->contentt;
        $news->brand = $request->brand_name;
        if ($request->has('file')) {
            $news->image = $img;
            Storage::put('public/news/' . $img, $imgData);
        }
        $news->save();
        Log::channel('custom')->info(Auth::user()->user_name . " adlı kullanıcı  {$news->title}  Haberini Düzenledi");
        return redirect('/haber/' . $news->id)->with('update', 'Haber Düzenlemesi Kaydedildi');
    }

    public function DeleteNew($id)
    {
        $news = News::where('id', $id)->FirstorFail();
        $oldimage = $news->image;
        if ($oldimage !== "'images/600.jpg'") {
            Storage::delete(str_replace("/storage", "/public", $oldimage));
        }
        Log::channel('custom')->info(Auth::user()->user_name . " adlı kullanıcı  {$news->title}  Haberini sildi ");
        $news->delete();
        $newss = Cache::forget('news');
        Cache::forget('latestnews');
        Cache::forget('news');
        return redirect('/haberler')->with('update', 'Haber Silindi');
    }


    public function NewCommentSave(request $request)
    {
        $user = Auth::user();
        $nid = $request->id;
        $request->validate([
            'comment' => 'required', 'max:255', 'string', 'min:1'
        ]);
        $spamchecker = NewsComments::where('user_id', $user->id)
            ->whereBetween('created_at', [Carbon::now()->subMinutes(1)->toDateTimeString(), Carbon::now()])
            ->count();
        if ($spamchecker >= 2) {
            return back()->with('error', 'Spam yapma :)');
        }
        $comment = strip_tags($request['comment']);
        $ncom = new NewsComments();
        $ncomsave = $ncom->create([
            'comment' => $comment,
            'user_id' => $user['id'],
            'news_id' => $nid
        ]);
        return back();
    }

    public function DeleteComment(request $request, NewsComments $NewsComments)
    {
        if ($request->user()->cannot('update', $NewsComments)) {
            abort(404);
        }
        $NewsComments->delete();
        Log::channel('custom')->info(Auth::user()->user_name . " adlı kullanıcı  {$NewsComments->commentby->user_name} Kişisinin Yorumunu {$NewsComments->commentto->id} id haberinden sildi ");
        return back();
    }

    public function search($term)
    {
        $news = News::search($term)->get();
        $news->load('getauthor:id,email,user_name,avatar');
        return $news;
    }

}
