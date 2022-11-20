<!--begin::Modal-->
<div class="modal fade" id="show-modal" role="dialog" data-backdrop="static" tabIndex="-1" aria-labelledby="show-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title title"></h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama :</label>
                    <span id="show-nama"></span>
                </div>
                <div class="form-group">
                    <label>Email :</label>
                    <span id="show-email"></span>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-red btn-flat ">Tutup</a>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Javascript-->
<script>
    $(document).ready(function(){
        var id;

        $(document).on('click', '.show', function(e){
            e.preventDefault();
            id = $(this).attr("id");
            $(".title").text("Rincian");

            $.ajax({
                url: "/users/" + id,
                cache: false,
                method: "GET",
                dataType: "json",
                success:function(data)
                {
                    if(data.success){
                        $("#show-nama").text(data.success.name);
                        $("#show-email").text(data.success.email);
                    }
                },
                error:function(data){
                    $.notify("System error.", "error");
                    console.log(data);
                },
                complete:function(data){
                    if(JSON.parse(data.responseText).success){
                        $("#show-modal").modal('open');
                    }
                }
            });
        })
    });
</script>
<!--end::Javascript-->
