<?php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use Spatie\Permission\Models\Permission;
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70 text-black"><i class="fas fa-cogs"></i> Assign Permissions</h3>

            <div class="row row-sm">
                <div class="col-sm-12">
                    <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                        <div class="card-body">
                            <form action="/assign_permissions" class="formData" method="post">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="role_id">Roles</label>
                                        <select class="form-control form-control-c" required name="role_id" id="role_id">
                                            <option value="">~~ SELECT ~~</option>
                                            <?php
                                                $roles = Role::where('name', '!=', 'super-admin')
                                                    ->orderBy('name', 'asc')
                                                    ->get();
                                            ?>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->id); ?>"> <?php echo e($role->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div> 
                                    <div class="col-sm-8">
                                        <label for="" class="">.</label><br>
                                        <button type="submit" id="saveData" class="btn btn-c btn-primary">Save</button>
                                    </div> 
                                </div> 
                            </form>
                            <br><br>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th class="d-flex justify-content-between">
                                                <label for="all_check">Check All</label>
                                                <input id="all_check" type="checkbox">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $permissions = Permission::select('model_name')->groupBy('model_name')->get();
                                        ?>
                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="bg-info"> <?php echo e($item->model_name); ?> </td>
                                                <?php $__currentLoopData = Permission::where('model_name', $item->model_name)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td>
                                                        <div class="d-flex justify-content-between"> 
                                                            <label for="permission_<?php echo e($per->id); ?>"><?php echo e($per->name); ?></label>
                                                            <span>
                                                                <input type="checkbox" class="permission" id="permission_<?php echo e($per->id); ?>" value="<?php echo e($per->id); ?>">
                                                            </span>
                                                        </div>
                                                    </td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
    </div>
    <?php $__env->startPush('script'); ?>
        <script>
            $(document).ready(function() {

                //Save Data into Database
                $(".formData").on('submit', function(e) {
                    e.preventDefault();
                    $("#saveData").prop('disabled', true);
                    var form = $('.formData');
                    var permission = $('.permission').map(function() {
                        if ($(this).is(':checked')) {
                            return this.value;
                        }
                    }).get();
                    $.ajax({
                        type: 'POST',
                        url: form.attr('action'),
                        data: {
                            permission: permission,
                            role_id: $("#role_id").val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            $("#saveData").text('Save').removeClass('btn-warning').addClass(
                                'btn-danger').prop('disabled', false);
                            $('.formData').each(function() {
                                this.reset();
                            });
                            $('#all_check').prop('checked', false)
                            permissionTable.ajax.reload(null, false);
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                        },
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    }); //ajax call
                }); //main

                $(document).on("click", "#all_check", function() {
                    if ($(this).is(':checked')) {
                        $(".permission").prop('checked', true);
                    } else {
                        $(".permission").prop('checked', false);
                    }
                });

                var groupColumn = 2;
                var permissionTable = $("#permissionTable").DataTable({
                    // sDom: "sfp",
                    pageLength: 100,
                    stateSave: true,
                    responsive: true,
                    "ajax": {
                        url: "/load_assign_permissions", // json datasource
                        type: 'post', // method  , by default get
                    },
                    "order": [
                        [groupColumn, 'asc']
                    ],
                    "columnDefs": [{
                        targets: 2,
                        visible: false
                    }],
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before(
                                    '<tr class="bg-danger"><td colspan="5">' +
                                    group +
                                    '</td></tr>'
                                );

                                last = group;
                            }
                        });
                    },
                    rowGroup: {
                        className: 'table-group'
                    },
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'model_name'
                        },
                        {
                            data: 'action'
                        },
                    ]
                });

                $(document).on('change', "#role_id", function() {
                    var id = $(this).val();
                    $(".permission").prop('checked', false);
                    if (id != "") {
                        $.ajax({
                            type: "POST",
                            url: "/get_permissions_sync/" + id,
                            dataType: "json",
                            success: function(response) {
                                $.each(response, function(i, value) {
                                    $("#permission_" + value.id).prop('checked', true)
                                });
                            }, 
                            error: function (response) {
                                swal("Oops", response.responseJSON.message, "error");
                            }
                        });
                    }
                });
            }); // ready
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\upwork\monties\resources\views/tenant/assign_permission.blade.php ENDPATH**/ ?>