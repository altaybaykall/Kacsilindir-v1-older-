<head>
    @vite(['resources/css/modelselect.css'])
</head>
@include('components.layout')


<div class="brand-header">

    <div class="navs-top-brands">
        <a href="/en-azyakan-arabalar">En Az Yakanlar</a>
        <a href="/en-cokyakan-arabalar">Çok Yakanlar</a>
        <a href="/en-hizli-arabalar">En Hızlılar</a>
        <a href="/en-yavas-arabalar">En Yavaşlar</a>
        <a href="/elektrikliler">Elektrikliler</a>
        <a href="/rastgele">Rastgele</a>
        <a href="/yakit-hesapla">Tüketim Hesapla</a>
    </div>

</div>


<div class="modelselect-main ">
    <span class="mb-2"> <h1 class="mb-2" style="font-size: 1.5rem;font-weight: 600;margin-bottom: 15px"> En Hızlı Arabalar</h1> <small>(Maksimum Sürata göre)</small></span>





                <ul class="model-select-ul" >
                    @foreach($car as $m)
                    <li style="flex-wrap: nowrap;">
                        <span style="color: limegreen;font-weight: 600"> {{$m->top_speed}} </span> <span style="font-size: 0.8rem;color: #8c7c50;font-weight: 500">km/h </span>
                        <a href="{{ Route('SpecRoute',[$m->getCarEngine->brand_name , $m->getCarEngine->model_name, $m->getCarEngine->model_id]) }}">
                        <h2   style="font-size: 0.9rem; font-weight: 600"
                            class="mb-0">{{$m->getCarEngine->brand_name}}</h2>
                        <h2 style="font-size: 0.7rem; font-weight: 600"
                            class="mb-0">{{$m->getCarEngine->model_name}} {{ \Illuminate\Support\Str::replace('-' , '',$m->getCarEngine->model_spec)}}</h2>

                        <small style="font-size: 0.7rem;flex-wrap: nowrap;" class="text-decoration-none color-black "
                               disabled>{{$m->getCarEngine->production_year}}</small>
                            <img style="max-height: 80px;
    width: auto;
    max-width: 160px;" class="model-image" src="{{$m->getCarEngine->picture}}">
                            <div class="hovereffect"></div>
                        </a>
                    </li>
                    @endforeach
                </ul>
    {{$car->links()}}
    </div>


</div>
@include('components.footer')
