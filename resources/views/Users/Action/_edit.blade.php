<!--begin::Modal-->
<div class="modal fade" id="edit-modal" role="dialog" data-backdrop="static" tabIndex="-1" aria-labelledby="edit-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title"></h5>
            </div>
            <form id="edit-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama :</label>
                        <input required id="edit-nama" name="nama"/>
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input required id="edit-email" name="email" type="email"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
                    <button type="submit" class="btn">Update</button>
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

        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            id = $(this).attr("id");
            $(".title").text("Edit");

            $.ajax({
                url: "/users/" + id + "/edit",
                cache: false,
                method: "GET",
                dataType: "json",
                success:function(data)
                {
                    if(data.success){
                        $("#edit-nama").val(data.success.name);
                        $("#edit-email").val(data.success.email);
                    }
                },
                error:function(data){
                    $.notify("System error.", "error");
                    console.log(data);
                },
                complete:function(data){
                    if(JSON.parse(data.responseText).success){
                        $("#edit-modal").modal('open');
                    }
                }
            });
        });

        $('#edit-form').on('submit', function(e){
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/users/" + id,
                cache: false,
                method: "PUT",
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
                        $('#edit-modal').modal('close');
                        dtableReload();
                    }
                }
            });
        });
    });
</script>
<!--end::Javascript-->
