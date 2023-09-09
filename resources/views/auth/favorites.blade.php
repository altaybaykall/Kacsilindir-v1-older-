
<head>
    @vite(['resources/css/modelselect.css'])
    @vite(['resources/css/compare.css'])
    @section('title','Favorilerim' )
</head>
@include('components/layout')




<div class="brand-header">
    <img alt="logo" class="brandselected-logo" style="width: 47px; height: 47px; border-radius: 30px" src="{{Auth()->user()->avatar}}">
    <span> <h1> Favorilerim  </h1> </span>



</div>
<div class="modelselect-main ">




                <ul class="model-select-ul">
                    @foreach($favs as $m)
                    <li>

                        <a href="{{ Route('SpecRoute',[$m->favoritecar->brand_name , $m->favoritecar->model_name, $m->favoritecar->model_id]) }}">
                            <h2 style="font-size: 1rem" class="mb-0">{{$m->favoritecar->brand_name}} {{ \Illuminate\Support\Str::replace('-' , '',$m->favoritecar->model_spec)}}</h2>
                            <small class="text-decoration-none color-black" disabled>{{$m->favoritecar->production_year}}</small>
                            <img class="model-image" style="width: 200px;height: 150px" src="{{$m->favoritecar->picture}}">
                            <div class="hovereffect"></div>
                            <a style="color: red;font-size: 0.8rem" href="/favorites/delete/{{$m->model_id}}">Kaldır</a>
                        </a>
                    </li>
                    @endforeach
                </ul>

</div>


@include('components/footer')
