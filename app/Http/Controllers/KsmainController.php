<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Brands;
use App\Models\Cars;
use App\Models\Economy;
use App\Models\Engines;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class KsmainController extends Controller
{


    public function homepage(request $request)
    {

     CACHE::flush('latestnews');
        $brands = Cache::remember('homebrands',30000 ,function (){
         return Brands::Orderby('created_at','ASC')->take(19)->get();
     });
        $latestnews = Cache::remember('latestnews', 600, function () {
            return News::select('id','title','image','created_at')->OrderBy('created_at', 'DESC')->get()->take(5);
        });
        $compare = Cars::select('model_id','model_spec','model_name','brand_name','picture')->InRandomOrder()->take(8)->get();
        $cars = Cars::InRandomOrder()->take(8)->get();
        return view('homepage', compact( 'latestnews','brands','compare','cars'));

    }
    public  function  AllBrands() {
       $brands= Brands::OrderBy('brand','ASC')->get();
        return view('cars/allbrands',compact('brands'));
    }

    public function aboutus()
    {
        return view('components/aboutus');
    }



    public function FastestCar()
    {

        $car = Engines::with(['getCarEngine' => function($query) {
            return $query->select('model_id','model_name','model_spec','brand_name','picture');
        }])->OrderBy('top_speed','DESC')->select('engine_id','top_speed')->Paginate(10);
        return view('cars/stat-comp/fastest-cars',compact('car'));
    }
    public function SlowestCar()
    {

        $car = Engines::with(['getCarEngine'])->OrderBy('hundred_sec','DESC')->select('engine_id','hundred_sec')->Paginate(10);
        return view('cars/stat-comp/slowest-cars',compact('car'));
    }

     public  function RandomCar() {
        $car = Cars::inRandomOrder()->first();
        $brand = $car->brand_name;
        $model = $car->model_name;
        $id = $car->model_id;

        return redirect('/'.$brand.'/'.$model.'/'.$id);

     }
    public function FuelCar()
    {

        $car = Economy::with(['getCarEconomy','getEconomyEngine' => function($query) {
            return $query->select('fuel_type');
        }])->select('economy_id','fuel_cons_avg')->whereHas('getEconomyEngine', function ($query) {
            $query->whereNot('fuel_type', 'Elektrik');
        })
            ->orderBy('fuel_cons_avg', 'DESC')
            ->paginate(10);
        return view('cars/stat-comp/fuel-cons',compact('car'));
    }
    public function FuelLowCar()
    {

        $car = Economy::with(['getCarEconomy','getEconomyEngine'=> function($query) {
            return $query->select('fuel_type');
        }])->select('economy_id','fuel_cons_avg')->whereHas('getEconomyEngine', function ($query) {
            $query->whereNot('fuel_type', 'Elektrik');
        })
            ->orderBy('fuel_cons_avg', 'ASC')->whereNot('fuel_cons_avg','==','0')
            ->paginate(10);
        return view('cars/stat-comp/fuel-low',compact('car'));
    }
    public  function ElectricCar() {
        $car = Engines::with(['getCarEngine'])->where('fuel_type','elektrik')->paginate(10);
        return view('cars/stat-comp/electric-cars',compact('car'));
    }

    public  function Fuelcalc(){

        $information = Helper::getfuelprice();
        $istanbulbenzin = $information['istanbulbenzin'];
        $istanbuldizel = $information['istanbuldizel'];


        return view('cars/stat-comp/calculator',compact('istanbulbenzin','istanbuldizel'));
    }
}
