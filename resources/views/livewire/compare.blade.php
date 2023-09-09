<div class="compare-shard">

    <div class="select-first ">

    <div class="select-brand">

        <span id="add-car-span">Araba Ekle</span>

        <select class="form-control p-1 m-0 mt-2" wire:model="selectedbrand" aria-label="Default select example"
                name="brand_name">

            <option value=""> Marka Seçiniz</option>

            @foreach($brands as $b)
                     @if($b->cars_count > 0)
                    <option value='{{ $b->brand }}'>{{ $b->brand }}</option>
    @endif
            @endforeach
        </select>
    </div>

        <div class="select-model">
            <small>Seri</small>
            <select class="form-control p-1 m-0 mt-0" wire:model="selectedmodel" aria-label="Default select example " name="vehicle_picker[make]"
                    name="brand_name">

                <option value=""> Seri</option>
                @if(!is_null($models))
                @foreach($models as $m)
                    <option value='{{ $m->model_name }}'> {{ $m->model_name }}</option>

                @endforeach
                @endif
            </select>
        </div>


        <div class="select-model">
            <small style="color:white">Model</small>
            <select class="form-control p-1 m-0 mt-0" wire:model="selectedspec" aria-label="Default select example"
                    name="brand_name">
                <option value="">Model</option>
                @if(!is_null($specs))
                @foreach($specs as $m)
                    <option value='{{ $m->model_id }}'> {{ $m->model_spec }} <small>{{ $m->production_year }}</small></option>

                @endforeach
                    @endif
            </select>
        </div>
        @if (count($this->allresult) <=3)
    @if(!is_null($result))
        <div class="new-model-button">
            <button class="new-model-btn" wire:click.prevent="addModel">Karşılaştırmaya Ekle</button>
        </div>
    @endif
        @else
            <h4 style="color:white; font-size: 18px">Maks karşılaştırma sayısı 4'tür</h4>
@endif





</div>





<div class="selected-brand">

    <table class="selected-table" >
        <tbody>

        @if (count($this->allresult) >0)
        <span class="mt-2">Liste</span>

        @endif
        <tr id="cars-selected-head">
        @if(!is_null($datas))
            @forelse($datas as $data)
                @if ($loop->first)
                    <td class="first-item">
                        <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3>
                        <small class="text-decoration-none color-black" disabled>{{$data->production_year}}</small>
                        <img src="{{$data->picture}}" >
                    </td>
                @elseif ($loop->last)
                    <td class="first-item">
                        <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3>
                        <small class="text-decoration-none color-black" disabled>{{$data->production_year}}</small>
                        <img src="{{$data->picture}}">
                    </td>
                @else

                    <td class="first-item">
                        <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3>
                        <small class="text-decoration-none color-black" disabled>{{$data->production_year}}</small>
                        <img src="{{$data->picture}}">
                    </td>
                    @endif
            @empty

    @endforelse
            @endif

    </tr>

    </tbody>
    </table>
    @if(!is_null($check))
        <div class="new-model-button2">
            <button class="new-model-btn2" wire:click.prevent="addSelect">Karşılaştır</button>
        </div>

    @else
        <div  style="margin-top:25px">
        <small> Karşılaştırmak için araba ekleyin.</small>
        </div>
    @endif
</div>

</div>


