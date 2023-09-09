@section('title', 'Haber Ekle')
@include('adminpanel.dashboard')

<div class="accountInfo">


    <div class="col-lg-12 pl-lg-5 pb-3 mb-3">
        <form class="form-outline" action="/news/add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="panel-header2 col-lg-6 mb-3 mt-2"><h3 class="py-2 px-1 m-0">Yeni Haber Yazısı</h3></div>
            <div class="col-lg-3">
                <label for="title" class="text mb-3 mt-3 "><h4>Başlık</h4></label>
                <input value="{{old('title')}}" type="text" style="padding: 5px" required name="title" id="title"
                      maxlength="70" class="form-control"/>
                @error('title')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-lg-3 mb-3 mt-3">
                <div>Haber Görseli Yükle<input type="file" name="file" id="image" placeholder="Resim Seçiniz"
                                               accept="image/*"></div>
                @error('avatar')
                <P CLASS="alert small alert-danger">{{$message}} </P>
                @enderror

            </div>
            <div class="col-lg-7 h-auto">
                <label for="contentt" class="text mb-3 mt-3 ml-0 pl-0"><h4>İçerik</h4></label>
                <textarea name="contentt" id="contentt" class="form-control" required rows="10"
                          cols="50">{{old('contentt')}}</textarea>
                @error('contentt')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label>İlgili Marka</label>
                <select class="form-select p-1 m-0 mt-2" aria-label="Default select example" name="brand_name">
                    <option value="" disabled selected> Marka Seçiniz</option>
                    @foreach($brands as $b)
                        <option value='{{ $b->brand }}'> {{ $b->brand }}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 mt-3 ">
                <input type="submit" formnovalidate="formnovalidate" value="Kaydet" class="btn btn-success"/>
            </div>
            <div class=" author-label">
                <label> <small>Yazar</small> : {{ Auth::user()->user_name}} </label>
                <small style="margin-left: 20px">{{now()->format('d-m-Y')}}</small>
            </div>

        </form>

    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#contentt'))
        .catch(error => {
            console.error(error);
        });
</script>

@include('components.footer')
