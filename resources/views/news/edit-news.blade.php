@include('adminpanel/dashboard')

<body>
<div class="newinfo">
    <div class="col-lg-12 pl-lg-3 pb-3 mb-3">
        <div class="row">
            <div class="col-lg-12 pl-lg-12 pb-3 mb-3">

                <form class="form-outline" action="{{  route ('EditNew',[$news->id])  }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="panel-header2 col-lg-6 mb-3 mt-2">
                        <h3 class="py-2 px-1 m-0">Haberi Düzenle</h3>
                    </div>
                    <div class="col-lg-4">
                        <label for="title" class="text mb-3 mt-3 ">
                            <h4>Başlık</h4>
                        </label>
                        <input value="{{$news->title}}" type="text" style="padding: 5px" required name="title"
                               id="title" class="form-control"/>
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-5 mb-3 mt-3">
                        <img src="{{$news->image}}" alt="" class="img-thumbnail w-100 h-100">
                    </div>
                    <div class="form-group col-lg-5 mb-3 mt-3">
                        <p style="font-weight:600;"> Haber Görseli Değiştir </p>
                    </div>
                    <div class="form-group col-lg-8 mb-3 mt-3">
                        <input type="file" name="file" id="image" placeholder="Resim Seçiniz" accept="image/*">
                    </div>
                    @error('avatar')
                    <P CLASS="alert small alert-danger">{{$message}} </P>
                    @enderror


                    <div class="col-lg-7 h-auto">
                        <label for="contentt" class="text mb-3 mt-3 ml-0 pl-0">
                            <h4>İçerik</h4>
                        </label>
                        <textarea name="contentt" id="contentt" class="form-control" required rows="10"
                                  cols="50">{!! $news->content  !!}</textarea>
                        @error('contentt')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label>İlgili Marka</label>
                        <select class="form-select p-1 m-0 mt-2" aria-label="Default select example" name="brand_name">
                            <option value="{{$news->brand}}" selected> {{$news->brand}} </option>
                            @foreach($brands as $b)
                                <option value='{{ $b->brand }}'> {{ $b->brand }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 mt-3 ">
                        <input type="submit" formnovalidate="formnovalidate" value="Kaydet" class="btn btn-success"/>
                    </div>
                    <div class=" author-label">
                        <label> <small>Yazar</small> :<img
                                style="width: 30px; height: 30px; border-radius: 30px; margin-left: 10px"
                                src="{{ $news->getauthor->avatar}}"> {{ $news->getauthor->user_name}} </label>
                        <small style="margin-left: 20px">{{now()->format('d-m-Y')}}</small>
                    </div>

                </form>
            </div>
        </div>
        @can('update',$news)
            <span class="pt-2">

            <form class="delete-post-form d-inline" action="/newsdelete/{{$news->id}}" method="POST">
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Haberi Silmek istediğine emin misin?')"
                        data-toggle="tooltip" data-placement="top" title="Delete">Haberi sil<i
                        class="fas fa-trash"></i></button>
            </form>
        </span>
        @endcan
    </div>
</div>
</div>
</body>
@include('components.footer')
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#contentt'))
        .catch(error => {
            console.error(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip()
</script>

</html>
