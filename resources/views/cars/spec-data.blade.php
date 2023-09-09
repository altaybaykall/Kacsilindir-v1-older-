<head>
    @vite(['resources/css/modelselect.css'])
    @section('title',$cars->model_spec)

</head>


@include('components/layout')

<div class="main-block-spec">
    <div class="section-spec">

        <div class="main-spec">

            <div class="spec-data">

                <div class="spec-align">
             <div class="spec-align-box">
                    <img alt="logo" class="spec-logo" src="{{$cars->getbrand->logo}}">
                    <div class="header-content">
                        <div class="spec-header">
                            <span>{{\Illuminate\Support\Str::upper($cars->brand_name)}} {{\Illuminate\Support\Str::replace('-' , ' ',$cars->model_name)}}
                           {{$cars->model_spec}} </span>

                        </div>

                        <div class="model-header">
                            <small class="text-muted">{{$cars->production_year}}</small>


                        </div>


                    </div>
             </div>
                    <div class="stars-cont">
                        <div class="stars-header">   <small>{{$cars->rating_count}} Oy</small></div>
                   @php(
                        $calc = round($cars->ratingcalc)
                     )
                        <span class="spec-stars">@for($i = 0; $i < $calc; $i++)&#x2605;@endfor</span><span class="spec-stars-empty">@for ($calc; $calc < 5; $calc++)&#x2605;@endfor</span>

                    </div>



                </div> <!--spec-align-->

                <div class="spec-short">

                    <div class="spec-img-box">
                        <div class="fav-box">
                            <a href="/favorites/{{$cars->model_id}}"
                            >
                                 <span class="fav-heart">   <svg viewBox="0 0 24 24" class="fav-heart" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#cc2424"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4.45067 13.9082L11.4033 20.4395C11.6428 20.6644 11.7625 20.7769 11.9037 20.8046C11.9673 20.8171 12.0327 20.8171 12.0963 20.8046C12.2375 20.7769 12.3572 20.6644 12.5967 20.4395L19.5493 13.9082C21.5055 12.0706 21.743 9.0466 20.0978 6.92607L19.7885 6.52734C17.8203 3.99058 13.8696 4.41601 12.4867 7.31365C12.2913 7.72296 11.7087 7.72296 11.5133 7.31365C10.1304 4.41601 6.17972 3.99058 4.21154 6.52735L3.90219 6.92607C2.25695 9.0466 2.4945 12.0706 4.45067 13.9082Z" fill="#ff0000" stroke="#ff0000" stroke-width="2"></path> </g></svg>
                               </span>
                            </a>
                        </div>
                        @if(session()->has('update'))
                            <span class="fav-error"> {{session('update')}}</span>
                        @endif
                        @if(session()->has('favupdate'))
                            <span class="fav-update"> {{session('favupdate')}}</span>
                        @endif
                        <img alt="main-car" class="spec-img" src="{{$cars->picture}}"></div>

                    <ul class="spec-ul ">
                        <li>
                            <img alt='hundredicon' class="spec-icons" src="/images/hundredicon.png">
                            <div class="title">0-100</div>
                            <div class="value"> {{ number_format((float)$cars->getEngine->hundred_sec, 1, '.', '') }}s
                            </div>
                        </li>
                        <li>
                            <div><img alt='engineicon' class="spec-icons" src="/images/engineicon.png"></div>
                            <div class="title">Güç</div>
                            <div class="value">{{$cars->getEngine->horse_power}} hp</div>
                        </li>
                        <li>
                            <div><img alt='drivetrain' class="spec-icons" src="/images/drivetrainicon.png"></div>
                            <div class="title">Çekiş</div>
                            <div class="value"> {{$cars->getEngine->drivetrain}}</div>

                        </li>

                        <li>
                            <div><img alt="topspeed" class="spec-icons" src="/images/topspeedicon.png"></div>
                            <div class="title">Hız</div>
                            <div class="value">{{ number_format((integer)$cars->getEngine->top_speed, 0, '.', '') }}
                                Km/h
                            </div>
                        </li>

                    </ul>
                </div>


            </div>
        </div>

        <div class="section-other-specs">
            <div class="other-header">
                <span>{{$cars->brand_name}} {{$cars->model_name}} Modelleri</span>
            </div>
            <hr class="other-invis">
            <ul class="other-ul">
                @foreach($models as $m)
                    <li>
                        <a href="{{ Route('SpecRoute',[$m->brand_name , $m->model_name, $m->model_id]) }}">
                            <h2 class="mb-2">{{ \Illuminate\Support\Str::replace('-' , '',$m->model_spec)}}</h2>
                            <small class="text-decoration-none color-black" disabled>{{$m->production_year}}</small>
                            <img alt="{{$m->model_spec}}" class="model-image" src="{{$m->picture}}">
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>


    </div><!--!section-end-->

    <div class="technic-detail">
        <div class="technic-header">
            <h3>{{ \Illuminate\Support\Str::replace('-' , ' ',$cars->model_name)}} {{ \Illuminate\Support\Str::replace('-' , ' ',$cars->model_spec)}}
                Teknik Özellikleri  @auth
                @can('editor')
                                          <a style="font-size: 1rem" href="/model/{{$cars->model_id}}/edit" class="pb-2 ml-3"
                                             data-toggle="tooltip" data-placement="top" title="Edit">Düzenle
                                              <i class="fas fa-edit fa-sm ml-1"></i></a>
                                        @method('UPDATE')
                @endcan
            @endauth
            </h3>
            <hr>
        </div>
        <div class="technic-specs">
            <table class="col-4">
                <thead>
                <th>Motor</th>
                </thead>
                <tbody>
                <tr>
                    <td class="titled">Motor Hacimi</td>
                    @if ($cars->getEngine->fuel_type !== 'Elektrik')
                        <td class="valued">{{$cars->getEngine->engine_size}} cm3</td>
                    @endif
                </tr>
                <tr>
                    @if ($cars->getEngine->fuel_type !== 'Elektrik')
                        <td class="titled"> Silindir Sayısı</td>
                    @else
                        <td class="titled"> Elektrik Motor Sayısı</td>
                    @endif
                    <td class="valued">  {{$cars->getEngine->cylinders}}</td>
                </tr>
                <tr>
                    <td class="titled">Beygir Gücü</td>
                    <td class="valued">{{$cars->getEngine->horse_power}} Hp</td>
                </tr>
                <tr>
                    <td class="titled">Tork</td>
                    <td class="valued">{{$cars->getEngine->torque}} Nm</td>
                </tr>

                <tr>
                    <td class="titled">Yakıt</td>
                    <td class="valued">{{$cars->getEngine->fuel_type}}</td>
                </tr>

                <tr>
                    <td class="titled">Çekiş</td>
                    <td class="valued">{{$cars->getEngine->drivetrain}}</td>
                </tr>

                <tr>
                    <td class="titled">Şanzıman</td>
                    <td class="valued">{{$cars->getEngine->transmission}}</td>
                </tr>


                </tbody>


            </table>
            <table class="col-4">
                <thead>
                <th>Boyutlar</th>
                </thead>
                <tbody>
                <tr>
                    <td class="titled">Kasa Tipi</td>
                    <td class="valued">{{$cars->getDimension->body_type}}</td>
                </tr>
                <tr>
                    <td class="titled"> Kapı Sayısı</td>
                    <td class="valued">  {{$cars->getDimension->door_num}} Kapı</td>
                </tr>
                <tr>
                    <td class="titled">Koltuk Sayısı</td>
                    <td class="valued">{{$cars->getDimension->seat_num}} Koltuk</td>
                </tr>
                <tr>
                    <td class="titled">Genişlik</td>
                    <td class="valued">{{ number_format((float)$cars->getDimension->width, 0, '.', '') }} cm</td>
                </tr>
                <tr>
                    <td class="titled">Yükseklik</td>
                    <td class="valued">{{ number_format((float)$cars->getDimension->height, 0, '.', '') }} cm</td>
                </tr>

                <tr>
                    <td class="titled">Uzunluk</td>
                    <td class="valued">{{ number_format((float)$cars->getDimension->lenght, 0, '.', '') }} cm</td>
                </tr>
                <tr>
                    <td class="titled">Ağırlık</td>
                    <td class="valued">{{ number_format((float)$cars->getDimension->weight, 0, '.', '') }} cm</td>
                </tr>
                <tr>
                    <td class="titled">Bagaj Kapasitesi</td>
                    <td class="valued">{{$cars->getDimension->trunk_cap}} L</td>
                </tr>

                </tbody>


            </table>
            <table class="col-4">
                <thead>
                <th>Ekonomi</th>
                </thead>
                <tbody>
                <tr>
                    <td class="titled">Ortalama Yakıt Tüketimi</td>
                    <td class="valued">{{ number_format((float)$cars->getEconomy->fuel_cons_avg,1,'.','')}}
                        @if ($cars->getEngine->fuel_type == 'Elektrik')
                            kWh/100 Km
                        @else
                            L/100 Km
                        @endif</td>
                </tr>
                <tr>
                    <td class="titled"> Şehir İçi Tüketim</td>
                    @if ($cars->getEngine->fuel_type !== 'Elektrik')
                        <td class="valued"> {{number_format((float)$cars->getEconomy->fuel_cons_ic,1,'.','')}}L/100 Km
                        </td>
                    @endif
                </tr>
                <tr>
                    <td class="titled">Şehir Dışı Tüketim</td>
                    @if ($cars->getEngine->fuel_type !== 'Elektrik')
                        <td class="valued">{{number_format((float)$cars->getEconomy->fuel_cons_oc,1,'.','')}}L/100 Km
                        </td>
                    @endif

                </tr>
                <tr>
                    @if ($cars->getEngine->fuel_type !== 'Elektrik')
                        <td class="titled">Yakıt Deposu</td>
                        <td class="valued">{{$cars->getEconomy->fuel_tank}} L</td>
                    @else
                        <td class="titled">Batarya Kapasitesi</td>
                        <td class="valued">{{$cars->getEconomy->fuel_tank}} kWh</td>
                    @endif

                </tr>

                <tr>
                    <td class="titled">Menzil</td>
                    <td class="valued">{{$cars->getEconomy->range}} Km</td>
                </tr>

                <tr>
                    <td class="titled">Emisyon Değeri</td>
                    <td class="valued">{{$cars->getEconomy->emission}} g/Km</td>
                </tr>

                </tbody>


            </table>
        </div>
    </div>

    <div class="under-spec">
        <div class="comments-box">
            <h4>{{$comments->count()}} Yorum </h4>
            <hr>
            @auth
                <div class="comment-owner ">
                    <img alt="{{Auth::user()->user_name}}" src="{{Auth::user()->avatar}}" class="owner-avatar">
                    <h4> {{Auth::user()->user_name}}</h4>
                </div>

                <form class="form-comment" action="{{route('ModelCommentSave',[$cars->model_id])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="text" class="form-control" maxlength="255" name="comment"
                           placeholder="Yorum ekleyin...">
                    <button type="submit" hidden>Yap</button>
                </form>
            @else
                <div class="comment-owner mb-4">
                    <img alt="comment-own" src="/images/profileiconblack.png" class="owner-avatar">
                    <h4> Yorum Yapmak için <a href="/login">Giriş</a> Yapınız</h4>
                </div>
            @endauth


            <div class="comments-list">
                @foreach($comments->reverse() as $com)
                    <div class="comment-align">
                        <div class="align-content">

                            <div class="comment-owner ">
                                <img alt='{{$com->commentvby->user_name}}' src="{{$com->commentvby->avatar}}"
                                     class="owner-avatar">
                                <h4> {{$com->commentvby->user_name}}</h4>
                                <small class="text-muted">{{$com->created_at->diffForHumans()}}</small>
                            </div>


                            <div class="comment-content">
                                <p>{{$com->comment}}</p>
                            </div>
                        </div>
                        <div>
                            @auth
                                @can('update',$com)
                                    <span class="pt-2 ">

                                          <a href="{{ route ('DComment',[$com->comment_id]) }}"
                                             class="text-danger mr-2 !bg-dark" data-toggle="tooltip"
                                             data-placement="top">Yorumu Sil <svg fill="#ff0000" viewBox="-3.5 0 19 19"
                                                                                  height="15px" width="15px"
                                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                                  class="cf-icon-svg" stroke="#ff0000"><g
                                                      id="SVGRepo_bgCarrier" stroke-width="0"></g><g
                                                      id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                      stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path
                                                          d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path></g></svg></a>
                                            @method('UPDATE')
                                        </span>
                                @endcan
                            @endauth
                        </div>

                    </div>

                @endforeach
            </div><!--comment-list-->


        </div>
