@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">
                    <i class="fas fa-users"></i> Users
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered align-middle" id="usersTbl">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
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
    
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content br-radius-10">
                <div class="modal-header">
                    <h5 class="modal-title" id="userTitle">Add a user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/users" method="post" class="formData" id="users">
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Name</label>
                            <input type="text" name="user_name" id="user_name" class="form-control">
                            <small id="user_name_error" class="text-danger error"></small>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" name="user_email" id="user_email" class="form-control">
                            <small id="user_email_error" class="text-danger error"></small>
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" autocomplete="off" name="user_password" id="user_password" class="form-control">
                            <small id="user_password_error" class="text-danger error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-control" name="role_id" id="role_id">
                            </select>
                            <small id="role_id_error" class="text-danger error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Role</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">~~ SELECT ~~</option>
                                <option value="active">Active</option>
                                <option value="inactive">In Active</option>
                            </select>
                            <small id="status_error" class="text-danger error"></small>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary saveData">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        {{-- @include('tenant.script') --}}
        <script>
            $(document).ready(function () {
    
                var users = $("#usersTbl").DataTable({
                    stateSave: true,
                    responsive: true,
                    lengthMenu: [
                        [50, 100, 500, -1],
                        [50, 100, 500, 'All']
                    ],
                    dom: '<"row"<"col-sm-4"l><"col-sm-4"B><"col-sm-4"f>>rt<"row"<"col-sm-4"i><"col-sm-4"><"col-sm-4"p>>',
                    buttons: [
                        {
                            className: "mx-2",
                            text: '<i class="fas fa-plus-circle"></i> Add Users',
                            action: function (e, dt, node, config) {
                                $(".formData").each(function () {
                                    this.reset();
                                });
                                $(".error").text('');
                                $(".formData").attr('action', '/users').attr('method', 'post')
                                $("#usersModal").modal('show');
                            }
                        },
                    ],
                    "ajax": {
                        url: "/show", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: 'role_id'
                        },
                        {
                            data: 'action',
                            orderable: false, // Disable sorting on the "action" column
                            render: function (data, type, row) {
                                return data; // Render the "action" column as-is
                            }
                        },
                    ],
                });

                $("#role_id").select2({
                    dropdownParent: $("#usersModal"),
                    placeholder: 'Select Roles',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '/load_roles',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (response) {
                            return {
                                results: $.map(response.data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                        },
                    }
                });

                //Save Data into Database
                $(".formData").on('submit', function(e) {
                    e.preventDefault();
                    $(".saveData").prop('disabled', true);
                    var form = $('.formData');
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $(".formData").attr('action', '/users').attr('method', 'post');
                            $(".saveData").prop("disabled", false);
                            $('.formData').each(function() {
                                this.reset();
                            });
                            $("#usersModal").modal('hide')
                            users.ajax.reload(null, false);
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                        }, 
                        error: function (jqXhr) {
                            $(".saveData").prop("disabled", false);
                            var errorResponse = $.parseJSON(jqXhr.responseText);
                            $(".error").text('');
                            $.each(errorResponse.errors, function (key, value) {
                                $("#" + key + "_error").text(value);
                            });
                        }
                    }); //ajax call
                }); //main

                $(document).on('click', '.edit', function () {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: 'users/'+id,
                        dataType: "json",
                        success: function (response) {
                            $(".error").text('');

                            $(".formData").attr('action', 'update/'+id);

                            $("#usersModal").modal('show')
                            $("#user_name").val(response.name);
                            $("#user_email").val(response.email);
                            $("#user_password").val(response.password);
                            $("#status").val(response.status);
                            
                            $("#role_id").empty();
                            var option = new Option(response.roles[0].name, response.role_id, false, false);
                            $("#role_id").append(option);
                            $("#role_id").trigger('change');
                        }
                    });
                });

                $(document).on("click", ".delete", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "DELETE",
                        url: "/users/" + id,
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            users.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection

