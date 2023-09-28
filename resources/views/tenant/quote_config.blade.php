@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Option;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">Quote Configurator (Set Fields for Price Manager & Quote Gen)</div>
                <div class="card-body">
                    <div class="row">
                        <!-- col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="category_services" class="form-label">Select a Services</label>
                                <select class="form-control" id="category_services" required class="form-control">
                                </select>
                                <small id="category_services_error" class="text-danger error"></small>
                            </div>
                            <div class="mt-3">
                                <label for="fields" class="form-label">Choose Fields</label>
                                <select class="form-control" id="fields" required class="form-control">
                                </select>
                                <small id="fields_error" class="text-danger error"></small>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-2">
                            <ul id="treeview1">
                                <li><a href="#" id="serviceName">TECH</a>
                                    <ul class="sortable">
                                        {{-- <li>Company Maintenance</li>
                                        <li>Employees
                                            <ul class="sortable">
                                                <li>Reports</li>
                                            </ul>
                                        </li>
                                        <li>Human Resources</li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> {{-- body --}}
            </div> {{-- card --}}
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {

                $(".sortable").sortable({
                    connectWith: '.sortable',
                    items: 'li',
                    revert: true,
                    opacity: 0.77,
                    cursor: 'move'
                });

                $("#category_services").select2({
                    placeholder: 'Select Categories',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '{{ route("quote.category") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        text: item.name,
                                        "children" : $.map(item.services, function (it) {  
                                            return {
                                                id: it.name,
                                                text: it.name,
                                            }
                                        })
                                    };
                                })
                            };
                        },
                    }
                }).on('change', function () {  
                    var id = $(this).val();
                    $("#serviceName").text(id.trim());
                });

                $("#fields").select2({
                    placeholder: 'Select Fields',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '{{ route("quote.fields") }}',
                        dataType: 'json',
                        delay: 250,
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.name,
                                    }
                                })
                            }
                        }
                    }
                }).on('change', function () {  
                    var id = $("#fields:checked").text();
                    $(".sortable").append('<li>'+id+'</li>');
                });

                var logTable = $("#logTable").DataTable({
                    stateSave: true,
                    "ajax": {
                        url: "/load_logs", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'log_name'
                        },
                        {
                            data: 'event'
                        },
                        {
                            data: 'causer_id'
                        },
                        {
                            data: 'created_at'
                        },
                    ]
                });

            }); // ready
        </script>
    @endpush
@endsection