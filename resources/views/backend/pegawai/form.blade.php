@push('css')
<link rel="stylesheet" href="{{ asset('plugin/select2/4.0.3/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugin/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('plugin/select2/4.0.3/js/select2.min.js') }}"></script>
<script src="{{ asset('plugin/input_mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugin/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugin/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.id.min.js') }}"></script>
<script>
$(document).ready(function () {
    $(":input").inputmask();
    $('.select2').select2({
        placeholder : 'Please select',
        tags: true
    });
    $('.form-datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});
</script>
@endpush
<div class="row">
    <div class="col-md-6 mb-3">
        <label>User Absensi *</label>
        {!! Form::select('mesin_user_id', $mesinUsers, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        <small class="text-muted">Isi dengan User Absensi</small>
        <div class="invalid-feedback">
            User Absensi harus diisi.
        </div>
        <br>
        <label>Nama *</label>
        {!! Form::hidden('user_id', 1, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        {!! Form::text('nama', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Akan di tampilkan sebagai opsi Jabatan</small>
        <div class="invalid-feedback">
            Nama Pegawai harus diisi.
        </div>
        <br>
        <label>No. KTP *</label>
        {!! Form::text('no_ktp', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'data-inputmask' => "'mask': '9999-9999-9999-9999'", 'required' => 'required')) !!}
        <small class="text-muted">Isi dengan No. KTP Pegawai</small>
        <div class="invalid-feedback">
            No. KTP Pegawai harus diisi.
        </div>
        <br>
        <label>Jenis Kelamin *</label>
        {!! Form::select('jenis_kelamin_id', $jenisKelamin, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        <small class="text-muted">Isi dengan Jenis Kelamin Pegawai</small>
        <div class="invalid-feedback">
            Jenis Kelamin Pegawai harus diisi.
        </div>
        <br>
        <label>Alamat *</label>
        {{ Form::textarea('alamat', null, ['class' => 'form-control', 'rows' => 3, 'required' => 'required']) }}
        <small class="text-muted">Isi dengan Alamat sesuai KTP Pegawai</small>
        <div class="invalid-feedback">
            Alamat Pegawai harus diisi.
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label>Email *</label>
        {!! Form::email('email', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Isi dengan Email Pegawai</small>
        <div class="invalid-feedback">
            Email harus diisi.
        </div>
        <br>
        <label>Jabatan *</label>
        {!! Form::select('jabatan_id', $jabatan, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        <small class="text-muted">Isi dengan Jabatan Pegawai</small>
        <div class="invalid-feedback">
            Jabatan Pegawai harus diisi.
        </div>
        <br>
        <label>Tgl. Mulai Bekerja *</label>
        {!! Form::text('tgl_mulai_bekerja', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control form-datepicker', 'required' => 'required')) !!}
        <small class="text-muted">Isi Tanggal waktu Pegawai bekerja.</small>
        <div class="invalid-feedback">
            Tanggal Mulai Bekerja Pegawai harus diisi.
        </div>
        <br>
        <label>Status *</label>
        {!! Form::select('pegawai_status_id', $pegawaiStatus, null, ['class' => 'form-control select2', 'tabindex' => '-1', 'required' => 'required']) !!}
        <small class="text-muted">Isi dengan Status Pegawai</small>
        <div class="invalid-feedback">
            Status Pegawai harus diisi.
        </div>
        <br>
        <label>Tgl. Berhenti </label>
        {!! Form::text('tgl_berhenti', null, array('placeholder' => 'Tidak Wajib diisi.', 'class' => 'form-control form-datepicker')) !!}
        <small class="text-muted">Isi Tanggal waktu Pegawai berhenti bekerja.</small>
    </div>
    <div class="col-md-12">
        <hr class="mb-4">
        <button class="btn btn-md btn-warning my-2" type="reset">Reset</button>
        <button class="btn btn-md btn-primary my-2 float-right" type="submit">Submit</button>
    </div>
</div>
