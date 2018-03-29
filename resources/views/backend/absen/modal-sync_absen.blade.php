<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder : 'Please select',
            tags: true
        });
    });
</script>
<div class="modal-dialog" role="document">
    {!! Form::open(array('route' => 'sync.data.from.absen.log', 'method' => 'POST', 'class' => 'form-signin')) !!}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Sync</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>Bulan *</label>
                        {{ Form::selectMonth('month', date('m')/1, ['class' => 'form-control select2']) }}
                        <small class="text-muted">Tarik Data Per-Bulan</small>
                    </div>
                    <div class="col-md-6">
                        <label>Tahun *</label>
                        {!! Form::select('year', $year, date('Y'), ['class' => 'form-control select2', 'required' => 'required']) !!}
                        <small class="text-muted">Tarik Data Tahun</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sinkron</button>
            </div>
        </div>
    {!! Form::close() !!}
</div>