@section('title', $user->user_name)
@include('adminpanel.dashboard')

<body>
<div class="newinfo">
    <div class="col-lg-12 pl-lg-3 pb-3 mb-3">
        <div class="row">
            <div class="col-lg-6 pl-lg-12 pb-3 mb-3">


                <div class="panel-header3 col-lg-6 mb-2 mt-0">
                    <div class="panel-header mb-4 mt-2"><h3 class="py-2 px-1 m-0">{{$user->user_name}}</h3></div>
                </div>

                <p>email:{{$user->email}}</p> <p> {{$user->created_at}}</p>
                <p
                    @if($user->status === 0)
                        style="color:gray ">Temiz
                    @else

                        style="color:red" > Banlı
                    @endif
                </p>

                <div class="form-group col-lg-5 mb-3 mt-3">
                    <img src="{{$user->avatar}}" alt="" style="width: 50px; height: 50px; background-color: gray">
                </div>
                <div class="form-group col-lg-5 mb-3 mt-3">
                    <a href="{{  route ('AvatarDelete',[$user->id])  }}"
                       onclick="return confirm('Avatarı Silmek emin misin?')">
                        Avatarı Sil</a>
                </div>

                <form class="form-outline" action="{{  route ('UserEditSave',[$user->id])  }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="col-lg-4">
                        <label for="title" class="text mb-3 mt-3 ">
                            Kullanıcı Adı
                        </label>
                        <input value="{{$user->user_name}}" type="text" style="padding: 5px" name="user_name"
                               id="user_name" class="form-control"/>
                        @error('user_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="title" class="text mb-3 mt-3 ">
                            Email
                        </label>
                        <input value="{{$user->email}}" type="text" style="padding: 5px" name="email"
                               id="email" class="form-control"/>
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-3 mt-3 ">
                        <input type="submit" formnovalidate="formnovalidate" value="Kaydet" class="btn btn-success"/>
                    </div>

                </form>
                <div class="col-lg-3 mt-3 ">
                    <a href="{{  route ('UserDelete',[$user->id])  }}"
                       onclick="return confirm('Kullanıcıyı Silmek istediğine emin misin?')">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                             fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier"><title></title>
                                <g id="Complete">
                                    <g id="user-remove">
                                        <g>
                                            <path d="M17,21V19a4,4,0,0,0-4-4H5a4,4,0,0,0-4,4v2" fill="none"
                                                  stroke="#ff0000"
                                                  stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"></path>
                                            <circle cx="9" cy="7" fill="none" r="4" stroke="#ff0000"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"></circle>
                                            <line fill="none" stroke="#ff0000" stroke-linecap="round"
                                                  stroke-linejoin="round" stroke-width="2" x1="17" x2="23" y1="11"
                                                  y2="11"></line>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 pl-lg-4 pb-3 mb-3">
                <div class="user-edit-comments">
                <h5>Kullanıcının Yorumları</h5>
                   <span class="user-edit-comment-header">Haber Yorumları</span>
                    <ul>
                    @foreach($user->GetNewsComments as $ba)


                        <li class="mb-1">
                        <div>
                          <a href="/haber/{{$ba->news_id}}">
                           <img alt="pp" src="{{$user->avatar}}" style="height: 25px; width: 25px; border-radius: 30px">
                            <p>{{ Illuminate\Support\Str::limit($ba->comment,55,$end='...')  }}</p></a>
                        </div>
                            <div>
                            @can('update',$ba)
                                <span>
                                          <a href="{{ route ('DeleteComment',[$ba->comment_id]) }}">Sil</a>
                                        @method('UPDATE')

                                                </span>
                            @endcan
                            </div>
                        </li>
                    @endforeach
                   <span class="user-edit-comment-header">Araba Yorumları</span>
                    @foreach($user->GetSelfCarsComments as $be)


                            <li class="mb-1">
                            <div>
                            <a href="/{{$be->GetCarComments->brand_name}}/{{$be->GetCarComments->model_name}}/{{$be->GetCarComments->model_id}}">
                                <img alt="pp" src="{{$user->avatar}}" style="height: 25px; width: 25px; border-radius: 30px">
                                <p>{{ Illuminate\Support\Str::limit($be->comment,55,$end='...')  }}</p></a>
                            </div>
                                <div>
                                @can('update',$be)
                                    <span >
                                          <a href="{{ route ('DComment',[$be->comment_id]) }}">Sil</a>
                                            @method('UPDATE')
                                        </span>
                                @endcan
                                </div>

                        </li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
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
@include('components.footer')
</html>
