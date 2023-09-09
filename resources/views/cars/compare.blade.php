<!DOCTYPE html>
@include('components/layout')
<head>
    @vite(['resources/css/compare.css'])
</head>

<div class="compare-main">
    <div class="compare-body">
        <div class="compare-nav">
            <span><a href="/"> Anasayfa </a> /  Karşılaştırma </span>
        </div>
        <div class="compare-header">
            <span>
            @foreach($datas as $data)
                    @if ($loop->first)
                        {{$data->carcompare->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}}
                        &
                    @elseif ($loop->last)
                        {{$data->carcompare->brand_name}}   {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}}
                    @else
                        {{$data->carcompare->brand_name}}   {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}} &
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

                                <h3>{{$data->carcompare->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}}</h3>
                                <span id="head-span"><a href="{{ Route('removecompareList',[$data->carcompare->model_id ]) }}">Kaldır</a></span>
                                <img alt="{{$data->carcompare->picture}}" src="{{$data->carcompare->picture}}" >



                            </td>
                            <td class="invex"></td>

                        @elseif ($loop->last)

                            <td class="first-item">
                                <h3>{{$data->carcompare->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}}</h3>
                                <span id="head-span"><a href="{{ Route('removecompareList',[$data->carcompare->model_id ]) }}">Kaldır</a></span>
                                <img alt="{{$data->carcompare->picture}}" src="{{$data->carcompare->picture}}">

                            </td>

                       @else

                            <td class="second-item">
                                <h3>{{$data->carcompare->brand_name}}  {{ \Illuminate\Support\Str::replace('-' , ' ',$data->carcompare->model_name)}}  {{$data->carcompare->model_spec}}</h3>
                                <span id="head-span"><a href="{{ Route('removecompareList',[$data->carcompare->model_id ]) }}">Kaldır</a></span>
                                <img alt="{{$data->carcompare->picture}}" src="{{$data->carcompare->picture}}">
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
                        <td class="value">{{$data->carcompare->getengine->engine_size}} cm3</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Silindir Sayısı</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->cylinders}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Beygir Gücü</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->horse_power}} Hp</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Tork</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->torque}} Nm</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yakıt</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->fuel_type}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Çekiş</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->drivetrain}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şanzıman</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->transmission}}</td>
                    @endforeach
                </tr>


                <tr id="spec-title">
                    <td class="spec-title"><h3>Performans</h3></td>
                </tr>
                <tr>
                    <td class="title">0-100 Süresi</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->hundred_sec}} s</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Maksimum Hız</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getengine->top_speed}} Km/H</td>
                    @endforeach
                </tr>


                <tr id="spec-title">
                    <td class="spec-title"><h3>Boyutlar</h3></td>
                </tr>
                <tr>
                    <td class="title">Uzunluk</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->lenght}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Genişlik</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->width}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yükseklik</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->height}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Ağırlık</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->weight}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Kasa Tipi</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->body_type}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Kapı Sayısı</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->door_num}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Koltuk Sayısı</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->seat_num}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Bagaj Kapasitesi</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->getdimension->trunk_cap}} L</td>
                    @endforeach
                </tr>

                <tr id="spec-title">
                    <td class="spec-title"><h3>Ekonomi</h3></td>
                </tr>
                <tr>
                    <td class="title">Ortalama Yakıt Tüketimi</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->fuel_cons_avg}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şehir içi Tüketim</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->fuel_cons_ic}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Şehir Dışı Tüketim</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->fuel_cons_oc}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Yakıt Deposu</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->fuel_tank}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Menzil</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->range}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="title">Emisyon Değeri</td>
                    @foreach($datas as $data)
                        <td class="value">{{$data->carcompare->geteconomy->emission}}</td>
                    @endforeach
                </tr>
                </tbody>
            </table>


        </div>
    </div><!--compare-body-->
</div><!--compare-main-->


@include('components/footer')
