@section('title', 'Haberler')
@include('adminpanel/dashboard')
<div class="dashboard-block2">
<div class ="brandinfo" >
    <div class="col-lg-10 pl-lg-3 pb-3 mb-3">
        <div class="allnews-header mb-4 mt-2">
            <h3>Haberler</h3>

             <small>{{$count}} Haber bulundu</small>
            @if (session()->has('Update'))
                <div class="alert-box2">
                    <span >{{session('Update')}}</span>
                </div>
            @endif
             <a href="/news/add"  class="btn btn-success btn-sm mx-5 mb-2" role="button"><svg viewBox="0 0 20 20" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"></path> </g></svg> Yeni Haber ekle </a>
         </div>
            <input type="text" id="myInput" onkeyup="searchTable()" placeholder="İsim ile Filtrele..">
        <table class="table table-striped table-responsive-sm" id="myTable">

            <caption>Haberler</caption>
            <thead >
            <tr id='tableHeader' class="bg-dark text-white">
                <th>Id</th>
                <th id="name">Başlık</th>
                <th id="name">Yazar</th>
                <th>Kategori</th>
                <th>Tarih</th>
                <th>Görüntülenme</th>
                <th>Yorum</th>
                <th>Düzenle</th>

            </tr>
            </thead>
            <tbody>
            @foreach($news as $n)
                <tr>
                    <td>{{$n->id}}</td>
                    <td><a style="color: #c23d00 " href="/haber/{{$n->id}}/" >{!!  Illuminate\Support\Str::limit($n->title,30,$end='...')  !!}</a></td>
                    <td>{{$n->getauthor->user_name}}</td>
                    <td>{{$n->brand}}</td>
                    <td>{{$n->created_at->format('d/m/Y')}}</td>
                    <td><i class="fa fa-eye"></i> {{$n->reads}} </td>
                    <td>{{$n->comments_count}}</td>
                    <td class="edit"> @can('editor')
                            @can('update',$n)
                                <span class="pt-2 ">
                                          <a href="/haber/{{$n->id}}/edit" class="text-primary mr-2 !bg-dark"
                                             data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                  class="fas fa-edit fa-sm ml-2"></i></a>
                                        @method('UPDATE')
                                        </span>
                              @endcan
                        @endcan</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$news->links()}}
</div>
    </div>
</div>
</div>

<script>
    function searchTable() {
        var input, filter, found, table, tr, td, i, j;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@include('components.footer')
