<script>
    $(document).ready(function () {
        $(".formData").on("submit", function (e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $(".saveData").prop("disabled", true);
                },
                success: function (response) {
                    notif({
                        type: response.sts,
                        msg: response.msg,
                        position: "right",
                        bottom: "10",
                    });
                    
                    $("#"+form.attr('id')).attr('action', form.attr('id')).attr('post')
                    $("#" + form.data("table")).DataTable().ajax.reload();
                    $(".formData").each(function () {
                        this.reset();
                        $(this).find("select").val(null).trigger("change");
                    });
                    $(".saveData").prop("disabled", false);
                    $(".error").text('');
                },
                error: function (jqXhr) {
                    $(".saveData").prop("disabled", false);
                    var errors = $.parseJSON(jqXhr.responseText);
                    showErrorMessages(errors);
                },
            });
        });

        $(document).on('click', '.delete', function () {
            var url = $(this).attr('id');
            var tbl = $(this).data('tbl');
            swal({
                title: "Are you sure?",
                text: "Your will not be able to recover this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function(){
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        $("#" + tbl).DataTable().ajax.reload();
                        notif({
                            type: response.sts,
                            msg: response.msg,
                            position: "right",
    
                        });
                        swal.close();
                    }
                });
            });
        });

        function showErrorMessages(errorResponse) {
            $(".error").text('');
            $.each(errorResponse.errors, function (key, value) {
                $("#" + key + "_error").text(value);
            });
        }
    });
</script><?php /**PATH C:\xampp\htdocs\upwork\quotegen\resources\views/tenant/script.blade.php ENDPATH**/ ?>