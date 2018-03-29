@extends('layouts.app')
@push('css')
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
@endpush
@section('content')
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#absen-log-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': "{{ route('get.datatables.absen.log') }}",
                'type': 'POST'
            },
            columns: [
                {data: 'mesin_id', name: 'mesin_id'},
                {data: 'pin', name: 'pin'},
                {data: 'date_time', name: 'date_time'},
                {data: 'ver', name: 'ver'},
                {data: 'status_absen_id', name: 'status_absen_id'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });
        $('#btn-sync').click(function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('sync.data.from.machine') }}",
                dataType: 'json',
                beforeSend: function (e) {
                    $.blockUI();
                },
                success: function (response) {
                    $.unblockUI();
                    alertify.alert(response.message).setHeader('Sync Data ');
                },
                errors: function (e) {
                    $.unblockUI();
                    alertify.alert(e.responseText).setHeader('Sync Data ');
                }
            });
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card card-default">
                <div class="card-header">
                    Absensi Log 
                    <button id="btn-sync" class="btn btn-primary btn-sm float-right" type="button">Sync Data </a>
                </div>
                <div class="card-body">
                    <table id="absen-log-table" class="table table-condensed dataTable no-footer" role="grid">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">Mesin</th>
                                <th class="text-center">PIN</th>
                                <th class="text-center">Tgl. Absen</th>
                                <th class="text-center">Response</th>
                                <th class="text-center">Status Absen</th>
                                <th class="text-center" style="width: 90px;">Created At</th>
                                <th class="text-center" style="width: 90px;">Updated At</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection