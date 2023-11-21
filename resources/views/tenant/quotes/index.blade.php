@php
    use Spatie\Permission\Models\Role;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="inner-body">
            <h3 class="mt-lg-3 mt-md-4 mg-sm-t-70 mg-xs-t-70 mg-t-70">Leads & Calls</h3>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover table-bordered align-middle" id="logTable">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Name</th>
                                    <th>Last Quoted</th>
                                    <th>Vehicle</th>
                                    <th>Service</th>
                                    <th>Key</th>
                                    <th>AKL</th>
                                    <th>Location</th>
                                    <th>Caller Type</th>
                                    <th>CAA/AAA</th>
                                    <th>Day/Night Rate</th>
                                    <th>Notes</th>
                                    <th>Call Count</th>
                                    <th>Dispatcher</th>
                                    <th>Last Call</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                        url: "{{ route('quote.load_index') }}", // json datasource
                        type: 'post', // method  , by default get
                    },
                    'order': [],
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'phone'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'last_quoted'
                        },
                        {
                            data: 'vehicle'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        {
                            data: 'notes'
                        },
                        
                        
                    ]
                });

            }); // ready
        </script>
    @endpush
@endsection