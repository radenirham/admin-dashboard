<!--begin::Modal-->
<div class="modal fade" id="delete-modal" role="dialog" data-backdrop="static" tabIndex="-1" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title"></h5>
            </div>
            <form id="delete-form">
                <div class="modal-body">
                    <p>
                        Tekan tombol <span class="text-danger">Hapus</span>, jika anda yakin untuk menghapus data.
                    </p>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-red btn-flat ">Batal</a>
                    <button type="submit" class="btn">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Javascript-->
<script>
    $(document).ready(function(){
        var id;

        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            id = $(this).attr("id");
            $(".title").text("Hapus : " + $(this).attr("nama"));

            $("#delete-modal").modal('open');
        })

        $('#delete-form').on('submit', function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/users/" + id,
                cache: false,
                method: "DELETE",
                dataType: "json",
                success:function(data)
                {
                    if(data.success){
                        $.notify(data.success, "success");
                    }
                },
                error:function(data){
                    $.notify("System error.", "error");
                    console.log(data);
                },
                complete:function(data){
                    if(JSON.parse(data.responseText).success){
                        $('#delete-modal').modal('close');
                        dtableReload();
                    }
                }
            });
        });
    });
</script>
<!--end::Javascript-->
