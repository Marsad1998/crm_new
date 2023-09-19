@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-3">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">
                    Users
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-hover table-bordered align-middle" id="users">
                                <thead class="table-primary">
                                    <tr>
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
    
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/users" method="post" class="formData" id="users" data-table="makenModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userTitle">Add a user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
                            <input type="password" name="user_password" id="user_password" class="form-control">
                            <small id="user_password_error" class="text-danger error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-control" name="role_id" id="role_id">
                            </select>
                            <small id="role_id_error" class="text-danger error"></small>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary saveData">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('script')
        @include('tenant.script')
        <script>
            $(document).ready(function () {
                $("#role_id").select2({
                    dropdownParent: $("#usersModal"),
                    placeholder: 'Select Roles',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '/roles',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name
                                    };
                                })
                            };
                        },
                    }
                });
    
                var users = $("#users").DataTable({
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
                            data: 'action',
                            orderable: false, // Disable sorting on the "action" column
                            render: function (data, type, row) {
                                return data; // Render the "action" column as-is
                            }
                        },
                    ],
                });
            });
        </script>
    @endpush
@endsection

