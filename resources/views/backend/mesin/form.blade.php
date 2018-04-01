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
    <div class="col-md-6 mb-3">
        <label>Nama Mesin *</label>
        {!! Form::text('nama', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Akan di tampilkan sebagai opsi Mesin</small>
        <div class="invalid-feedback">
            Nama Mesin harus diisi.
        </div>
        <br>
        <label>IP *</label>
        {!! Form::text('ip', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Isi dengan IP Address</small>
        <div class="invalid-feedback">
            IP Address harus diisi.
        </div>
        <br>
        <label>Password</label>
        {!! Form::password('password', array('class' => 'form-control')) !!}
        <small class="text-muted">Di Perlukan untuk terhubung ke mesin Fingerprint</small>
        <div class="invalid-feedback"></div>
    </div>
    <div class="col-md-6 mb-3">
        <label>Port *</label>
        {!! Form::text('port', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Digunakan untuk dapat terhubung ke Mesin</small>
        <div class="invalid-feedback">
            Port harus diisi.
        </div>
        <br>
        <label>Set Default *</label>
        {!! Form::select('is_default', array('0' => 'TIDAK', '1' => 'YA'), null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        <small class="text-muted">Identifikasi Mesin Default.</small>
        <div class="invalid-feedback"></div>
    </div>
    <div class="col-md-12">
        <hr class="mb-4">
        <button class="btn btn-md btn-warning my-2" type="reset">Reset</button>
        <button class="btn btn-md btn-primary my-2 float-right" type="submit">Submit</button>
    </div>
</div>