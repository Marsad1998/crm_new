@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="card mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">
                <div class="card-header p-3 tx-medium my-auto tx-white tenant-nav">Activity Logs</div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover table-bordered align-middle" id="logTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Log Name</th>
                                    <th>Event</th>
                                    <th>Done By</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> {{-- body --}}
            </div> {{-- card --}}
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {

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