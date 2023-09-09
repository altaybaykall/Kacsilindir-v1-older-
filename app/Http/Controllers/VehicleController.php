<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\CarComments;
use App\Models\CarFavorites;
use App\Models\CarRating;
use App\Models\Cars;
use App\Models\CarsComments;
use App\Models\News;
use App\Models\NewsComments;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class VehicleController extends Controller
{



    public function VehicleRoute($brand)
    {
        $brands = Brands::where('brand', $brand)->First();
        if (!$brands) {
            return redirect('/');
        }
        $cars = Cars::select('model_name', 'picture', 'brand_name')
            ->where('brand_name', $brand)
            ->groupBy('model_name')
            ->get();

        return view('cars/car-datapage')->with('Brands', $brands)->with('model', $cars);
    }


    public function ModelRoute(request $request)
    {
     $model_name = $request->model_name;
     $brand = $request->brand;

        $models = Cars::where('model_name', $model_name)->where('brand_name', $brand)->get();
        if ($models->isEmpty()) {
            return redirect('/');
        }
        $brands =Brands::where('brand', $brand)->First();



        return view('cars/model-datapage')->with('brands', $brands)->with('models', $models)->with('brand',$model_name);
    }

    public function SpecRoute(request $request) {
        $model_name = $request->model_name;
        $brand = $request->brand;
        $id = $request->id;

        $cars = Cars::with(['getEconomy','getEngine','getDimension','getbrand'])->withCount('rating')->where('model_name',$model_name)->where('brand_name', $brand)->where('model_id',$id)->First();
        if (!$cars) {
            return redirect('/');
        }

        $models= Cars::select('model_name', 'picture', 'model_spec','brand_name','model_id')->where('model_name',$model_name)->InRandomOrder()->take(7)->get()->except($id);
        $latestmodels  = Cache::remember('latestmodels',1000,function()  {
            Return  Cars::orderby('created_at','desc')->take(12)->get();
        });
        $samebrand= Cars::where('brand_name',$cars->brand_name)->InRandomOrder()->take(12)->get();
        $comments = CarComments::with('commentvby')->where('model_id',$id)->get();
        return view('cars/spec-data',compact('cars','models','latestmodels','samebrand','comments'));
    }

    public  function  ModelCommentSave(request $request){
        $user = Auth::user();
        $nid = $request->id;
        $request->validate([
            'comment'=>'required','max:255','string','min:1'
        ]);

        $spamchecker = CarComments::where('user_id', $user->id)
            ->whereBetween('created_at', [Carbon::now()->subMinutes(1)->toDateTimeString(), Carbon::now()])
            ->count();

        if($spamchecker >= 2){
            return back()->with('error','Spam yapma :)');
        }
        $ncom = new CarComments();
        $ncomsave = $ncom->create([
            'comment'=>$request['comment'],
            'user_id'=>$user['id'],
            'model_id'=>$nid
        ]);

        return back();

    }

   public  function  CarRate (request $request) {
       $request->validate([
           'rating-1'=>'required','max:1'
       ]);

       if(CarRating::where([['user_id','=',Auth::user()->id ] ,['model_id','=',$request['id']]])->exists()  ) {
           return back()->with('rate','Tekrar Puan Veremezsin.');
       }

        $rate = new CarRating();
        $rate->user_id = Auth::user()->id;
        $rate->rate = $request['rating-1'];
        $rate->model_id = $request['id'];
        $rate->save();
        return back()->with('rate','Puan Verildi.');

   }


    public function DComment(request $request,CarComments $CarComments) {
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$CarComments->commentvby->user_name} Kişisinin Yorumunu {$CarComments->GetCarComments->model_id} id arabadan sildi ");
        $CarComments->delete();
        return back();
    }


}


