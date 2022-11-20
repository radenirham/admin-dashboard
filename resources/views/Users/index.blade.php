@extends('Layout.index')

@section('content-title')
CRUD
@endsection

@section('content-main')
<h4 class="card-title">Data User</h4>
<button class="btn mb-2" id="add">Tambah Data</button>
<table id="dtable" class="display">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Dibuat</th>
            <th>Terakhir Diupdate</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
@endsection

@section('content-modal')
@include('Users.Action._add')
@include('Users.Action._edit')
@include('Users.Action._delete')
@include('Users.Action._show')
@endsection

@section('content-js')
<script>
    var dtable = $('#dtable').DataTable({
        language : {
            searchPlaceholder: "Ketik disini ..."
        },
        serverSide : true,
        ajax : "/users",
        columns : [
            { data: 'name' },
            { data: 'email' },
            { data: 'created_at' },
            { data: 'updated_at', format: 'M/D/YYYY' },
            { data: 'action' },
        ],
        stateSave : true,
        deferRender : true,
        pageLength : 5,
        aLengthMenu : [[5,10,25,50,100], [5,10,25,50,100]],
        aoColumnDefs: [
            { "bSortable": false, "aTargets": [4] },
            { "bSearchable": false, "aTargets": [4] }
        ],
        scrollY : "50vh",
    });

    setInterval(function(){
        dtableReload();
    }, 60000);

    function dtableReload(){
        dtable.ajax.reload(function(){
            console.log("Refresh Automatic")
        }, false);
    }
</script>
@endsection
