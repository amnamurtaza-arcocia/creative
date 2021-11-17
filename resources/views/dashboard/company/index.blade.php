@extends('dashboard.layout.master')
@section('title')
All Companies
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="company_table">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('#company_table').DataTable({
            processing: true
            , serverSide: true
            , ajax: {
                url: "{{ url('/admin/company') }}"
            , }
            , columns: [{
                    data: 'action'
                    , name: 'action'
                , }
                , {
                    data: 'name'
                    , name: 'name'
                , }
                , {
                    data: 'email'
                    , name: 'email'
                , }

            ]
        });
    })

</script>
@endsection
