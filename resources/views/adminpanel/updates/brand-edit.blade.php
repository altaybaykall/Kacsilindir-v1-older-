@section('title', 'Marka Düzenle')
@include('adminpanel.dashboard')

<body>
<div class="brandinfo">


    <div class="form-row col-md-12 p-3 mt-2">

        <div class="form-group col-md-6 mr-3">
            <div class="row">
                <div class="allnews-header mb-4 mt-2">
                    <h3 class="py-2 px-1 m-0" style="color:black">{{$brand->brand}} Düzenleniyor</h3>
                </div>

                @if (session()->has('Update'))
                    <div class="container container">
                        <div class="alert alert-info text-enter bg-red">
                            {{session('Update')}}
                        </div>
                    </div>
                @endif


                <form action="/brand/editsave/{{$brand->id}}" method="POST" id="brand-from" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col  ">

                        <label for="brandname" class="text mt-2">Marka Adı</label>
                        <input name="brand" value="{{$brand->brand}} " id="brandname" class="form-control col-lg-10"
                               type="text" placeholder=""
                               autocomplete="off"/>
                        @error('brand')
                        <p class="m-3 small alert alert-danger shadow-sm">{{$message}}</p @enderror
                        <h3
                            style="margin-bottom: 20px; margin-top: 25px; border-bottom: 1px solid #cbd5e0;">
                            Logo Yükle
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                 fill="currentColor" class="bi bi-upload mb-2 ml-2" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                        </h3>
                    </div>
                    <div class="form-group col ">
                        <img id="preview-image" src="{{$brand->logo}}" alt="preview image"
                             style="max-height: 100px; max-width: 100%; ">
                    </div>


                    <div class="form-group col  ">
                        <input type="file" name="file" id="image" placeholder="Resim Seçiniz" accept="image/*"
                               required>
                        @error('file')
                        <P CLASS="alert small alert-danger">{{$message}} </P>
                        @enderror
                    </div>
                    <label for="content" class="text-muted mt-2">Marka Açıklaması</label>
                    <textarea name="content" id="content" class="form-control col-lg-10" type="text" placeholder=""
                              autocomplete="off">{{$brand->content}}</textarea>
                    @error('content')
                    <p class="m-3 small alert alert-danger shadow-sm">{{$message}}</p >
                    @enderror
                    <button type="submit" class="py-3 mt-4 btn btn-md btn-success btn-block">Ekle</button>

                </form>


                <div class="form-group col-md-12">
                    <a href="/brand/delete/{{$brand->id}}"
                       onclick="return confirm('Bu Markayı Silmek istediğine emin misin?')">Markayı Sil</a>
                </div>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">
    $('#image').change(function () {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });
</script>

</body>
@include('components.footer')
