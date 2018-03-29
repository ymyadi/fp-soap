<div class="row">
    <div class="col-md-6 mb-3">
        <label>Nama Jabatan *</label>
        {!! Form::text('nama', null, array('placeholder' => 'Wajib diisi.', 'class' => 'form-control', 'required' => 'required')) !!}
        <small class="text-muted">Akan di tampilkan sebagai opsi Jabatan</small>
        <div class="invalid-feedback">
            Nama Jabatan harus diisi.
        </div>
    </div>
    <div class="col-md-12">
        <hr class="mb-4">
        <button class="btn btn-md btn-warning my-2" type="reset">Reset</button>
        <button class="btn btn-md btn-primary my-2 float-right" type="submit">Submit</button>
    </div>
</div>