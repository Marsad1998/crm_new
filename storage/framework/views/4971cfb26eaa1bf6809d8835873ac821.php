<?php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70"><i class="fas fa-link"></i> Manage Categories</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="/add_categories" class="formData" method="post">
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" class="form-control form-control-c" placeholder="Category Name" name="name" id="name"> 
                                </div>
                                <button type="submit" id="saveData" class="btn btn-c btn-primary btn-block">Save</button>
                            </form>
                        </div> 
                        <div class="col-sm-8">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover table-bordered align-middle" id="categoryTbl">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    </div>

    <div class="modal animate__animated animate__zoomIn animate__faster" id="servicesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Services for <span id="category_name"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="serviceForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="service_name" class="form-label">Service Name</label>
                            <input type="text" id="service_name" required class="form-control form-control-c">
                            <small id="service_name_error" class="text-danger error"></small>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary saveService">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {

                $(document).on('click', '.addOptions', function () {
                    var id = $(this).attr('id');
                    $('.saveService').attr('id', id);
                    $("#serviceForm").attr('action', 'add_services/')
                    $("#servicesModal").modal('show');
                });

                $(document).on('click', '.modifyService', function () {
                    var id = $(this).attr('id');
                    var type = $(this).data('type');
                    $.ajax({
                        type: "POST",
                        url: "/modify_service",
                        data: {
                            id: id,
                            type: type
                        },
                        dataType: "json",
                        success: function (response) {
                            if (type == 'edit') {
                                $('.saveService').attr('id', id);
                                $("#servicesModal").modal('show')
                                $("#service_name").val(response.name);
                                $("#serviceForm").attr('action', 'update_services/')
                            }else{
                                notif({
                                    type: response.sts,
                                    msg: response.msg,
                                    position: 'right',
                                    bottom: 10,
                                    time: 2000,
                                });    
                                categoryTbl.ajax.reload(null, false);
                            }
                        }
                    });
                });
                
                $("#serviceForm").on('submit', function (e) {
                    e.preventDefault();
                    var id = $('.saveService').attr('id');
                    var url = $("#serviceForm").attr('action')
                    $.ajax({
                        type: "POST",
                        url: url+id,
                        data: {
                            service_name: $("#service_name").val(),
                        },
                        dataType: "json",
                        success: function (response) {
                            $("#service_name").val('')
                            $("#servicesModal").modal('hide')
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            categoryTbl.ajax.reload(null, false);
                        },
                        error: function (response) {
                            console.log(response);
                            var errorResponse = $.parseJSON(response.responseText);
                            $(".error").text('');
                            $.each(errorResponse.errors, function (key, value) {
                                $("#" + key + "_error").text(value);
                            });
                        }
                    });
                });

                //Save Data into Database
                $(".formData").on('submit', function(e) {
                    e.preventDefault();
                    $("#saveData").prop('disabled', true);
                    var form = $('.formData');
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $(".formData").attr('action', '/add_categories');
                            $("#saveData").prop("disabled", false).text('Save').addClass('btn-primary').removeClass('btn-danger');
                            $('.formData').each(function() {
                                this.reset();
                            });
                            categoryTbl.ajax.reload(null, false);
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                        }, 
                        error: function (jqXhr) {
                            $("#saveData").prop("disabled", false);
                            var errorResponse = $.parseJSON(jqXhr.responseText);
                            $(".error").text('');
                            $.each(errorResponse.errors, function (key, value) {
                                $("#" + key + "_error").text(value);
                            });
                        }
                    }); //ajax call
                }); //main

                var categoryTbl = $("#categoryTbl").DataTable({
                    stateSave: true,
                    responsive: true,
                    "ajax": {
                        url: "/load_categories", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'action'
                        },
                    ],
                    drawCallback: function (settings) {
                        // Add click event listener to the plus button
                        $('.service-view').off('click').on('click', function () {
                            var class1 = $(this).data('class');
                            var id = $(this).attr('id');
                            var tr = $(this).closest('tr');
                            $("."+id).remove();

                            if (class1 == 'hide') {
                                $("#"+id).html('<i class="fe fe-minus"></i>');
                                $("#"+id).data('class', 'show');
                                console.log(settings.json.services);
                                var services = settings.json.services.filter(function (model) {
                                    return model.category_id == id.substr(4); // Filter services by make_id
                                });
                                console.log(services);
                                tr.after(formatChildRow(services, id));
                            }else{
                                $("#"+id).html('<i class="fe fe-plus"></i>');
                                $("#"+id).data('class', 'hide');
                            }
                        });
                    }
                }); 

                $(document).on('click', ".edit", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "/get_categories/" + id,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $("#saveData").text('Update').addClass('btn-danger').removeClass('btn-primary');
                            $(".formData").attr('action', '/update_categories/' + id);
                            $("#name").val(response.name)
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

                $(document).on("click", ".delete", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "DELETE",
                        url: "/delete_categories/" + id,
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            categoryTbl.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

                // Function to format the child row content
                function formatChildRow(models, id) {
                    if (!models || !Array.isArray(models) || models.length === 0) {
                        return '<tr class="'+id+'"><td colspan="2">No models available<td></tr>'; // Handle the case where models is empty or undefined
                    }

                    var table = "";
                    for (var i = 0; i < models.length; i++) {
                        var rand1 = Math.floor(Math.random()*90000) + 10000;
                        var rand2 = Math.floor(Math.random()*90000) + 10000;
                        var did = rand1+""+models[i].id+""+rand2
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td>' + models[i].name + '</td>\
                                    <td>\
                                        <button class="modifyService btn btn-sm ripple btn-outline-warning" data-type="edit" id="'+ btoa(did) +'">\
                                            <i class="fe fe-edit-2"></i>\
                                        </button>\
                                        <button class="modifyService btn btn-sm ripple btn-outline-danger" data-type="delete" id="'+ btoa(did) +'">\
                                            <i class="fe fe-trash"></i>\
                                        </button>\
                                    </td>\
                                </tr>';
                    }
                    return table;
                }
            }); // ready
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/category.blade.php ENDPATH**/ ?>