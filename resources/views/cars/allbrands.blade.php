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
        <a href="/rastgele">Rastgele</a>
        <a href="/elektrikliler">Elektrikliler</a>
        <a href="/yakit-hesapla">Tüketim Hesapla</a>
    </div>

</div>


<div class="modelselect-main">
    <span class="mb-2 ml-3"> <h1 class="mb-2 ml-4" style="font-size: 1.5rem;font-weight: 600;margin-bottom: 15px"> Tüm Markalar</h1> </span>

    <div class="home-brands">
        <div class="brands-pad">
            @foreach($brands as $brand)
                <div class="brands-slot">
                    <div class="brand-slot-box">
                        <a href="/{{$brand->brand}}">
                            <img  src="{{$brand->logo}}" alt="{{$brand->brand}}">
                            <span >{{$brand->brand}}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


</div>
@include('components.footer')