<div class="under-spec-right">
        <div class="under-brand">
            <div class="brand-info">
                <img alt="logo" class="info-logo" src="{{$cars->getbrand->logo}}">
                <span>{{\Illuminate\Support\Str::upper($cars->brand_name)}}</span>

            </div>
            <div class="brand-content">

                <p>{{$cars->getbrand->content}}</p>

            </div>

        </div>


    <div class="under-rate">
         <div class="under-rate-header">
            <span >Arabayı Değerlendirin</span>
         </div>
            <div class="under-rate-car">
              <h3>{{$cars->brand_name}} {{$cars->model_name}} {{$cars->model_spec}}</h3>
              <img alt="under-car" src="{{$cars->picture}}">


          </div>
            <div class="under-rate-sum">
                <small>Toplam Kullanılan Oy : {{$cars->rating_count}}</small></div>
            @auth
            <div class="stars">

               @if(session()->has('rate'))
                   <span class="rate-error"> {{session('rate')}}</span>
               @endif

                <form method="post" name="rate-form" class="rate-form" action="/car-rate/{{$cars->model_id}}">
                   @csrf
                <input type="radio" id="rate-5" value="5" name="rating-1">
                <label for="rate-5"></label>
                <input type="radio" id="rate-4" value="4" name="rating-1">
                <label for="rate-4"></label>
                <input type="radio" id="rate-3"  value="3"  name="rating-1">
                <label for="rate-3"></label>
                <input type="radio" id="rate-2" value="2" name="rating-1">
                <label for="rate-2"></label>
                <input type="radio" id="rate-1"  value="1" name="rating-1">
                <label for="rate-1"></label>
                   <button type="submit" class="btn btn-sm btn-success ">Gönder</button>
               </form>


            </div>
            @else
                <div class="rate-guest-error">Araca Puan Vermek için <a class="ml-1 text-warning" href="/login">Giriş Yapınız</a> </div>
            @endauth
        </div>
