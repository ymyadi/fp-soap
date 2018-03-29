@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
        $('.select2').select2({
            placeholder : 'Please select',
            tags: true
        });
        $('#absen-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                'url': "{{ route('get.datatables.absen') }}",
                'type': 'POST'
            },
            columns: [
                {data: 'absen_id', name: 'absen_id'},
                {data: 'pegawai_id', name: 'pegawai_id'},
                {data: 'check_in', name: 'check_out'},
                {data: 'check_out', name: 'check_out'},
                {data: 'work_hours', name: 'work_hours'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });
        $('#btn-sync').click(function(event){
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('modal.sync.data.from.absen.log') }}",
                dataType: 'json',
                beforeSend: function (e) {
                    $.blockUI();
                },
                success: function (response) {
                    $.unblockUI();
                    if (response.success) {
                        // notice that we are expecting a json array with success = true and a payload
                        $('.modal').empty().html(response.payload).modal();
                    } else {
                        // for debugging
                        alertify.alert(response.payload).setHeader('Sync Data ');
                    }
                },
                errors: function (e, textStatus, thrownError) {
                    $.unblockUI();
                    alertify.alert(e.status + ' ' + thrownError).setHeader('Sync Data ');
                }
            });
        });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('error'))
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
            @endif
            <div class="card card-default">
                <div class="card-header">
                    Absensi 
                    <div class="float-right" style="width:20%">
                        <button id="btn-sync" class="btn btn-primary btn-sm float-right" type="button">Sync Data </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="absen-table" class="table table-condensed dataTable no-footer" role="grid">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 30px;">No</th>
                                <th class="text-center">Pegawai</th>
                                <th class="text-center">Check In</th>
                                <th class="text-center">Check Out</th>
                                <th class="text-center">Work Hours</th>
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