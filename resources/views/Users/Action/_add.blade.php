<!--begin::Modal-->
<div class="modal fade" id="add-modal" role="dialog" data-backdrop="static" tabIndex="-1" aria-labelledby="add-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title"></h5>
            </div>
            <form id="add-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama :</label>
                        <input required id="add-nama" name="nama"/>
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input required id="add-email" name="email" type="email"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                    <button type="submit" class="btn">Simpan</button>
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

        $("#add").click(function(){
            id = $(this).attr("id");
            $(".title").text("Tambah");

            $("#add-modal").modal("open");
        });

        $('#add-form').on('submit', function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/users",
                cache: false,
                method: "POST",
                data: $(this).serialize(),
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
                        $('#add-modal').modal('close');
                        dtableReload();
                    }
                }
            });
        });
    });
</script>
<!--end::Javascript-->
