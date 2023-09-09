<!DOCTYPE html>
@include('components/layout')
<head>
    @vite(['resources/css/compare.css'])
    @livewireStyles
</head>
<div class="main-block-light-compare">
<div class="select-main">
    <div class="select-body">

        <div class="navs-top-brands">
            <a href="/en-azyakan-arabalar">En Az Yakanlar</a>
            <a href="/en-cokyakan-arabalar">Çok Yakanlar</a>
            <a href="/en-hizli-arabalar">En Hızlılar</a>
            <a href="/en-yavas-arabalar">En Yavaşlar</a>
            <a href="/elektrikliler">Elektrikliler</a>
            <a href="/rastgele">Rastgele</a>
            <a href="/yakit-hesapla">Tüketim Hesapla</a>
        </div>
        <div class="select-nav">
            <span><a href="/"> Anasayfa </a> /  Karşılaştırma </span>
        </div>
        <div class="select-header">
            <span>

                Karşılaştırmak için araba seçin

            </span>
        </div>
        <div class="select-box ">


            @livewire('compare')


        </div><!--selectbox-->
    </div><!--compare-body-->
</div><!--compare-main-->
</div>
@livewireScripts

@include('components/footer')
