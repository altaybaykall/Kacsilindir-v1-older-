
@section('title', 'Haberler')
@include('components/layout')
@vite(['resources/css/news.css'])
@vite(['resources/js/app.js'])
<body>
<div class="news-header">

    <div class="nh-row col   ">
        <h2>Haberler</h2>
        <small>Araba Dünyasından Son Haberler. </small>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="color:white" class="bi bi-stars ml-3"
             viewBox="0 0 16 16">
            <path
                d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z"/>
        </svg>
        <a href="/search/" class="header-search-icon" ><i class="fas fa-search mr-1"></i>  Haber Ara </a>

    </div>
</div>


<section class="section">
    <div class="container ">
        <div class="row">
            <div class="news-main col-lg-8 col-md-4 col-sm-4 col-xs-4">
                @if (session()->has('update'))
                    <div class="container container">
                        <div class="alert alert-danger text-enter bg-red">
                            {{session('update')}}
                        </div>
                    </div>
                @endif
                <div class="page-wrapper">


                    @foreach($news as $new)
                        <div class="blog-list clearfix ">
                            <div class="blog-box row">
                                <div class="col-md-5 p-0">
                                    <div class="post-media">
                                        <a href="/haber/{{$new->id}}" title="">
                                            <img src="{{$new->image}}" alt="haber-resim" >

                                        </a>
                                    </div>
                                </div>
                                <div class="blog-meta big-meta col-md-7 text-break ">
                                    <h4 class="text-break"><a class="text-break" href="/haber/{{$new->id}}" title="">{!!  Illuminate\Support\Str::limit($new->title,60,$end='...')  !!}</a></h4>
                                    <p class="text-break">{!! Illuminate\Support\Str::limit($new->content, 140, $end='...') !!}</p>
                                    @if($new->brand !== null)
                                        <small class="firstsmall"><a href="/haberler/{{$new->brand}}"
                                                                     title="">{{$new->brand}}</a></small>
                                    @endif
                                    <small>{{$new->created_at->format('d-m-Y')}}</small>
                                    <small>{{$new->getauthor->user_name}}</small>
                                    <small><i class="fa fa-eye"></i> {{$new->reads}}</small>
                                </div>
                            </div>
                            <hr class="invis">

                        </div>
                    @endforeach


                </div>
                {{$news->links()}}
            </div>

            <div class="col-lg-1 col-md-3 col-sm-3 col-xs-3">

            </div>
            <div class="news-other col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                <div class="sidebar">
                    <div class="widget">
                        <h2 class="widget-title mb-5">Popüler Haber</h2>

                    </div>
                    @foreach($trendnews as $on)
                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="{{$on->image}}" alt="trend-news-img" class="img-fluid">
                                <a href="/haber/{{$on->id}}" title=""></a>
                            </div>
                            <div class="blog-meta">
                                <h4 style="line-height: 22px"><a href="/haber/{{$on->id}}" title="">{!!  Illuminate\Support\Str::limit($on->title,70,$end='...')  !!}</a></h4>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <hr class="invis">
                </div>

                <div class="widget">
                    <h2 class="widget-title mt-5 mb-1">Son Haberler</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($latest as $lt)
                                <a href="/haber/{{$lt->id}}"
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="{{$lt->image}}" alt="latest-news-pp" class="img-fluid float-left">
                                    <h5 class="mb-1" style="overflow-wrap: break-word">{!!  Illuminate\Support\Str::limit($lt->title,45,$end='...')  !!}</h5>
                                    <small>{{$lt->created_at->format('Y')}}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>





</section>
</body>
@include('components.footer')

