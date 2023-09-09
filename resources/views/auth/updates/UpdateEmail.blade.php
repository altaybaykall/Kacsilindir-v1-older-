
<head>
    @vite(['resources/css/loginregister.css'])
</head>
@include('components/layout')



    <div class ="accountupdateInfo" >
        <div class="profile-backarrow">
            <a href="/profile"  class="profile-backarrow-link ">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="color:#4d4a4a;" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </a>

        </div>
        <div class="accountCardHeader">
            <h2>E-posta Değişikliği</h2>
        </div>
        <div class="accountCardBody">
            <form method='POST' action="/update/email">
                @csrf

                <ul class="infoTable">
                    <li>
                        <div>
                            <h3 style="margin-bottom: 25px">Eski E-posta Adresi</h3>
                            <label> {{ Auth::user()->email}}</label>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h3 style="margin-bottom: 25px">Yeni E-posta</h3>
                            <input  name="email" id="email"  class="form-control" type="text" autocomplete="off" autofocus />
                            @error('email')
                            <p class="m-1 p-1 small alert alert-danger shadow-sm">{{$message}}</p>
                            @enderror
                        </div>
                    </li>
                </ul>
                <button type="submit" class="py-1 mt-3 btn btn-lg btn-success">Güncelle</button>

            </form>
        </div>
    </div>




@include('components/footer')


