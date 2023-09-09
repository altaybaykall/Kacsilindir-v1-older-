<!DOCTYPE html>
@include('components/layout')
<head>
    @vite(['resources/css/compare.css'])
</head>
<div class="main-block-light-compare">
<div class="compare-main">
    <div class="compare-body">
        <div class="compare-nav">
            <span><a href="/"> Anasayfa </a> /  Karşılaştırma </span>
        </div>
        <div class="compare-header">
            <span>
            @foreach($datas as $data)
                    @if ($loop->first)
                        {{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}
                        &
                    @elseif ($loop->last)
                        {{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}
                    @else
                        {{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}  &
                    @endif


                @endforeach
                Karşılaştırması

            </span>
        </div>
        <div class="compare-box">
            <table>
                <tbody>
                <tr id="cars-head">
                    @foreach($datas as $data)
                        @if ($loop->first)
                            <td class="first-item">
                                <a href="/{{$data->brand_name}}/{{$data->model_name}}/{{$data->model_id}}">
                                <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3> </a>
                                <span>{{$data->production_year}}</span>
                                <img alt="{{$data->picture}}" src="{{$data->picture}}" >
                            </td>
                            <td class="invex"></td>

                        @elseif ($loop->last)

                            <td class="first-item">
                                <a href="/{{$data->brand_name}}/{{$data->model_name}}/{{$data->model_id}}">
                                <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3></a>
                                <span>{{$data->production_year}}</span>
                                <img alt="{{$data->picture}}" src="{{$data->picture}}">
                            </td>
                        @else

                            <td class="second-item">
                                <a href="/{{$data->brand_name}}/{{$data->model_name}}/{{$data->model_id}}">
                                <h3>{{$data->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->model_name)}}  {{$data->model_spec}}</h3></a>
                                <span>{{$data->producton_year}}</span>
                                <img alt="{{$data->picture}}" src="{{$data->picture}}">
                            </td>
                            <td class="invex"></td>
                        @endif

                    @endforeach

                    <!---cars-head--->
                </tr>

                <tr id="spec-title">
                    <td><h3>Motor Özellikleri</h3></td>
                </tr>
                <tr>
                    <td class="title">Motor Hacimi</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->engine_size;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->engine_size;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight:{{ $isGreater ? '700' : '400' }}">{{$data->getengine->engine_size}} cm3</td>
                    @endforeach
                </tr>
                <tr>
                        <td class="title" >Silindir Sayısı</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->cylinders;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->cylinders;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight:{{ $isGreater ? '600' : '400' }}">{{$data->getengine->cylinders}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Beygir Gücü</td>

                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->horse_power;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->horse_power;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight:{{ $isGreater ? '600' : '400' }}">{{$data->getengine->horse_power}} Hp</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Tork</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->torque;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->torque;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight: {{ $isGreater ? '600' : '400' }}">{{$data->getengine->torque}} Nm</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yakıt</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getengine->fuel_type}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Çekiş</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getengine->drivetrain}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şanzıman</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getengine->transmission}}</td>
                    @endforeach
                </tr>


                <tr id="spec-title">
                    <td class="spec-title"><h3>Performans</h3></td>
                </tr>
                <tr>
                    <td class="title">0-100 Süresi</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->hundred_sec;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->hundred_sec;
                            $isGreater = $currentHorsePower < $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight: {{ $isGreater ? '600' : '400' }}">{{number_format((float)$data->getengine->hundred_sec,1,'.','')}} s</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Maksimum Hız</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getengine->top_speed;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getengine->top_speed;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value"  style="font-weight: {{ $isGreater ? '600' : '400' }}">{{number_format((float)$data->getengine->top_speed,0)}} Km/H</td>
                    @endforeach
                </tr>


                <tr id="spec-title">
                    <td class="spec-title"><h3>Boyutlar</h3></td>
                </tr>
                <tr>
                    <td class="title">Uzunluk</td>
                    @foreach($datas as $data)
                        <td class="value">{{number_format((float)$data->getdimension->lenght,1,'.','')}} cm</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Genişlik</td>
                    @foreach($datas as $data)
                        <td class="value">{{number_format((float)$data->getdimension->width,1,'.','')}} cm</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yükseklik</td>
                    @foreach($datas as $data)
                        <td class="value">{{number_format((float)$data->getdimension->height,1,'.','')}} cm</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Ağırlık</td>
                    @foreach($datas as $data)
                        <td class="value">{{number_format((float)$data->getdimension->weight,1,'.','')}} kg</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Kasa Tipi</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getdimension->body_type}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Kapı Sayısı</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getdimension->door_num}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Koltuk Sayısı</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->getdimension->seat_num}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Bagaj Kapasitesi</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->getdimension->trunk_cap;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->getdimension->trunk_cap;
                            $isGreater = $currentHorsePower > $otherHorsePower;
                        @endphp
                        <td class="value" style="font-weight: {{ $isGreater ? '600' : '400' }}">{{$data->getdimension->trunk_cap}} L</td>
                    @endforeach
                </tr>

                <tr id="spec-title">
                    <td class="spec-title"><h3>Ekonomi</h3></td>
                </tr>
                <tr>
                    <td class="title">Ortalama Yakıt Tüketimi</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->geteconomy->fuel_cons_avg;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->geteconomy->fuel_cons_avg;
                            $isGreater = $currentHorsePower < $otherHorsePower;
                        @endphp
                        <td class="value"  style="font-weight: {{ $isGreater ? '600' : '400' }}">{{number_format((float)$data->geteconomy->fuel_cons_avg,1,'.','')}} L/100 Km</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şehir içi Tüketim</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->geteconomy->fuel_cons_ic;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->geteconomy->fuel_cons_ic;
                            $isGreater = $currentHorsePower < $otherHorsePower;
                        @endphp
                        <td class="value"  style="font-weight: {{ $isGreater ? '600' : '400' }}">{{number_format((float)$data->geteconomy->fuel_cons_ic,1,'.','')}} L/100 Km</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şehir Dışı Tüketim</td>
                    @foreach($datas as $data)
                        @php
                            $currentHorsePower = $data->geteconomy->fuel_cons_oc;
                            $otherHorsePower = $datas->where('model_id', '!=', $data->model_id)->first()->geteconomy->fuel_cons_oc;
                            $isGreater = $currentHorsePower < $otherHorsePower;
                        @endphp
                        <td class="value"  style="font-weight: {{ $isGreater ? '600' : '400' }}">{{number_format((float)$data->geteconomy->fuel_cons_oc,1,'.','')}} L/100 Km</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yakıt Deposu</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->geteconomy->fuel_tank}} L</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Menzil</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->geteconomy->range}} Km</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Emisyon Değeri</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->geteconomy->emission}} g/Km</td>
                    @endforeach
                </tr>
                </tbody>
            </table>


        </div>
    </div><!--compare-body-->
</div><!--compare-main-->
</div>

@include('components/footer')
