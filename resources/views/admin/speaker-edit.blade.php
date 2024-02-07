<form id="edit-data-form" action="{{ route($route . '.update') }}" method="post" enctype="multipart/form-data"
  accept-charset="utf-8">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <input id="id" name="id" type="hidden" value="{{ $data->id }}" required="required">
  <div class="row">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Gelar Depan</label>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <input class="form-control form-control-sm @error('editPrefixes') is-invalid @enderror" id="editPrefixes"
              name="editPrefixes" type="text" value="{{ old('editPrefixes', $data->prefixes) }}" maxlength="50">
            @error('editPrefixes')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Nama</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <input class="form-control form-control-sm @error('editName') is-invalid @enderror" id="editName"
              name="editName" type="text" value="{{ old('editName', $data->name) }}" maxlength="255"
              required="required">
            @error('editName')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Gelar Belakang</label>
          </div>
          <div class="col-lg-4 col-md-6 col-12">
            <input class="form-control form-control-sm @error('editSuffixes') is-invalid @enderror" id="editSuffixes"
              name="editSuffixes" type="text" value="{{ old('editSuffixes', $data->suffixes) }}" maxlength="50">
            @error('editSuffixes')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Jabatan</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <input class="form-control form-control-sm @error('editPosition') is-invalid @enderror" id="editPosition"
              name="editPosition" type="text" value="{{ old('editPosition', $data->position) }}" maxlength="255"
              required="required">
            @error('editPosition')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row mb-3">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Asal Institusi</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <input class="form-control form-control-sm @error('editInstitution') is-invalid @enderror"
              id="editInstitution" name="editInstitution" type="text"
              value="{{ old('editInstitution', $data->institution) }}" maxlength="255" required="required">
            @error('editInstitution')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-6 text-left">
      <button class="btn btn-light" data-dismiss="modal" type="button">Kembali</button>
    </div>
    <div class="col-6 text-right">
      <input class="btn btn-primary" id="save-data" type="submit" value="Simpan">
    </div>
  </div>
</form>

@include('template.footjs.global.select2-multiple')
<script>
  $('input[name="editActive"]').bootstrapToggle({
    width: 60
  });
</script>
