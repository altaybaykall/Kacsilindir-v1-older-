<!DOCTYPE html>
<head>
    @vite(['resources/css/loginregister.css'])
</head>

@include('components/layout')
<div class="main-block-light">
<div class ="accountInfo" >

    <div class="accountCardHeader">
        <h2>
             Hesap Bilgileri
            </h2>

    </div>
    <div class="accountCardBody">

        <ul class="infoTable">
        <li> @if (session()->has('ProfileUpdate'))
                <div class="container mb-3">
                    <div class="alert alert-success text-enter bg-red">
                        {{session('ProfileUpdate')}}
                    </div>
                </div>

            @endif</li>
            <li class="profile-pp-box">
               <div class="profile-pp">
                <img alt="avatar" style="width: 80px; height: 80px; border-radius: 20px; " src="{{Auth::user()->avatar}}" />

                   <div class="profile-pp-edit"> <a id="profile-pp-a" href="/update-avatar"><img alt="pp-change" src="/images/cam-icon.jpg"></a></div>
               </div>
            </li>

            <li>
                <div><h3>Kullanıcı Adı </h3>
                <label> {{ Auth::user()->user_name}} </label> </div>
                <a href="/update"  class="cardLink">
                    <div class="btnSubmit">Düzenle <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square ml-1 " viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg></div>
                </a>
    </li>
            <li>
                <div><h3>Şifre </h3>
                <label > ********  </label> </div>
                <a href="/update/password"  class="cardLink">
                    <div class="btnSubmit">Düzenle <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square ml-1 " viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg></div>
                </a>
            </li>

            <li>
                <div><h3>E-Posta</h3>
                <label> {{Auth::user()->email}} </label> </div>
                <a href="/update/email"  class="cardLink">
                    <div class="btnSubmit">Düzenle <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square ml-1 " viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg></div>
                </a>
            </li>

            <li>
                <div> <span>Hesap Oluşturulma Tarihi</span>
                  <span class="ml-3">  {{Auth::user()->created_at}} </span> </div>
            </li>


        </ul>



    </div>


</div>
</div>
@include('components/footer')





