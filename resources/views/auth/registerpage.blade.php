<!DOCTYPE html>
<head>
    @vite(['resources/css/loginregister.css'])
</head>
@include('components/layout')
<div class="main-block-login">
<div class="container-main">
        <div class="container  py-sm-5 mt-1 mb-3">
            <div class="row align-items-center py-md-1">
                <div class="login-motto col-lg-7 py-md-1 ">
                <h2 class="display-3 ">Kaydınız Yok mu ?</h2>
                <p class="lead text-muted">Arabalar kaçmıyor bekliyoruz </p>
            </div>
            <div class="col-lg-5 pl-lg-5 pb-3 ">
                <img class="valid-logo"  src="/images/logosiyah.png">
                <form action="/registration" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group mb-1 position-relative ">
                        <label for="username-register" class="text-muted mb-0 "><small>Kullanıcı adınız</small></label>
                        <input value="{{old('user_name')}}" name="user_name" id="username-register" class="form-control" type="text" placeholder="Kullanıcı adı Giriniz" autocomplete="off" />
                        @error('user_name')
                        <div class="auth-error">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form  mb-1 position-relative ">
                        <label for="email-register" class="text-muted mb-0"><small>Email</small></label>
                        <input value="{{old('email')}}" name="email" id="email-register" class="form-control" type="text" placeholder="Mail Adresi" autocomplete="off" />
                        @error('email')
                        <div class="auth-error">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form mb-1 position-relative">
                        <label for="password-register" class="text-muted mb-0 "><small>Şifreniz</small></label>
                        <input name="password" id="password-register" class="form-control" type="password" placeholder="Şifrenizi Giriniz" />
                        @error('password')
                        <div class="auth-error">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-1 position-relative ">
                        <label for="password-register-confirm" class="text-muted mb-0 "><small>Şifre Tekrarı</small></label>
                        <input name="password_confirmation" id="password-register-confirm" class="form-control" type="password" placeholder="Şifrenizi Giriniz" />
                    </div>

                    <button type="submit" class="py-3 mt-4  mb-2 btn btn-lg btn-success btn-block">Kayıt Ol</button>
                </form>
                <a href="/login" class="register-auth-link" >Giriş yap</a>
            </div>
        </div>
    </div>
    </div>
</div>
@include('components/footer')
