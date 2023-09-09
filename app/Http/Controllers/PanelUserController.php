<?php

namespace App\Http\Controllers;


use App\Models\CarsComments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class PanelUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('AuthTypeCheck:admin')->except('GetAllUsers');
    }
    public function UserEdit(User $id) {

       if ($id->type !=='admin') {
           return view('adminpanel/updates/user-edit', ['user' => $id]);
       }
       return back();
    }
    public function AvatarDelete($id) {
        $user = User::Where('id',$id)->First();
        $oldAvatar =$user->avatar;
        $user->update(['avatar' => '']);

        if ($oldAvatar !="/images/profileiconblack.png") {
            Storage::delete(str_replace("/storage","/public", $oldAvatar));
        }
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$user->user_name} Kişisinin Avatarını Sildi ");

        return redirect('/getallusers')->with('Update', $user->user_name.' Adlı Kullanıcının Avatarı Silindi');
    }
    public function UserEditSave(request $request) {
       $kid = $request->id ;

       $request->validate([
           'user_name'=>[ 'string', 'min:4', 'max:10'],
           'email'=>'email', 'max:255', 'unique:users'
       ]) ;

        $user = User::Where('id',$kid)->FirstorFail();
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->save();
        Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$user->user_name} Kişisinin Bilgilerini Düzenledi ");
        return redirect('/getallusers')->with('Update', $user->user_name.' Adlı Kullanıcı Düzenlendi');
    }
    public function GetAllUsers() {
        $count = User::count();
        $users = User::orderby('type','asc')->paginate(16);
        return view ('adminpanel/alluser',compact('users','count'));
    }
    public function UserDelete(User $id)
    {
        if($id->type !== 'admin' || $id->type !=='editor'){
            Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$id->user_name} Kişisini Sildi ");
            $id->delete();
        return redirect('/getallusers')->with('Update', 'Kullanıcı Silindi');
        }
        return back();
    }

    public function UserBan($id) {
        $user = User::where('id', $id)->first();

        if($user->type !== 'admin') {

            if($user->status == 0) {
            $user->status = '1' ;
            Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$user->user_name} Kişisini Banladı");

        }
        elseif($user->status == 1)  {
            $user->status = 0 ;
            Log::channel('custom')->info(Auth::user()->user_name." adlı kullanıcı  {$user->user_name} Kişisinin Banını kaldırdı");

        }
            $user->save();}
        return redirect('/getallusers')->with('Update', $user->user_name.' Adlı kullanıcının Yasaklama durumu değiştirildi');
    }

}
