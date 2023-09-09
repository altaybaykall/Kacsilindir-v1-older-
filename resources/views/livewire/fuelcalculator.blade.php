<div class="compare-shard">

    <div class="select-fuel ">

        <div class="select-brand">

<div>
            <small class="mt-1">Yakıt tüketimi (lt/100km)</small>
            <input class="form-control p-2 m-0 mb-3 mt-1" wire:model.defer="fuelavg"
                    name="fuelavg">
            <small class="mt-1">Yakıt Tipi</small>
    <select class="form-control p-2 m-0 mb-3 mt-1" wire:model.defer="fuelprice" aria-label="Default select example" name="fuel_price">
        <option value="null" disabled>{{ __('Yakıt Tipi') }}</option>
        <option value="Benzin"  >Benzin</option>
        <option value="Dizel" >Dizel</option>
    </select>
            <small class="mt-1" >Mesafe (km)</small>
            <input class="form-control p-2 m-1 mb-0 mt-0" wire:model.defer="fuelrange"
                   name="fuelrange">

        </div>
        <div class="new-model-button">
            <button class="new-model-btn" wire:click.prevent="calculate">Hesapla</button>
        </div>
        </div>




    </div>
    <div class="select-gasprices ">
        <table class="table table-striped">

            <tbody>
            <tr>
                <th class="gasprices" scope="row">Benzin</th>
                <td  class="gasprices"> {{$istanbulbenzin}}
                    TL / lt</td>

            </tr>
            <tr>
                <th class="gasprices" scope="row">Dizel</th>
                <td  class="gasprices">{{$istanbuldizel}} TL / lt</td>
            </tr>

            </tbody>
        </table>

        <small>Not: Akaryakıt fiyatları İstanbul baz alınarak günlük olarak güncellenmektedir.</small>
        <small> Yanlışlık veya hatalı bilgilendirme durumları ortaya çıkabilir.</small>
    </div>
    @if($calcrange > 0)
    <div class="select-calculated">
       <h3>Hesaplama Sonucu</h3>
        <div class="calculated-box">
        <div class="calculated-slot">
            <p>Yakıt fiyatı : </p> <p class="calc-data"> {{$fuelprice}} ₺ </p></div>
            <div class="calculated-slot">
            <p>1 km'de yakıt masrafı:  </p> <p class="calc-data"> {{round((float)$calculated, 2)}}  ₺</p></div>
            <div class="calculated-slot">
            <p>100 km'de yakıt masrafı : </p>  <p class="calc-data">  {{round((float)$calcrangeh,2)}}  ₺</p></div>
            <div class="calculated-slot">
            <p>{{$fueledrange}} km'de yakıt masrafı: </p> <p class="calc-data">{{round((float)$calcrange,2)}} ₺</p></div>
        </div>
        <p style="font-size: 0.6rem;color: #525252">Hesaplamalar tahmini olarak yapılmaktadır. Gerçek tüketim değeri koşullara göre değişebilir.</p>
    </div>
    @endif



</div>


