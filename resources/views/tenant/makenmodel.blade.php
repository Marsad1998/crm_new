@extends('layouts.main')

@section('content')

    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">
                    Makes & Models
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-hover table-bordered align-middle" id="makenModal">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
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

    <div class="modal animate__animated animate__zoomIn animate__faster" id="makesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="makeTitle">Add a Make</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/makes" method="post" class="formData" id="makes" data-table="makenModal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="make_name" class="form-label">Name</label>
                            <input type="text" name="make_name" id="make_name" class="form-control">
                            <small id="make_name_error" class="text-danger error"></small>
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

    <div class="modal animate__animated animate__zoomIn animate__faster" id="modelsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelTitle">Add a model</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/models" method="post" class="formData" id="models" data-table="makenModal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="model_name" class="form-label">Name</label>
                            <input type="text" name="model_name" id="model_name" class="form-control">
                            <small id="model_name_error" class="text-danger error"></small>
                        </div>
                        <div class="mb-3">
                            <label for="make_id" class="form-label">Makes</label>
                            <select class="form-control" name="make_id" id="make_id">
                            </select>
                            <small id="make_id_error" class="text-danger error"></small>
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
        @include('tenant.script')
        <script>
            $(document).ready(function () {
                
                $("#make_id").select2({
                    dropdownParent: $("#modelsModal"),
                    placeholder: 'Select Makes',
                    width: "100%",
                    ajax: {
                        method: 'post',
                        url: '/load_makes',
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

                var makeNmodel = $("#makenModal").DataTable({
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
                            text: '<i class="fas fa-plus-circle"></i> Add Makes',
                            action: function (e, dt, node, config) {
                                $(".formData").each(function () {
                                    this.reset();
                                });
                                $(".formData").attr('action', '/makes').attr('method', 'post')
                                $("#makesModal").modal('show');
                            }
                        },
                        {
                            className: "mx-2",
                            text: '<i class="fas fa-plus-circle"></i> Add Models',
                            action: function (e, dt, node, config) {
                                $(".formData").each(function () {
                                    this.reset();
                                    $(this).find("select").val(null).trigger("change");
                                });
                                $(".formData").attr('action', '/models').attr('method', 'post')
                                $("#modelsModal").modal('show')
                            }
                        },
                    ],
                    "ajax": {
                        url: "/load_makes_models", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [
                        {
                            data: 'DT_RowIndex'
                        },
                        {
                            data: 'type'
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
                                    return model.make_id == id.substr(4); // Filter models by make_id
                                });
                                tr.after(formatChildRow(models, id));
                            }else{
                                $("#"+id).html('<i class="fe fe-plus"></i>');
                                $("#"+id).data('class', 'hide');
                            }
                        });
                    }
                });

                $(document).on('click', '.edit', function () {
                    var id = $(this).attr('id');
                    $.ajax({
                        type: "PUT",
                        url: id,
                        dataType: "json",
                        success: function (response) {
                            $(".formData[id='"+response[1]+"']").attr('action', id)
                            if (response[1] == 'makes') {
                                $("#makesModal").modal('show')
                                $("#make_name").val(response[0].name);
                            }else{
                                $("#modelsModal").modal('show')
                                $("#model_name").val(response[0].name);
                                
                                $("#make_id").empty();
                                var option = new Option(response[0].make.name, response[0].make.id, false, false);
                                $("#make_id").append(option);
                                $("#make_id").trigger('change');
                            }


                        }
                    });
                });
                
                // Function to format the child row content
                function formatChildRow(models, id) {
                    if (!models || !Array.isArray(models) || models.length === 0) {
                        return '<tr class="'+id+'"><td colspan="3">No models available<td></tr>'; // Handle the case where models is empty or undefined
                    }

                    var table = "";
                    for (var i = 0; i < models.length; i++) {
                        var rand1 = Math.floor(Math.random()*90000) + 10000;
                        var rand2 = Math.floor(Math.random()*90000) + 10000;
                        var did = rand1+""+models[i].id+""+rand2
                        table += '<tr class="'+id+'">\
                                    <td></td>\
                                    <td><span class="badge bg-light text-danger">Models</span></td><td>' + models[i].name + '</td>\
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

            });
        </script>
    @endpush
@endsection