</div>
    </div>


    <div class="latest-section">
        <div class="latest-header">
            <h3>Diğer {{\Illuminate\Support\Str::upper($cars->brand_name)}} Modelleri</h3>

        </div>
        <div class="latest-models">
            <ul class="latest-ul">
                @foreach($samebrand as $sb)
                    <li>
                        <a href="{{ Route('SpecRoute',[$sb->brand_name , $sb->model_name, $sb->model_id]) }}">
                            <h2 class="mb-0">{{$sb->brand_name}} {{ \Illuminate\Support\Str::replace('-' , '',$sb->model_spec)}}</h2>
                            <small class="text-decoration-none color-black" disabled>{{$sb->production_year}}</small>
                            <img alt='{{$sb->model_spec}}' class="model-image" src="{{$sb->picture}}">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>
    <div class="latest-section">
        <div class="latest-header">
            <h3>Son Eklenenler</h3>

        </div>
        <div class="latest-models">
            <ul class="latest-ul">
                @foreach($latestmodels as $m)
                    <li>
                        <a href="{{ Route('SpecRoute',[$m->brand_name , $m->model_name, $m->model_id]) }}">
                            <h2 class="mb-0">{{$m->brand_name}} {{ \Illuminate\Support\Str::replace('-' , '',$m->model_spec)}}</h2>
                            <small class="text-decoration-none color-black" disabled>{{$m->production_year}}</small>
                            <img alt='{{$m->model_spec}}' class="model-image" src="{{$m->picture}}">
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


    </div>
</div>

@include('components/footer')

</body>




