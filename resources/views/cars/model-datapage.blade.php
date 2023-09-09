
<head>
    @vite(['resources/css/modelselect.css'])
    @section('title',$brands->brand )
</head>
@include('components/layout')



    <div class="brand-header">
        <img alt="logo" class="brandselected-logo" src="{{$brands->logo}}">
        <span> <h1>{{ \Illuminate\Support\Str::upper($brands->brand) }}  </h1> </span>
        <span><h1 class="color-darkgrey">{{ $brand }}</h1></span>

    </div>


<div class="modelselect-main ">



                    <ul class="model-select-ul">
                        @foreach($models as $m)
                        <li>

                            <a href="{{ Route('SpecRoute',[$m->brand_name , $m->model_name, $m->model_id]) }}">
                                <h2 class="mb-0">{{ \Illuminate\Support\Str::replace('-' , '',$m->model_spec)}}</h2>
                                <small class="text-decoration-none color-black" disabled>{{$m->production_year}}</small>
                                <img alt="{{$m->picture}}" class="model-image" src="{{$m->picture}}">
                                <div class="hovereffect"></div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
        </div>


    </div>
@include('components/footer')
