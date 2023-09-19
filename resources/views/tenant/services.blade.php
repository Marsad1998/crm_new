@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-3">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">
                    Services
                </div>
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-hover table-bordered align-middle" id="services">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Price</th>
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
    @push('script')
    @include('tenant.script')
    <script>
        $(document).ready(function () {
            var services = $("#services").DataTable({
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
                        text: '<i class="fas fa-plus-circle"></i> Add Services',
                        action: function (e, dt, node, config) {
                            $(".formData").each(function () {
                                this.reset();
                            });
                            $("#servicesModal").modal('show');
                        }
                    },
                ],
                "ajax": {
                    url: "/services", // json datasource
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
                        data: 'type'
                    },
                    {
                        data: 'price'
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

