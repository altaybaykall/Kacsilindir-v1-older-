@section('title', $news->title)
@include('components/layout')
@vite(['resources/css/news.css'])
<head>
    @vite(['resources/css/singlenews.css'])
</head>
<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb ">
                            <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="/haberler">Haberler</a></li>
                            <li class="breadcrumb-item active"><a href="/haber/{{$news->id}}">{{$news->title}}</a></li>
                        </ol>
                        @if (session()->has('update'))
                            <div class="container container">
                                <div class="alert alert-success text-enter bg-red">
                                    {{session('update')}}
                                </div>
                            </div>
                        @endif
                        @if($news->brand !== null)
                            <span class="spanbrand"><a href="/haberler/{{$news->brand}}">{{$news->brand}}</a></span>
                        @else
                            <span class="spanbrand"><a href="/haberler">Haberler</a></span>
                        @endif
                        <h3>{{$news->title}}</h3>

                        <div class="blog-meta big-meta mb-0 mt-3">
                            <div class="post-media-auth">
                                <img alt="author-pp" class="avatar-small" src="{{$news->getauthor->avatar}}"/>
                                <small>{{$news->created_at->format('d M Y')}}</small>
                                <small>{{$news->getauthor->user_name}}</small>
                                <small><i class="fa fa-eye"></i> {{$news->reads}}</small>
                            </div>
                            <div class="edit">

                                @can('editor')
                                    @can('update',$news)
                                        <span class="remove-comment pt-2 ">
                                          <a href="/haber/{{$news->id}}/edit" class="text-primary mr-2 !bg-dark"
                                             data-toggle="tooltip" data-placement="top" title="Edit">Düzenle<i
                                                  class="fas fa-edit fa-lg ml-2"></i></a>
                                        @method('UPDATE')
                                        </span>
                                    @endcan
                                @endcan

                            </div>

                        </div>
                        <div class="single-post-media">
                            <img src="{{$news->image}}" alt="single-post-img" class="img-fluid">
                        </div>

                        <div class="blog-content">
                            <div class="pp">
                                <p>{!!  $news->content!!} </p>
                            </div>
                        </div>
                        <div class="blog-title-area" style="justify-content: left">
                            <div class="tag-cloud-single">
                                <span class="spanbrand"> Etiketler</span>
                                <small><a href="#" title="">Araba</a></small>
                                <small><a href="#" title="">Araç</a></small>
                                <small><a href="#" title="">{{$news->brand}}</a></small>

                            </div>
                        </div>


                        <hr class="invis1">
                    </div>

                    <div class="custombox clearfix">
                        <div class="row">

                            <div class="col-lg-12">
                                @auth
                                    <div class="media  ml-2 mt-2">

                                        <img alt="comment-owner" src="{{Auth::user()->avatar}}" class="comment-owner">

                                        <h4 class="comment-owner"> {{Auth::user()->user_name}}</h4>
                                    </div>

                                    <form class="form-wrapper" action="{{  route ('NewCommentSave',[$news->id])  }}"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" class="form-control" maxlength="255" name="comment"
                                               placeholder="Yorum ekleyin...">
                                        <button type="submit" class="btn btn-primary" hidden>Yorum Yap</button>
                                    </form>
                                @else
                                    <div class="comment-owner mb-4">
                                        <img alt="comment-owner-not" src="/images/profileiconblack.png" class="owner-avatar">
                                        <h4> Yorum Yapmak için <a href="/login">Giriş</a> Yapınız</h4>
                                    </div>

                                @endauth
                            </div>

                        </div>


                        <h4 class="small-title ">{{$comments->count()}} Yorum</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">

                                    @foreach($comments->reverse() as $comm)
                                        <div class="media">
                                            <a class="media-left" href="#">
                                                <img src="{{$comm->commentby->avatar}}" alt="commenter-pp" class="rounded-circle">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading user_name mb-0">{{$comm->commentby->user_name}}
                                                    <small>{{$comm->created_at->diffForHumans()}}</small></h4>
                                                <p> {{$comm->comment}}</p>
                                            </div>

                                            @can('update',$comm)
                                                <span class="remove-comment pt-2 ">
                                          <a href="{{ route ('DeleteComment',[$comm->comment_id]) }}"
                                             class="text-danger mr-2 !bg-dark" data-toggle="tooltip"
                                             data-placement="top">Yorumu Sil <svg fill="#ff0000"
                                                                                  viewBox="-3.5 0 19 19"
                                                                                  height="15px"
                                                                                  width="15px"
                                                                                  xmlns="http://www.w3.org/2000/svg"
                                                                                  class="cf-icon-svg"
                                                                                  stroke="#ff0000"><g
                                                      id="SVGRepo_bgCarrier" stroke-width="0"></g><g
                                                      id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                      stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path
                                                          d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path></g></svg></a>
                                        @method('UPDATE')

                                                </span>
                                            @endcan


                                        </div>

                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

            <div class="news-other col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">

                            </div>
                        </div>
                    </div>

                    <div class="widget">
                        <h2 class="widget-title">Trend Haberler</h2>
                        <hr class="invis1">
                        <div class="trend-videos">
                            @foreach($othernew as $on)
                                <div class="blog-box">
                                    <div class="post-media">
                                        <a href="/haber/{{$on->id}}" title="">
                                            <img src="{{$on->image}}" alt="other-news-img" class="blog-box-img">
                                        </a>
                                    </div>
                                    <div class="blog-meta">
                                        <h4 style="line-height: 22px"><a href="/haber/{{$on->id}}"
                                                                         title="">{!!  Illuminate\Support\Str::limit($on->title,45,$end='...')  !!}</a>
                                        </h4>
                                    </div>

                                    <hr class="invis">
                                    @endforeach


                                </div>
                        </div>

                        <div class="widget">
                            <h2 class="widget-title">Son Haberler</h2>
                            <hr class="invis">
                            <div class="blog-list-widget">
                                <div class="list-group">
                                    @foreach($latest as $lt)
                                        <a href="/haber/{{$lt->id}}"
                                           class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{$lt->image}}" alt="latest-news-img" class="img-fluid float-left">
                                                <h5 class="mb-1">{!!  Illuminate\Support\Str::limit($lt->title,45,$end='...')  !!}</h5>
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
        </div>
    </div>
</section>


@include('components.footer')
