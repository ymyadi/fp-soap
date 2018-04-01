@push('css')
<link rel="stylesheet" href="{{ asset('plugin/select2/4.0.3/css/select2.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugin/select2/4.0.3/js/select2.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('.select2').select2({
        placeholder : 'Please select',
        tags: true
    });
});
</script>
@endpush
<div class="row">
    <div class="col-md-12">
        <label>Mesin *</label>
        {!! Form::select('mesin_id', $mesin, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        <small class="text-muted">Pilih Mesin</small>
        <div class="invalid-feedback">
            Mesin harus diisi.
        </div>
        <br>
        <label>Nama *</label>
        {!! Form::text('nama', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Nama User</small>
        <div class="invalid-feedback">
            Nama User harus diisi.
        </div>
        <br>
        <label>User ID *</label>
        {!! Form::number('user_id', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">User ID</small>
        <div class="invalid-feedback">
            User ID harus diisi.
        </div>
    </div>
    <div class="col-md-12">
        <hr class="mb-4">
        <button class="btn btn-md btn-warning my-2" type="reset">Reset</button>
        <button class="btn btn-md btn-primary my-2 float-right" type="submit">Submit</button>
    </div>
</div>