@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">Manage Roles</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="/add_roles" class="formData" method="post">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" placeholder="Role Name" name="name" id="name"> 
                                </div>
                                <div class="form-group">
                                    <label for="">Guard Name</label>
                                    <input type="text" readonly class="form-control" name="guard_name" value="web" id="guard_name"> 
                                </div>
                                <button type="submit" id="saveData" class="btn ripple btn-primary btn-block">Save</button>
                                {{-- @if (Auth::user()->can('Add Role'))
                                @else
                                    <div class="alert alert-danger flex items-center" role="alert"> <i
                                            data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> You Don't
                                        Have Right To Perform this Action </div>
                                @endif --}}
                            </form>
                        </div> {{-- inner col-4 --}}
                        <div class="col-sm-8">
                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover table-bordered align-middle" id="roleTable">
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
                        </div> {{-- inner col-8 --}}
                    </div> {{-- inner row --}}
                </div> {{-- body --}}
            </div> {{-- card --}}
        </div>
    </div>
    
    @push('script')
        <script>
            $(document).ready(function() {

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
                            $(".formData").attr('action', '/add_roles');
                            $("#saveData").prop("disabled", false).text('Save').addClass('btn-primary').removeClass('btn-danger');
                            $('.formData').each(function() {
                                this.reset();
                            });
                            roleTable.ajax.reload(null, false);
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

                var roleTable = $("#roleTable").DataTable({
                    stateSave: true,
                    responsive: true,
                    "ajax": {
                        url: "/load_roles", // json datasource
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
                    ]
                });

                $(document).on('click', ".edit", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST",
                        url: "/get_roles/" + id,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            $("#saveData").text('Update').addClass('btn-danger').removeClass('btn-primary');
                            $(".formData").attr('action', '/update_roles/' + id);
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
                        type: "POST",
                        url: "/delete_roles/" + id,
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            roleTable.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                });
            }); // ready
        </script>
    @endpush
@endsection
