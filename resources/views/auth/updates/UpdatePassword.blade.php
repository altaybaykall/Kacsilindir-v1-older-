<head>
    @vite(['resources/css/loginregister.css'])
</head>
@include('components/layout')




    <div class ="accountupdateInfo" >
        <div class="profile-backarrow">
            <a href="/profile"  class="profile-backarrow-link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="color:white" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </a>

        </div>
        <div class="accountCardHeader">
            <h2>Şifre Değişikliği</h2>
            @if (session()->has('message'))
                <div class="alert alert-danger text-enter bg-red" style="font-family: 'Poppins', sans-serif; color:black; ">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <div class="accountCardBody">

            <form method='POST' action="/update/password">
                @csrf
                <ul class="infoTable">

                    <li>
<div>
                        <div><h3 style="margin-bottom: 25px">Eski Şifreniz</h3></div>
                        <input  name="current_password" id="current_password" class="form-control" type="text"   autofocus />
                        @error('password')
                        <p class="m-3 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
</div>
                </li>
                    <li>
                        <div>
                        <h3 style="margin-bottom: 25px">Yeni Şifre</h3>
                        <input  name="password" id="password"  class="form-control" type="text"   />
                        @error('password')
                        <p class="m-3 small alert alert-danger shadow-sm">{{$message}}</p>
                        @enderror
        </div>
                    </li>
                    <li>
                        <div>
                           <h3 style="margin-bottom: 25px">Yeni Şifre Tekrarı</h3>
                            <input  name="password_confirmation" id="password-confirm"  class="form-control" type="text"  autocomplete="off" />
                            @error('password')
                            <p class="m-3 small alert alert-danger shadow-sm">{{$message}}</p>
                            @enderror
                        </div>
                    </li>
                </ul>
                <button type="submit" class="py-1 mt-3 btn btn-lg btn-success ">Güncelle</button>
                @if (session()->has('passwordfail'))
                    <div class="container container--narrow">
                        <div class="alert alert-success text-enter bg-red">
                            {{session('passwordfail')}}
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

@include('components/footer')


