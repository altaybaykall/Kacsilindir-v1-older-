<?php

namespace App\Http\Controllers;

use App\Events\PanelEvent;
use App\Models\Brands;
use App\Models\Cars;
use App\Models\Dimensions;
use App\Models\Economy;
use App\Models\Engines;
use App\Models\News;
use App\Models\NotList;
use App\Models\shetabit_visitt;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Shetabit\Visitor\Traits\Visitor;


class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('AuthTypeCheck:admin,editor');
    }

    public function Dashboard()
    {

        $online = User::online()->count();
        $users = User::count();
        $cars = Cars::count();
        $news = News::count();
        $list = ToDoList::all();
       $visit = shetabit_visitt::whereBetween('created_at', [Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()])->select('ip')->distinct()->get()->count();
       $lastvisit = shetabit_visitt::OrderBy('created_at','DESC')->where('visitor_id',Auth::user()->id)->take(3)->get();
        $previousVisit = null;
        if ($lastvisit->count() > 2) {
            $previousVisit = $lastvisit[2];
        }

        $notlist = NotList::where('user_id',Auth::user()->id)->get();
        visitor()->visit();
       $cardate = Cars::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
       $newsdate = News::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count();
        $newuser = User::whereBetween('created_at', [Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()])->count();
        $admins = User::whereIn('type', ['admin', 'editor'])->get();
        return view('adminpanel/fullauthpage', compact('news', 'cars', 'users', 'cardate','newsdate','newuser','admins','list','notlist','visit','online','previousVisit'
       ));
    }

    public function NewsAddPage()
    {

        $brands = Brands::all();
        return view('adminpanel/updates/addnews',compact('brands'));
    }
    public  function getallnews(){
        $count = News::count();
        $news = News::withCount('comments')->With('getauthor')->paginate(16);
        return view('adminpanel/allnews',compact('news','count'));
    }
    public  function  GetAllModels () {
        $carscount = Cars::count();
        $cars = Cars::paginate(16);
        return view('adminpanel/allmodels',compact('cars','carscount'));
    }


    public function ModelAddPage()
    {
        $brands = Brands::all();
        return view('adminpanel/updates/addmodel')->with('brands', $brands);
    }




    public function NewsAdd(request $request)
    {
        $request->validate([
            'title' => 'required', 'string','max:75',
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

        $news = new News();
        $news->title = $request->title;
        $news->author_id = $user->id;
        $news->content = $request->contentt;
        $news->brand = $request->brand_name;
        if ($request->has('file')) {
            $news->image = $img;
            Storage::put('public/news/' . $img, $imgData);
        }
        $news->save();
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$news->title}  Haberini Oluşturdu ");
        return redirect('/haber/' . $news->id)->with('update', 'Yeni Haber Başarıyla Oluşturuldu ( Haberin Akışa düşmesi 5dkyı bulabilir)');
    }


    public function ModelAdd(request $request)
    {
        $request->validate([
            'brand_name' => ['required', 'string'],
            'model_name' => ['required', 'string'],
            'model_spec' => ['required', 'string'],
            'production_year' => ['required', 'date_format:Y'],
            'file' => ['required', 'max:10000'],

            'fuel_type' => ['required', 'string'],
            'torque' => ['required', 'numeric'],
            'horse_power' => ['required', 'numeric'],
            'cylinders' => ['required', 'numeric'],
            'engine_size' => ['required', 'nullable'],
            'drivetrain' => ['required', 'string'],
            'transmission' => ['required', 'string'],
            'hundred_sec' => ['required', 'numeric'],
            'top_speed' => ['required', 'numeric'],

            'body_type' => ['required', 'string'],
            'door_num' => ['required', 'numeric'],
            'seat_num' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'width' => ['required', 'numeric'],
            'lenght' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
            'trunk_cap' => ['required', 'numeric'],
            'fuel_cons_avg' => ['required', 'numeric'],
            'fuel_cons_ic' => ['required', 'nullable', 'numeric'],
            'fuel_cons_oc' => ['required', 'nullable', 'numeric'],
            'fuel_tank' => ['required', 'numeric'],
            'range' => ['required', 'numeric'],
            'emission' => ['required', 'numeric']

        ]);


        $img = $request['model_name'] . '-' . $request['model_spec'] . '-' . uniqid() . '.png';

        $modelName = trim($request->model_name);
        $modelName = str_replace(' ', '-', $modelName);
        $request->merge(['model_name' => $modelName]);


        $cardata = [
            'brand_name' => $request['brand_name'],
            'model_name' => $request['model_name'],
            'model_spec' => $request['model_spec'],
            'production_year' => $request['production_year'],
            'picture' => $img,
        ];
        $createcar = Cars::create($cardata);

        $imgData = Image::make($request->file('file'))->encode('png')->resize('300', '300', function ($constraint) {
            $constraint->aspectRatio();
        })
            ->resizeCanvas(300, 300);
        Storage::put('public/carimages/' . $img, $imgData);


        $engine = $createcar->GetEngine()->create([
            'engine_id' => $createcar['model_id'],
            'fuel_type' => $request['fuel_type'],
            'torque' => $request['torque'],
            'horse_power' => $request['horse_power'],
            'cylinders' => $request['cylinders'],
            'engine_size' => $request['engine_size'],
            'drivetrain' => $request['drivetrain'],
            'transmission' => $request['transmission'],
            'hundred_sec' => $request['hundred_sec'],
            'top_speed' => $request['top_speed']
        ]);


        $dimension = $createcar->GetDimension()->create([
            'dimension_id' => $createcar['model_id'],
            'body_type' => $request['body_type'],
            'door_num' => $request['door_num'],
            'seat_num' => $request['seat_num'],
            'height' => $request['height'],
            'width' => $request['width'],
            'lenght' => $request['lenght'],
            'weight' => $request['weight'],
            'trunk_cap' => $request['trunk_cap']


        ]);

        $economy = $createcar->GetEconomy()->create([
            'economy_id' => $createcar['model_id'],
            'fuel_cons_avg' => $request['fuel_cons_avg'],
            'fuel_cons_ic' => $request['fuel_cons_ic'],
            'fuel_cons_oc' => $request['fuel_cons_oc'],
            'fuel_tank' => $request['fuel_tank'],
            'range' => $request['range'],
            'emission' => $request['emission'],

        ]);
        event(new PanelEvent(['car'=>  $createcar , 'action' => 'adlı Yeni Araba Oluşturdu']));
        return redirect('/'.$createcar->brand_name.'/'.$createcar->model_name.'/'.$createcar->model_id)->with('Update', 'Yeni Model Eklendi ');
    }

    public function ModelEdit(Cars $id) {

        $brands = Brands::all();
        return view('cars/car-edit',['cars' => $id])->with('brands', $brands);
    }

 public function ModelEditSave(request $request) {
     $id = $request->id ;


     $img = $request['model_name'] . '-' . $request['model_spec'] . '-' . uniqid() . '.png';
     if ($request->has('file')) {
         $imgData = Image::make($request->file('file'))->encode('png')->resize('300', '300', function ($constraint) {
             $constraint->aspectRatio();
         })
             ->resizeCanvas(300, 300);
     }

     $createcar = Cars::where('model_id',$id)->FirstOrFail();

     $createcar-> brand_name = $request['brand_name'];
       $createcar->  model_name = $request['model_name'];
        $createcar-> model_spec = $request['model_spec'];
        $createcar-> production_year = $request['production_year'];

         if ($request->has('file')) {
             $createcar->picture = $img;
             Storage::put('public/carimages/'.$img,$imgData);
         }
     $createcar->save();



     $engine = $createcar->GetEngine()->update([
         'engine_id' => $createcar['model_id'],
         'fuel_type' => $request['fuel_type'],
         'torque' => $request['torque'],
         'horse_power' => $request['horse_power'],
         'cylinders' => $request['cylinders'],
         'engine_size' => $request['engine_size'],
         'drivetrain' => $request['drivetrain'],
         'transmission' => $request['transmission'],
         'hundred_sec' => $request['hundred_sec'],
         'top_speed' => $request['top_speed']
     ]);


     $dimension = $createcar->GetDimension()->update([
         'dimension_id' => $createcar['model_id'],
         'body_type' => $request['body_type'],
         'door_num' => $request['door_num'],
         'seat_num' => $request['seat_num'],
         'height' => $request['height'],
         'width' => $request['width'],
         'lenght' => $request['lenght'],
         'weight' => $request['weight'],
         'trunk_cap' => $request['trunk_cap']


     ]);

     $economy = $createcar->GetEconomy()->update([
         'economy_id' => $createcar['model_id'],
         'fuel_cons_avg' => $request['fuel_cons_avg'],
         'fuel_cons_ic' => $request['fuel_cons_ic'],
         'fuel_cons_oc' => $request['fuel_cons_oc'],
         'fuel_tank' => $request['fuel_tank'],
         'range' => $request['range'],
         'emission' => $request['emission'],

     ]);
     event(new PanelEvent(['car'=>  $createcar , 'action' => ' Düzenledi']));
     return back()->with('update','Model Güncellendi');
    }

    public function DeleteModel($id){
        $car =  Cars::where('model_id',$id)->FirstorFail();
        $oldimage = $car->picture;
        if ($oldimage !== "'images/600.jpg'") {
            Storage::delete(str_replace("/storage","/public", $oldimage));
        }
        $brand=  $car->brand_name;
        event(new PanelEvent(['car'=>  $car , 'action' => ' Aracını Sildi']));
        $car->delete();
        return redirect('/'.$brand)->with('update','Model Silindi');
    }


   public function AddToDoList(request $request){
      $request->validate([
          'content' => 'required',
      ]);
    $newlist = new  ToDoList();
      $newlist->content = $request['content'];
      $newlist->user_id = Auth::user()->id ;
      $newlist->save();
 return back();
}

 public  function AddNotList (request $request) {
     $request->validate([
         'content' => 'required',
     ]);
     $newlist = new  NotList();
     $newlist->content = $request['content'];
     $newlist->user_id = Auth::user()->id;
     $newlist->save();
     return back();
 }

   public  function DeleteToDoList(ToDoList $id) {
     $id->delete();
     return redirect('/dashboard');
   }
    public  function DeleteNotList(NotList $id) {
        $id->delete();
        return redirect('/dashboard');
    }
}
