<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewMail;
use App\Mail\NewMail;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PanelBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('AuthTypeCheck:admin,editor');
    }

    public function getallbrands(){
        $count = Brands::count();
        $brands = Brands::paginate(16);
        return view('adminpanel/allbrands',compact('brands','count'));
    }

    public function BrandEdit(Brands $id){
        return view('adminpanel/updates/brand-edit',['brand' => $id]);
    }

    public function BrandAddPage()
    {
        $brands = Brands::all();
        return view('adminpanel/updates/addbrand')->with('brands', $brands);
    }

    public function BrandAdd(request $request)
    {
        $request->validate([
            'brand' => ['required', 'string', 'regex:/^[a-zA-Z]{1}/', Rule::unique('brands', 'brand')],
            'file' => ['required', 'max:10000'],
            'content'=>['required','string']
        ]);
        $img = $request['brand'] . '-' . uniqid() . '.png';

        $brands = new Brands();
        $brands->brand = $request['brand'];
        $brands->logo = $img;
        $brands->content = $request['content'];
        $brands->save();

        $imgData = Image::make($request->file('file'))->encode('png');
        Storage::put('public/brandlogos/' . $img, $imgData);
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$brands->brand} adlı yeni Marka Oluşturdu ");


        //dispatch(New SendNewMail(['SendTo'=>'altaybaykall@gmail.com','user_name'=> auth::user()->user_name]));
        return redirect('/getallbrand')->with('Update', 'Yeni Marka eklendi');
    }

    public  function  BrandEditSave(request $request){
        $request->validate([
            'brand' => ['required', 'string', 'regex:/^[a-zA-Z]{1}/'],
            'file' => ['required', 'max:10000'],
            'content'=>['required','string']
        ]);
        $img = $request['brand'] . '-' . uniqid() . '.png';

        $brand = $request->id;
        $brands = Brands::where('id', $brand)->firstorfail();


        $oldimage = $brands->logo;
        $brands->brand = $request['brand'];
        $brands->logo = $img;
        $brands->content = $request['content'];
        $brands->save();
        if ($oldimage !== "'images/bmw-logo.png'") {
            Storage::delete(str_replace("/storage", "/public", $oldimage));
            $imgData = Image::make($request->file('file'))->encode('png');
            Storage::put('/public/brandlogos/' . $img, $imgData);
        }
        return redirect('/getallbrand')->with('Update', 'Marka Düzenlendi');

    }
    public function BrandDelete(request $request)
    {
        $brand = $request->id;
        $brands = Brands::where('id', $brand)->firstorfail();
        $oldimage = $brands->logo;
        if ($oldimage !== "'images/bmw-logo.png'") {
            Storage::delete(str_replace("/storage", "/public", $oldimage));
        }
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$brands->brand} adlı markayı sildi ");
        Cache::forget($brands->brand);
        $brands->delete();
        return redirect('/getallbrand')->with('Update', 'Marka Silindi');
    }



}
