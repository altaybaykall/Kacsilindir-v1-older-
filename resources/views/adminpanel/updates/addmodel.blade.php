@section('title', 'Model Ekle')
@include('adminpanel.dashboard')


<div class="accountInfo">
    <div class="col pl-lg-3 pb-3 mb-3">
        <div class="panel-header  col-9 mb-3 mt-2"><h3 class="py-2 px-1 m-0">Yeni Model Ekle</h3></div>
        @if (session()->has('update'))
            <div class="container container">
                <div class="alert alert-info text-enter bg-red">
                    {{session('update')}}
                </div>
            </div>
        @endif
        <div class="col pl-lg-3 pb-3 mb-3">
            <form action="/model/add" method="POST" id="model" enctype="multipart/form-data">
                @csrf
                <div class="form-row col-md-9 p-3 mt-2" style="border:2px solid darkred;padding :2px; overflow:hidden;">
                    <div class="form-row col-12">
                        <div class="form-group col-md-3">
                            <h2>Marka Seç </h2>
                            <select class="form-select p-1 m-0 mt-2" aria-label="Default select example"
                                    name="brand_name">
                                <option value="" disabled selected> Marka Seçiniz</option>
                                @foreach($brands as $b)
                                    <option value='{{ $b->brand }}'> {{ $b->brand }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3  ">
                            <label for="model_name" style="font-size:21px; margin-top:6px">Model Adı</label>
                            <input type="text" value="{{old('model_name')}}" class="form-control p-1 pl-2 m-0 mt-1 "
                                   id="model_name" name="model_name" placeholder="Ör: 3 Serisi , Golf">
                            @error('model_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4 ml-4">
                            <label for="model_spec" style="font-size:21px; margin-top:6px">Model Kodu</label>
                            <input type="text" value="{{old('model_spec')}}" class="form-control p-1 pl-2 m-0 mt-1  "
                                   id="model_spec" name="model_spec" placeholder="Ör: 320ied ,1.6tdi">
                            @error('model_spec')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-1 ml-4">
                            <label for="production_year" style="font-size:21px; margin-top:6px">Yılı</label>
                            <input type="text" value="{{old('production_year')}}"
                                   class="form-control p-1 pl-2 m-0 mt-1  " id="production_year" name="production_year"
                                   placeholder="2000">
                            @error('production_year')
                            <div class="alert alert-danger ">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <h3 style="margin-bottom: 20px; margin-top: 25px; border-bottom: 1px solid #cbd5e0;">Fotoğraf
                            Yükle
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-upload mb-2 ml-2" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                        </h3>
                        <input type="file" name="file" id="image" placeholder="Resim Seçiniz" accept="image/*" required>
                        @error('file')
                        <P CLASS="alert small alert-danger">{{$message}} </P>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 m-0 mt-2">
                        <img id="preview-image" src="/images/tesla-template.jfif"
                             alt="preview image" style="max-height: 230px; max-width: 100%; ">

                    </div>
                </div>
                <h2 style="margin-bottom: 20px; margin-top: 25px; border-bottom: 1px solid #cbd5e0;">Motor Özellikleri
                    <small style="font-size:17px"> (Birimsiz, sadece Değer giriniz.)</small></h2>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fuel_type">Yakıt tipi</label>
                        <input type="text" value="{{old('fuel_type')}}" class="form-control" id="fuel_type"
                               name="fuel_type" placeholder="Yakıt tipi ">
                        @error('fuel_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group col-md-3">
                        <label for="torque">Tork </label>
                        <input type="text" value="{{old('torque')}}" class="form-control" id="torque" name="torque"
                               placeholder="Tork">
                        @error('torque')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="horse_power">HP (Beygir)</label>
                        <input type="text" value="{{old('horse_power')}}" class="form-control" id="horse_power"
                               name="horse_power" placeholder="Hp">
                        @error('horse_power')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="cylinders">Silindir Sayısı<small> (Elektrik motor sayısı)</small> </label>
                        <input type="text" value="{{old('cylinders')}}" class="form-control" id="cylinders"
                               name="cylinders" placeholder="Silindir sayısı">
                        @error('cylinders')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="engine_size">Motor Hacmi <small>(Elektrik ise 0)</small> </label>
                        <input type="text" value="{{old('engine_size')}}" class="form-control" id="engine_size"
                               name="engine_size" placeholder="Hacim">
                        @error('engine_size')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3 p-0 ">
                        <label class="overflow-hidden" for="drivetrain">Çekiş Türü </label>
                        <div class="custom-select" style="width:100%;">
                            <select id="drivetrain" name="drivetrain">
                                <option value="" disabled selected>Çekiş Türü Seçiniz</option>
                                <option value="FWD">FWD</option>
                                <option value="RWD">RWD</option>
                                <option value="AWD">AWD</option>
                            </select>
                        </div>
                        @error('drivetrain')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="transmission">Vites Türü <small></small></label>
                        <input type="text" value="{{old('transmission')}}" class="form-control" id="transmission"
                               name="transmission" placeholder="Ör: 6 ileri Otomatik ">
                        @error('transmission')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="hundred_sec">0-100 süresi </label>
                        <input type="text" value="{{old('hundred_sec')}}" class="form-control" id="hundred_sec"
                               name="hundred_sec" placeholder="0-100 süresi ">
                        @error('hundred_sec')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="top_speed">Top speed </label>
                        <input type="text" value="{{old('top_speed')}}" class="form-control" id="top_speed"
                               name="top_speed" placeholder="Top speed ">
                        @error('top_speed')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h2 style="margin-bottom: 20px; margin-top: 25px; border-bottom: 1px solid #cbd5e0;">Boyut Özellikleri
                    <small style="font-size:17px"> (Birimsiz, sadece Değer giriniz.)</small></h2>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="body_type">Kasa Tipi <small>(Cabrio,Sedan,vs...)</small></label>
                        <input type="text" value="{{old('body_type')}}" class="form-control" id="body_type"
                               name="body_type" placeholder="Kasa tipi">
                        @error('body_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="door_num">Kapı sayısı</label>
                        <input type="text" value="{{old('door_num')}}" class="form-control" id="door_num"
                               name="door_num" placeholder="Kapı Sayısı">
                        @error('door_num')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="seat_num">Koltuk Sayısı</label>
                        <input type="text" value="{{old('seat_num')}}" class="form-control" id="seat_num"
                               name="seat_num" placeholder="Koltuk Sayısı">
                        @error('seat_num')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="height"> Yükseklik </label>
                        <input type="text" value="{{old('height')}}" class="form-control" id="height" name="height"
                               placeholder="Yükseklik">
                        @error('height')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="width">Genişlik</label>
                        <input type="text" value="{{old('width')}}" class="form-control" id="width" name="width"
                               placeholder="Genişlik">
                        @error('width')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lenght">Uzunluk</label>
                        <input type="text" value="{{old('lenght')}}" class="form-control" id="lenght" name="lenght"
                               placeholder="Uzunluk">
                        @error('lenght')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="weight">Ağırlık (kg)</label>
                        <input type="text" value="{{old('weight')}}" class="form-control" id="weight" name="weight"
                               placeholder="Ağırlık">
                        @error('weight')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="trunk_cap">Bagaj Kapasite </label>
                        <input type="text" value="{{old('trunk_cap')}}" class="form-control" id="trunk_cap"
                               name="trunk_cap" placeholder="Bagaj Kapasite ">
                        @error('trunk_cap')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h2 style="margin-bottom: 20px; margin-top: 25px; border-bottom: 1px solid #cbd5e0;">Ekonomik Bilgiler
                    <small style="font-size:17px"> (Birimsiz, sadece Değer giriniz.)</small></h2>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fuel_cons_avg">Ortalama Yakıt Tüketimi<small> (13.5 , 12.0 gibi)</small></label>
                        <input type="text" value="{{old('fuel_cons_avg')}}" class="form-control" id="fuel_cons_avg"
                               name="fuel_cons_avg" placeholder="Ortalama Yakıt Tüketimi">
                        @error('fuel_cons_avg')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fuel_cons_ic">Şehir içi Yakıt Tüketimi</label> <small>(Elektrik ise 0)</small>
                        <input type="text" value="{{old('fuel_cons_ic')}}" class="form-control" id="fuel_cons_ic"
                               name="fuel_cons_ic" placeholder="Şehir içi Yakıt Tüketimi">
                        @error('fuel_cons_ic')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="fuel_cons_oc">Şehir dışı Yakıt Tüketimi</label> <small>(Elektrik ise 0)</small>
                        <input type="text" value="{{old('fuel_cons_oc')}}" class="form-control" id="fuel_cons_oc"
                               name="fuel_cons_oc" placeholder="Şehir dışı Yakıt Tüketimi">
                        @error('fuel_cons_oc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="fuel_tank"> Yakıt tankı kapasite / Batarya </label>
                        <input type="text" value="{{old('fuel_tank')}}" class="form-control" id="fuel_tank"
                               name="fuel_tank" placeholder="Kapasite">
                        @error('fuel_tank')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="range">Menzil </label>
                        <input type="text" value="{{old('range')}}" class="form-control" id="range" name="range"
                               placeholder="Menzil">
                        @error('range')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="emission">CO2 Emisyon Değeri <small>(248 ,250 gibi )</small></label>
                        <input type="text" value="{{old('emission')}}" class="form-control" id="emission"
                               name="emission" placeholder="Emisyon">
                        @error('emission')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="py-3 mt-4 btn btn-lg btn-danger btn-block col-9">MODEL EKLE</button>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#image').change(function () {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#preview-image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });
</script>

@include('components.footer')
