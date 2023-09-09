<!DOCTYPE html>
@vite(['resources/css/homepage.css'])
@include('components/layout')
<div class="main-block-light">
<div class ="container-homepage" >

    <div class="navs-top-brands">
        <a href="/en-azyakan-arabalar">En Az Yakanlar</a>
        <a href="/en-cokyakan-arabalar">Çok Yakanlar</a>
        <a href="/en-hizli-arabalar">En Hızlılar</a>
        <a href="/en-yavas-arabalar">En Yavaşlar</a>
        <a href="/elektrikliler">Elektrikliler</a>
        <a href="/rastgele">Rastgele</a>
        <a href="/yakit-hesapla">Tüketim Hesapla</a>
    </div>
    <div class="home-brands">
        <div class="brands-pad">
            @foreach($brands as $brand)
                <div class="brands-slot">
                    <div class="brand-slot-box">
                    <a href="/{{$brand->brand}}">
                        <img src="{{$brand->logo}}" alt="{{$brand->brand}}">
                        <span >{{$brand->brand}}</span>
                    </a>
                    </div>
                </div>
            @endforeach
                <div class="brands-slot">
                    <div class="brand-slot-box">
                        <a  id="brand-all-brands" href="/markalar">
                            <img  src="/images/empty.png" alt="bmw">
                            <span>Tüm Markalar</span>
                        </a>
                    </div>
                </div>

        </div>
    </div>

    <div class="home-cars">
        <div class="home-cars-pad">

            @foreach($cars as $car)
            <div class="home-cars-slot">
                    <a href="/{{$car->brand_name}}/{{$car->model_name}}/{{$car->model_id}}">
                            <img alt="{{$car->model_spec}}" src="{{$car->picture}}">
                            <div class="compare-slot-text" >
                                <h4>{{$car->brand_name}}</h4>
                                <span>{{$car->model_name}} </span>
                                <span>{{$car->model_spec}}</span>
                            </div>
                        <div class="hovereffect"></div>
                    </a>
            </div>
                @endforeach

</div>
    </div>




    <div class="home-news">
    <div class="home-news-pad">
       @foreach($latestnews as $new)
            <a href="/haber/{{$new->id}}" >
            <div class="home-news-slot">
            <div class="news-slot-img">
                <img  alt="{{$new->id}}" src="{{$new->image}}">
            <a href="/haber/{{$new->id}}" class="news-title">{{$new->title}}</a>
            </div>
        </div>
            </a>
        @endforeach
    </div>
    </div>

  <div class="home-compare">
<div class="home-compare-pad">
    <div class="home-compare-box">
    @foreach($compare->take(2) as $co )
        @php
            $firstItem = $compare->get(0);
            $lastItem = $compare->get(1);
        @endphp

        <a href="/karsilastir/{{ $firstItem->model_id }}-{{ $lastItem->model_id }}">
    <div class="home-compare-slot" >

        <img alt="{{$co->model_spec}}" src="{{$co->picture}}" @if ($loop->first) id="slot-first-img" @endif>
        <div class="compare-slot-text" @if ($loop->first) id="slot-first-text" @endif>
        <h4>{{$co->brand_name}}</h4>
        <span>{{$co->model_name}} </span>
        <span>{{$co->model_spec}}</span>
        </div>
    </div>
        </a>
    @endforeach
    <img class="versus" alt="versus" src="/images/versus.png">
    </div>
        @php
            $remaining = $compare->slice(2);
        @endphp


            @php

                if (!$remaining->isEmpty()) {
        $firstItem1 = $remaining->first();
                    $lastItem1 = $remaining->skip(1)->first();
                    }
            @endphp
    <div class="home-compare-box">
    @foreach($remaining->take(2) as $co )
            <a href="/karsilastir/{{ $firstItem1->model_id }}-{{ $lastItem1->model_id }}">
                <div class="home-compare-slot">

                    <img alt="{{$co->model_spec}}" src="{{$co->picture}}" @if ($loop->first) id="slot-first-img" @endif>
                    <div class="compare-slot-text" @if ($loop->first) id="slot-first-text" @endif>
                    <h4>{{$co->brand_name}}</h4>
                    <span>{{$co->model_name}} </span>
                    <span>{{$co->model_spec}}</span>
                    </div>

                </div>
            </a>
        @endforeach
        <img class="versus" alt="versus" src="/images/versus.png">
    </div>
    @php
        $remaining2 = $remaining->slice(2);
    @endphp

    @php
        if (!$remaining2->isEmpty()) {
$firstItem2 = $remaining2->first();
            $lastItem2 = $remaining2->skip(1)->first();
            }
    @endphp
    <div class="home-compare-box">
        @foreach($remaining2->take(2) as $co )
            <a href="/karsilastir/{{ $firstItem2->model_id }}-{{ $lastItem2->model_id }}">
                <div class="home-compare-slot">

                    <img alt="{{$co->model_spec}}" src="{{$co->picture}}" @if ($loop->first) id="slot-first-img" @endif>
                    <div class="compare-slot-text" @if ($loop->first) id="slot-first-text" @endif>
                    <h4>{{$co->brand_name}}</h4>
                    <span>{{$co->model_name}} </span>
                    <span>{{$co->model_spec}}</span>
                    </div>
                </div>
            </a>
        @endforeach
            <img class="versus" alt="versus" src="/images/versus.png">
    </div>
    @php
        $remaining3 = $remaining2->slice(2);
    @endphp

    @php
        if (!$remaining3->isEmpty()) {
$firstItem3 = $remaining3->first();
            $lastItem3 = $remaining2->skip(1)->first();
            }
    @endphp
    <div class="home-compare-box">
        @foreach($remaining3->take(2) as $co )
            <a href="/karsilastir/{{ $firstItem3->model_id }}-{{ $lastItem3->model_id }}">
                <div class="home-compare-slot">

                    <img alt="{{$co->model_spec}}" src="{{$co->picture}}" @if ($loop->first) id="slot-first-img" @endif>
                    <div class="compare-slot-text" @if ($loop->first) id="slot-first-text" @endif>
                        <h4>{{$co->brand_name}}</h4>
                        <span>{{$co->model_name}} </span>
                        <span>{{$co->model_spec}}</span>
                    </div>
                </div>
            </a>
        @endforeach
        <img class="versus" alt="versus" src="/images/versus.png">
    </div>
</div>


  </div>




    </div>
</div>
</body>
@include('components/footer')

