@section('title', 'Panel')
@include('adminpanel/dashboard')


<div class="dashboard-block">
    <div class="dash-main">

        <div class="dash-nav">
            <div class="dash-nav-left">

                <span>{{ date('Y-m-d H:i') }}</span>
            </div>
            <div class="dash-nav-right">

                <a class="ml-1" href="/profile"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-lines-fill ml-2" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                    </svg></a>
                <a class="ml-1" href="{{ url('/logout') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left ml-2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg></a>
            </div>
        </div>


        <div class="topper-info">
            <div class="info-box">

                <div class="info-box-content">
                    <span class="ibc-header"> Aktif Kullanıcı </span>
                    <span class="ibc-content">{{$online}}</span>
                    <span class="ibc-inc">  {{$visit}} Bugün Görüldü</span>
                </div>
                <div>
                    <img class="info-box-img"
                         src="/images/profileicongreen.png">
                </div>
            </div>
            <div class="info-box">

                <div class="info-box-content">
                    <span class="ibc-header"> Toplam Kullanıcı</span>
                    <span class="ibc-content">{{$users}}</span>
                    <span class="ibc-inc"> {{$newuser}} Kişi Bugün Kayıt oldu</span>
                </div>
                <div>
                    <img class="info-box-img" src="/images/profileiconblue.png">
                </div>
            </div>
            <div class="info-box">

                <div class="info-box-content">
                    <span class="ibc-header"> Araba Sayısı</span>
                    <span class="ibc-content"> {{$cars}}</span>
                    <span class="ibc-inc"> {{$cardate}} Son bir haftada eklendi</span>
                </div>
                <div>
                    <img class="info-box-img" src="/images/speciconog.png">
                </div>
            </div>
            <div class="info-box">

                <div class="info-box-content">
                    <span class="ibc-header"> Haber Sayısı</span>
                    <span class="ibc-content"> {{$news}}</span>
                    <span class="ibc-inc"> {{$newsdate}} Son bir haftada eklendi</span>
                </div>
                <div>
                    <svg viewBox="0 0 28 28" class="info-box-img"  version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" fill="#222222">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="ic_fluent_news_28_filled" fill="#d43d9a" fill-rule="nonzero">
                                    <path
                                        d="M22,5.75 L22,20.5 C22,20.7761424 22.2238576,21 22.5,21 C22.7454599,21 22.9496084,20.8231248 22.9919443,20.5898756 L23,20.5 L23,7 L24.25,7 C25.1681734,7 25.9211923,7.70711027 25.9941988,8.60647279 L26,8.75 L26,20.75 C26,22.4830315 24.6435452,23.8992459 22.9344239,23.9948552 L22.75,24 L5.25,24 C3.51696854,24 2.10075407,22.6435452 2.00514479,20.9344239 L2,20.75 L2,5.75 C2,4.8318266 2.70711027,4.07880766 3.60647279,4.0058012 L3.75,4 L20.25,4 C21.1681734,4 21.9211923,4.70711027 21.9941988,5.60647279 L22,5.75 L22,20.5 L22,5.75 Z M9.74652744,13.0034726 L7.25,13.0034726 C6.3318266,13.0034726 5.57880766,13.7105828 5.5058012,14.6099454 L5.5,14.7534726 L5.5,17.25 C5.5,18.1681734 6.20711027,18.9211923 7.10647279,18.9941988 L7.25,19 L9.74652744,19 C10.6647008,19 11.4177198,18.2928897 11.4907262,17.3935272 L11.4965274,17.25 L11.4965274,14.7534726 C11.4965274,13.8352992 10.7894172,13.0822802 9.89005465,13.0092738 L9.74652744,13.0034726 Z M17.75,17.5 L14.25,17.5 L14.1482294,17.5068466 C13.7821539,17.556509 13.5,17.8703042 13.5,18.25 C13.5,18.6296958 13.7821539,18.943491 14.1482294,18.9931534 L14.25,19 L17.75,19 L17.8517706,18.9931534 C18.2178461,18.943491 18.5,18.6296958 18.5,18.25 C18.5,17.8703042 18.2178461,17.556509 17.8517706,17.5068466 L17.75,17.5 Z M7.25,14.5034726 L9.74652744,14.5034726 C9.86487417,14.5034726 9.96401426,14.585706 9.98992476,14.6961499 L9.99652744,14.7534726 L9.99652744,17.25 C9.99652744,17.3683467 9.91429402,17.4674868 9.80385014,17.4933973 L9.74652744,17.5 L7.25,17.5 C7.13165327,17.5 7.03251318,17.4177666 7.00660268,17.3073227 L7,17.25 L7,14.7534726 C7,14.6351258 7.08223341,14.5359857 7.19267729,14.5100752 L7.25,14.5034726 L9.74652744,14.5034726 L7.25,14.5034726 Z M17.75,13.0034726 L14.25,13.0034726 L14.1482294,13.0103192 C13.7821539,13.0599816 13.5,13.3737768 13.5,13.7534726 C13.5,14.1331683 13.7821539,14.4469635 14.1482294,14.4966259 L14.25,14.5034726 L17.75,14.5034726 L17.8517706,14.4966259 C18.2178461,14.4469635 18.5,14.1331683 18.5,13.7534726 C18.5,13.3737768 18.2178461,13.0599816 17.8517706,13.0103192 L17.75,13.0034726 Z M17.75,8.49665793 L6.25,8.49665793 L6.14822944,8.50350455 C5.78215388,8.55316697 5.5,8.86696217 5.5,9.24665793 C5.5,9.6263537 5.78215388,9.94014889 6.14822944,9.98981132 L6.25,9.99665793 L17.75,9.99665793 L17.8517706,9.98981132 C18.2178461,9.94014889 18.5,9.6263537 18.5,9.24665793 C18.5,8.86696217 18.2178461,8.55316697 17.8517706,8.50350455 L17.75,8.49665793 Z"
                                        id="🎨-Color"></path>
                                </g>
                            </g>
                        </g>
                    </svg>

                </div>
            </div>


        </div>

        <div class="dash-middle">
            <div class="dash-middle-profile">
          <div class="dash-pp">
              <img class="dash-pp-img" src="{{Auth::user()->avatar}}">
          </div>
                <div class="dash-pp-content">
                    <div class="dash-pp-name">
                        <span>Selam,  <strong>{{Auth::user()->user_name}}</strong></span>
                        <span @if(Auth::user()->type == 'admin') style="font-weight:bold ; color:red; font-size: 14px @endif "
                              @if(Auth::user()->type == 'editor') style="font-weight:bold ; color:blue;font-size: 14px @endif ">{{Auth::user()->type}}</span>
                    </div>
                    <div class="dash-pp-infos">
                        @if(!$previousVisit == null)
                        <span >Son Erişim </span>

                        <span> {{$previousVisit->ip}} {{$previousVisit->platform}} {{$previousVisit->browser}}  </span>
                        @else
                            <span style="font-size: 13px">Son Erişim Bulunamadı </span>
                        @endif
                    </div>

                </div>


            </div>
            <div class="dash-middle-content" >
                <div class="dmc-header">
                    <h4 style="margin:0">Projeler</h4>
                </div>
                <ul id="todolist">
                    @foreach($list as $li)
                        <li>
                            <div>

                                <p class="todolist-content">{{$li->content}}</p>
                                <p class="todolist-title">{{$li->created_at->format('d-m-Y')}}</p>
                            </div>
                                <div>
                                <a href="/todolist/delete/{{$li->id}}">
                                    <svg viewBox="0 0 24 24" width="25px" height="25px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="white"></rect> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM15.7071 9.29289C16.0976 9.68342 16.0976 10.3166 15.7071 10.7071L12.0243 14.3899C11.4586 14.9556 10.5414 14.9556 9.97568 14.3899L11 13.3656L9.97568 14.3899L8.29289 12.7071C7.90237 12.3166 7.90237 11.6834 8.29289 11.2929C8.68342 10.9024 9.31658 10.9024 9.70711 11.2929L11 12.5858L14.2929 9.29289C14.6834 8.90237 15.3166 8.90237 15.7071 9.29289Z" fill="#5d9b3b"></path> </g></svg>
                                </a>
                                 </div>
                        </li>
                    @endforeach
                </ul>
                <form action="/todolist/add" method="POST" id="todolistadd">
                    @csrf

                    <input  name="content" id="content" class="form-control todolist-input" type="text" placeholder="..." autocomplete="off" />


                </form>
            </div>
            <div class="dash-middle-content-notlist" >
                <div class="dmc-header">
                    <h4 style="margin:0">Notlarım</h4>
                </div>
                <ul id="todolist">
                    @foreach($notlist as $li)
                        <li>
                            <div>

                                <p class="todolist-content">{{$li->content}}</p>
                                <p class="todolist-title">{{$li->created_at->format('d-m-Y')}}</p>
                            </div>
                            <div>
                                <a href="/notlist/delete/{{$li->id}}">
                                    <svg viewBox="0 0 24 24" width="25px" height="25px" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="24" height="24" fill="white"></rect> <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25007 2.38782C8.54878 2.0992 10.1243 2 12 2C13.8757 2 15.4512 2.0992 16.7499 2.38782C18.06 2.67897 19.1488 3.176 19.9864 4.01358C20.824 4.85116 21.321 5.94002 21.6122 7.25007C21.9008 8.54878 22 10.1243 22 12C22 13.8757 21.9008 15.4512 21.6122 16.7499C21.321 18.06 20.824 19.1488 19.9864 19.9864C19.1488 20.824 18.06 21.321 16.7499 21.6122C15.4512 21.9008 13.8757 22 12 22C10.1243 22 8.54878 21.9008 7.25007 21.6122C5.94002 21.321 4.85116 20.824 4.01358 19.9864C3.176 19.1488 2.67897 18.06 2.38782 16.7499C2.0992 15.4512 2 13.8757 2 12C2 10.1243 2.0992 8.54878 2.38782 7.25007C2.67897 5.94002 3.176 4.85116 4.01358 4.01358C4.85116 3.176 5.94002 2.67897 7.25007 2.38782ZM15.7071 9.29289C16.0976 9.68342 16.0976 10.3166 15.7071 10.7071L12.0243 14.3899C11.4586 14.9556 10.5414 14.9556 9.97568 14.3899L11 13.3656L9.97568 14.3899L8.29289 12.7071C7.90237 12.3166 7.90237 11.6834 8.29289 11.2929C8.68342 10.9024 9.31658 10.9024 9.70711 11.2929L11 12.5858L14.2929 9.29289C14.6834 8.90237 15.3166 8.90237 15.7071 9.29289Z" fill="#5d9b3b"></path> </g></svg>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <form action="/notlist/add" method="POST" id="todolistadd">
                    @csrf

                    <input  name="content" id="content" class="form-control todolist-input" type="text" placeholder="..." autocomplete="off" />


                </form>
            </div>
        </div>
        <div class="dash-end">
            <div class="dash-middle-content" style="height: 450px">
                <div class="dmc-header">
                    <h4 style="margin:0">Takım</h4>
                </div>
                <ul>
                    @foreach($admins as $ad)
                        <li>
                            <div>
                                <img class="team-avatar" src="{{$ad->avatar}}">

                            </div>
                            <div>
                                <p class="team-name">{{$ad->user_name}}</p>
                                <p class="team-status"
                                  @if($ad->isOnline() == 1 )
                                      style="color:limegreen">Online
                                      @else
                                      style="color: red;">Offline
                                  @endif


                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>



    </div>




</div>

</div>

@include('components.footer')
