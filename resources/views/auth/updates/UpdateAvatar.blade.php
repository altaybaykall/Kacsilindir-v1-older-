<head>
    @vite(['resources/css/loginregister.css'])
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
           <h2>Avatar Güncelleme</h2>

    </div>
    <div class="accountCardBody">
        <form action="/update-avatar" method="POST"  id="image-upload-preview" enctype="multipart/form-data">
            @csrf

            <ul class="infoTable">
                <li>  <h3 style="margin-bottom: 10px">Mevcut Avatar</h3> </li>
                <li style=" flex-direction: row; align-items: baseline; justify-content: normal;  ">

                        <img alt="avatar" style="width: 80px; height: 80px; border-radius: 0px; " src="{{Auth::user()->avatar}}" />
                        <img alt="avatar" style="width: 60px; height: 60px; border-radius: 30px ; margin-left: 25px" src="{{Auth::user()->avatar}}" />
                    <img id="output"/>
                   </li >
                <li style="border-top: 2px solid lightslategrey">
                    <div class="col-md-12 mb-1 ml-0 p-0 mt-2 " >
                        <img id="preview-image" src="/images/profileiconblack.png"
                             alt="preview image" style="max-height: 130px; max-width: 130px; ">
                    </div></li>
                <h3 style="margin-bottom: 15px; margin-top: 5px;">Yükle</h3>
                <li >

                    <div class="mb-3">
                        <div><input type="file" name="file" id="image" placeholder="Resim Seçiniz" required accept="image/*"> </div>
                        @error('avatar')
                        <P CLASS="alert small alert-danger">{{$message}} </P>
                        @enderror

                    </div>
                </li>
            </ul>
            <button type="submit" class="py-1 mt-3 btn btn-lg btn-dark ">Yükle ve Değiştir</button>
            @error('image')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </form>
    </div>
    </div>

    <script type="text/javascript">
        $('#image').change(function(){

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
    </script>

@include('components/footer')


