@section('title', 'Arabalar')
@include('adminpanel/dashboard')
<div class="dashboard-block2">
<div class ="brandinfo" >
    <div class="col-lg-10 pl-lg-3 pb-3 mb-3">
        <div class="allnews-header mb-4 mt-2">
            <h3>Arabalar</h3>

            <small>{{$carscount}} Model Mevcut</small>
            @if (session()->has('Update'))
                <div class="alert-box2">
                    <span >{{session('Update')}}</span>
                </div>
            @endif
            <a href="/model/add"  class="btn btn-success btn-sm mx-5 mb-2" role="button"><svg viewBox="0 0 20 20" width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" fill-rule="evenodd" d="M9 17a1 1 0 102 0v-6h6a1 1 0 100-2h-6V3a1 1 0 10-2 0v6H3a1 1 0 000 2h6v6z"></path> </g></svg> Yeni Model ekle </a>
        </div>
        <input type="text" id="myInput" onkeyup="searchTable()" placeholder="İsim ile Filtrele..">
        <table class="table table-striped table-responsive-sm" id="myTable">

            <caption>Modeller</caption>
            <thead >
            <tr id='tableHeader' class="bg-dark text-white">
                <th>Id</th>
                <th >Marka</th>
                <th id="name">Model</th>
                <th>Model</th>
                <th>Yıl</th>
                <th>Resim</th>
                <th>Düzenle</th>


            </tr>
            </thead>
            <tbody>
            @foreach($cars as $n)
                <tr>
                    <td>{{$n->model_id}}</td>
                    <td>{{$n->brand_name}}</td>

                   <td>{{$n->model_name}} </td>
                    <td>{{$n->model_spec}}</td>
                  <td>{{$n->production_year}}</td>
                    <td><img alt="resmim" id="allbrand-model" src="{{$n->picture}}" /></td>
                    <td class="edit"> @can('editor')

                            <span class="pt-2 ">
                                          <a href="/model/{{$n->model_id}}/edit" class="text-primary mr-2 !bg-dark"
                                             data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                  class="fas fa-edit fa-sm ml-2"></i></a>
                                        @method('UPDATE')
                                        </span>

                        @endcan</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$cars->links()}}
    </div>

</div>
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
