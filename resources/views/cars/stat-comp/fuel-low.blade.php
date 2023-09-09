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
    <span class="mb-2"> <h1 class="mb-2" style="font-size: 1.5rem;font-weight: 600;margin-bottom: 15px"> En Az Yakan Arabalar</h1> <small>(100km'de ortalamaya göre)</small></span>




                <ul class="model-select-ul">
                    @foreach($car as $m)
                    <li>
                        <span style="color: limegreen;font-weight: 500;font-size: 1.1rem"> {{$m->fuel_cons_avg}} </span> <span style="font-size: 0.8rem;color: #8c7c50;font-weight: 500">L/100km </span>
                        <a href="{{ Route('SpecRoute',[$m->getCarEconomy->brand_name , $m->getCarEconomy->model_name, $m->getCarEconomy->model_id]) }}">
                            <h2   style="font-size: 0.9rem; font-weight: 600"
                                class="mb-0">{{$m->getCarEconomy->brand_name}} </h2>
                            <h2 style="font-size: 0.7rem; font-weight: 600"
                                class="mb-0">{{$m->getCarEconomy->model_name}} {{ \Illuminate\Support\Str::replace('-' , '',$m->getCarEconomy->model_spec)}}</h2>

                            <small style="font-size: 0.7rem" class="text-decoration-none color-black"
                                   disabled>{{$m->getCarEconomy->production_year}}</small>
                            <img style="max-height: 80px;
    width: auto;
    max-width: 160px;" src="{{$m->getCarEconomy->picture}}">
                            <div class="hovereffect"></div>
                        </a>
                    </li>
                    @endforeach
                </ul>
    {{$car->links()}}
    </div>


</div>
@include('components.footer')
