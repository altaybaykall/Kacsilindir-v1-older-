<?php

namespace App\Http\Controllers;



use App\Models\CarComments;
use App\Models\CarFavorites;
use App\Models\Cars;
use App\Models\CompareList;
use App\Models\shetabit_visitt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Profile()
    {

        return view('auth/profilepage');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();


        return redirect('/')->with('logout', 'Çıkış Yapıldı');
    }

// KULLANICI ADI VE EMAIL DEGISTIRME
    public function UpdatePage()
    {
        return view('auth/updates/UpdateName');
    }

    public function EmailPage() {
        return view('auth/updates/UpdateEmail');
    }

    public function PasswordPage()
    {
        return view('auth/updates/UpdatePassword');
    }

    public function AvatarPage(){
        return view('auth/updates/UpdateAvatar');
    }
    public function ProfileUpdate(Request $request) //Kullanıcı Adı Değiştirme
    {

        $request->validate([
            'user_name' => ['required', 'string', 'min:4', 'max:10', Rule::unique('users', 'user_name')],
        ]);
        $user = Auth::user();
        $user->user_name = $request['user_name'];
        $user->update();
        return redirect('profile')->with('ProfileUpdate', 'Kullancı Adı Başarıyla Değiştirildi');
    }

    public function EmailUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required' ,'email', Rule::unique('users', 'email')],
        ]);
        $user = Auth::user();
        $user->update(['email' => ($request['email'])]);
        return redirect('profile')->with('ProfileUpdate', 'E-Posta Başarıyla Güncellendi');
    }


    public function UpdatePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([

            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'current_password' => ['required']
        ]);

        if(Hash::check($request->current_password , $user->password)) {
            if(!Hash::check($request->password , $user->password)) {
                $user->update(['password' => Hash::make($request['password'])
                ]);
                session()->flash('ProfileUpdate','Şifre Başarıyla Değiştirildi!');
                return redirect('/profile');
            }
            session()->flash('message','Yeni şifre Eski şifreyle aynı olamaz!');
            return redirect('/updatepassword');
        }
        session()->flash('message','Eski şifre doğru değil!');
        return redirect('/updatepassword');
    }

public function UpdateAvatar(request $request) {

        $request->validate([
            'file' => 'required|image|max:10000|mimes:png,jpg'
        ]);
    $user = Auth::user();
        $oldAvatar =$user->avatar;
         $data = $user->id.'-'.uniqid().'.png';
         $user->update(['avatar' => $data]);

        $imgData = Image::make($request->file('file'))->fit(80)->encode('png');
       Storage::put('public/avatars/'.$data,$imgData);

       if ($oldAvatar !="/images/profileiconblack.png") {
           Storage::delete(str_replace("/storage","/public", $oldAvatar));
       }
       return redirect('/profile')->with('ProfileUpdate', 'Avatar Başarıyla Güncellendi');
}
  public function NewFavorite($id) {
        $user = Auth::user();

       if (CarFavorites::where([['user_id','=',$user->id ] ,['model_id','=',$id]])->count() > 0 ) {
           return back()->with('update','Favorilerde zaten mevcut.');
       }
        $fav = new CarFavorites;
        $fav->user_id = $user->id;
        $fav->model_id = $id;
        $fav->save();
        return back()->with('favupdate','Favorilere eklendi.');
}


  public function Favorites() {
      $user = Auth::user();
      $fav = CarFavorites::where('user_id',$user->id)->get();
      return view('auth/favorites')->with('favs',$fav);
  }

  public  function DeleteFavorite($id) {
      $user = Auth::user();

      CarFavorites::where([['user_id','=',$user->id ] ,['model_id','=',$id]])->delete();
      return back();


}

}


