@section('title', 'Kullanıcılar')
@include('adminpanel/dashboard')
<div class="dashboard-block2">
    <div class ="brandinfo" >
        <div class="col-lg-10 pl-lg-3 pb-3 mb-3">

            <div class="allnews-header mb-4 mt-2">
                <h3 class="mb-2">Kullanıcılar</h3>

                <small >{{$count}} Kişi Mevcut </small>
                @if (session()->has('Update'))
                    <div class="alert-box2">
                          <span >{{session('Update')}}</span>
                 </div>
                @endif
            </div>
            <input type="text" id="myInput" onkeyup="searchTable()" placeholder="İsim ile Filtrele..">

            <table class="myusers table table-striped table-responsive-sm " id="myTable">

            <caption>Kullanıcı listesi</caption>
                <thead >
                <tr id='tableHeader' class="bg-dark text-white">
                    <th>Id</th>
                    <th id="name">Ad</th>
                    <th>E-posta</th>
                    <th>Katılma Tarih</th>
                    <th>Avatar</th>
                    <th>Yetki</th>
                    @can('admin')<th>Ban</th>@else <th></th>@endcan
                    @can('admin')<th>Düzenle</th>@else <th></th>@endcan
                </tr>
                </thead>
                <tbody>
                @foreach($users as $n)
                    <tr>
                        <td>{{$n->id}}</td>
                        <td>{{$n->user_name}}</td>
                        <td>{{$n->email}}</td>
                        <td>{{$n->created_at->format('d/m/Y')}}</td>
                        <td><img alt="resmim"  src="{{$n->avatar}}" /></td>
                        <td @if($n->type == 'admin') style="font-weight:bold ; color:red @endif"
                            @if($n->type == 'editor') style="font-weight:bold ; color:blue @endif"> {{$n->type}}
                        </td>
                        @can('admin')
                            @if($n->type !== 'admin')

                                <td> <a href="{{  route ('UserBan',[$n->id])  }}"
                                   @if($n->status == 0) style="color:gray " onclick="return confirm('Kullanıcıyı Banlamak istediğine emin misin?')"  >Temiz</a>

                                    @endif
                                    @if($n->status == 1) style="color:red" onclick="return confirm('Banı Açmak istediğine emin misin?')"           > Banlı </a>            @endif

                                </td>
                            @else
                                <td></td>
                            @endif
                        @else
                            <td></td>
                        @endcan



                        @if (Auth::user()->type == 'admin')
                                    @if($n->type !== 'admin')

                                <td> <a href ="{{  route ('UserEdit',[$n->id])  }}"   ><i class="fas fa-edit  ml-2"></i>

                               </a> </td>
                            @else
                                <td></td>

                            @endif
                        @else
                            <td></td>@endif

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>

    </div>
    </div>
    </div>
</div>
@include('components.footer')
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

