
<head>
    @vite(['resources/css/modelselect.css'])
    @section('title',$Brands->brand )
</head>

@include('components/layout')




<div class="brand-header">
    <img alt="logo" class="brandselected-logo" src="{{$Brands->logo}}">
    <span> <h1>{{ \Illuminate\Support\Str::upper($Brands->brand) }} Modelleri</h1> </span>

</div>

<div class="modelselect-main">



         <ul class="model-select-ul ">
             @foreach($model as $m)
                 <li>
                     <a href="{{ Route('ModelRoute',[$m->brand_name , $m->model_name]) }} ">
                         <h2 class="mb-0">{{ \Illuminate\Support\Str::replace('-' , ' ',$m->model_name)}}</h2>
                         <img alt="model-image" class="model-image" src="{{$m->picture}}">
                     <div class="hovereffect"></div>
                     </a>
                 </li>
             @endforeach
         </ul>





 </div>
@include('components/footer')
