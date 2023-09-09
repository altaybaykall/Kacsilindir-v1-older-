<!DOCTYPE html>
<head>
    @vite(['resources/css/loginregister.css'])
</head>
@include('components/layout')
<div class="main-block-login">
<div class="container-main">
    <div class="container  py-sm-5 mt-1 mb-5">
        <div class="row align-items-center py-md-3 mb-4">
            <div class="login-motto col-lg-7 py-md-3 mb-3">
                <h2 class="display-4 p-0">Gir bakalım bizden misin </h2>
                <p class="lead text-muted">Arabalar kaçmıyor bekliyoruz</p>
            </div>
            <div class="col-lg-5 pl-md-5 pb-3 py-md-3">
                <img class="valid-logo"  src="/images/logosiyah.png">

                <form action="/login" method="POST" id="login-form">
                    @csrf
                    <p class="small  ">Giriş yapmak için bilgileriniz giriniz.</p>
                    @if (session()->has('AuthError'))
                            <div class="alert alert-danger text-enter bg-red">
                                {{session('AuthError')}}
                        </div>
                    @endif
                    <div class="form-group mb-2">
                        <label for="username-login" class="text-muted mb-0"><small>Kullanıcı adınız</small></label>
                        <input value="{{old('user_name')}}" name="loginusername" id="username-login" class="form-control" type="text" placeholder="Kullanıcı adı Giriniz" autocomplete="off" />
                        @error('user_name')
                        <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form">
                        <label for="password-login" class="text-muted mb-0"><small>Şifreniz</small></label>
                        <input name="loginpassword" id="password-login" class="form-control" type="password" placeholder="Şifrenizi Giriniz" />
                        @error('password')
                        <p class="p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
                    </div>
                    @if (session()->has('loginfail'))
                        <div class="form mt-2 p-0 ">
                            <div style="font-size: 0.7rem" class="p-2 alert alert-danger text-enter shadow-sm bg-red text-sm">
                                {{session('loginfail')}}
                            </div>
                        </div>
                    @endif

                    <button type="submit" class=" py-3 mt-4 mb-2 btn btn-lg btn-success btn-block">Giriş Yap</button>
                </form>

                    <a href="/register"  class="register-auth-link" >Kayıt Ol</a>

            </div>
        </div>
    </div>
</div>
</div>
@include('components/footer')
