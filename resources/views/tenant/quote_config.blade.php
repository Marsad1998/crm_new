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
                    <form action="{{ route('quote.create') }}" method="post" id="formData">
                        <div class="row">
                            <!-- col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="category_services" class="form-label">Select a Services</label>
                                    <select class="form-control" id="category_services" name="service_id" required class="form-control">
                                    </select>
                                    <small id="category_services_error" class="text-danger error"></small>
                                </div>
                                <div class="mt-3">
                                    <label for="fields" class="form-label">Choose Fields</label>
                                    <select class="form-control" id="fields" name="option_id[]" required class="form-control" multiple="multiple">
                                    </select>
                                    <small id="fields_error" class="text-danger error"></small>
                                </div>
                            </div>
                            <div class="col-lg-4 offset-2">
                                <ul id="treeview2">
                                    <li>
                                        <a href="#" id="serviceName">Service Name</a>
                                        <ul class="sortable">
                                        </ul>
                                    </li>
                                </ul>
                                <button type="submit" id="saveForm" class="btn btn-primary btn-block">Save</button>
                                <br>
                                <button type="button" id="resetForm" class="btn btn-warning"><i class="fas fa-refresh"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div> {{-- body --}}
            </div> {{-- card --}}

            <div class="table-responsive mt-3">
                <table class="table table-striped table-hover table-bordered align-middle" id="configTbl">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Service</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {

                $("ul.sortable").sortable();

                $(document).on('click', '#resetForm', function () {
                    $("#category_services").val(null).trigger('change');
                    $("#fields").val(null).trigger('change');
                    $(".sortable").empty();
                });

                $("#formData").on('submit', function (e) {
                    e.preventDefault();
                    var form = $('#formData');
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            configTbl.ajax.reload(null, false);
                            $("#resetForm").trigger('click')
                            $('.formData').each(function() {
                                this.reset();
                            });
                        }
                    });

                });

                var configTbl = $("#configTbl").DataTable({
                    stateSave: true,
                    responsive: true,
                    "ajax": {
                        url: "{{ route('quote.load') }}", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'category_id'
                        },
                        {
                            data: 'service_id'
                        },
                        {
                            data: 'action'
                        },
                    ],
                    drawCallback: function (settings) {
                        // Add click event listener to the plus button
                        $('.show-models').off('click').on('click', function () {
                            var class1 = $(this).data('class');
                            var id = $(this).attr('id');
                            var tr = $(this).closest('tr');
                            $("."+id).remove();

                            if (class1 == 'hide') {
                                $("#"+id).html('<i class="fe fe-minus"></i>');
                                $("#"+id).data('class', 'show');
                                var models = settings.json.models.filter(function (model) {
                                    return model.service_id == id.substr(4); // Filter models by make_id
                                });
                                tr.after(formatChildRow(models, id));
                            }else{
                                $("#"+id).html('<i class="fe fe-plus"></i>');
                                $("#"+id).data('class', 'hide');
                            }
                        });
                    }
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
                }).on('select2:select', function () {
                    $(".sortable").empty();
                    $("#fields option:selected").each(function() {
                        var id = $(this).val();
                        var text = $(this).text();
                        $(".sortable").append('<li class="branch">'+text+'</li>');
                    });
                }).on('select2:unselect', function () {
                    $(".sortable").empty();
                    $("#fields option:selected").each(function() {
                        var id = $(this).val();
                        var text = $(this).text();
                        $(".sortable").append('<li class="branch">'+text+'</li>');
                    });
                });

                $(document).on("click", ".delete", function() {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "POST", 
                        url: "{{ route('quote.delete', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            notif({
                                type: response.sts,
                                msg: response.msg,
                                position: 'right',
                                bottom: 10,
                                time: 2000,
                            });
                            configTbl.ajax.reload(null, false);
                        }, 
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
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
                                                id: it.id,
                                                text: it.name,
                                            }
                                        })
                                    };
                                })
                            };
                        },
                    }
                }).on('select2:select', function (e) {
                    e.preventDefault();
                    var id = $(this).val();
                    var text = $("#category_services option:selected").text();
                    $("#serviceName").text(text.trim())
                    getData(id);
                });

                $(document).on("click", ".edit", function() {
                    var id = $(this).attr('id');
                    getData(id);
                });

                function getData(id) {  
                    $.ajax({
                        type: "POST", 
                        url: "{{ route('quote.edit', ['id' => ':id']) }}".replace(':id', id),
                        dataType: "json",
                        success: function(response) {
                            var option = new Option(response[0].service.name, response[0].service.id, false, true);
                            $("#category_services").append(option).trigger('change');

                            $("#fields").val(null).trigger('change');
                            $(".sortable").empty();
                            $.each(response, function (index, value) {
                                var option = new Option(value.option.name, value.option.id, false,  true);
                                $("#fields").append(option).trigger('change');

                                $(".sortable").append('<li class="branch">'+value.option.name+'</li>');
                            });

                        },
                        error: function (response) {
                            swal("Oops", response.responseJSON.message, "error");
                        }
                    });
                }

                function formatChildRow(models, id) {
                    if (!models || !Array.isArray(models) || models.length === 0) {
                        return '<tr class="'+id+'"><td colspan="3">No Fields available<td></tr>'; // Handle the case where models is empty or undefined
                    }

                    var table = "";
                    for (var i = 0; i < models.length; i++) {
                        var rand1 = Math.floor(Math.random()*90000) + 10000;
                        var rand2 = Math.floor(Math.random()*90000) + 10000;
                        var did = rand1+""+models[i].id+""+rand2
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td><span class="badge bg-light text-danger">Parameters</span></td><td>' + models[i].option.name + '</td>\
                                    <td>\
                                        <button class="edit btn btn-sm ripple btn-outline-warning" data-tbl="makenModal" id="models/'+ btoa(did) +'">\
                                            <i class="fe fe-edit-2"></i>\
                                        </button>\
                                        <button class="delete btn btn-sm ripple btn-outline-danger" data-tbl="makenModal" id="models/'+ btoa(did) +'">\
                                            <i class="fe fe-trash"></i>\
                                        </button>\
                                    </td>\
                                </tr>';
                    }
                    return table;
                }

            }); // ready
        </script>
    @endpush
@endsection