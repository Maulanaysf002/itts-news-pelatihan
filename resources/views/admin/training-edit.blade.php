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
            <label class="form-control-label" for="normal-input">Judul</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <input class="form-control form-control-sm @error('editTitle') is-invalid @enderror" id="editTitle"
              name="editTitle" type="text" value="{{ old('editTitle', $data->title) }}" maxlength="255"
              required="required">
            @error('editTitle')
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
            <label class="form-control-label" for="normal-input">Flayer</label>
          </div>
          <div class="col-lg-7 col-md-8 col-12">
            @php
              $inputImageName = 'image';
            @endphp
            <img class="img-thumbnail photo-preview" id="previewEdit{{ ucwords($inputImageName) }}"
              src="{{ $data->{$inputImageName} ? asset($data->{$inputImageName . 'Path'}) : asset('img/training/default.png') }}">
            <input class="file image-input d-none" name="edit{{ ucwords($inputImageName) }}" type="file"
              accept="image/jpg,image/jpeg,image/png,image/webp">
            <div class="input-group mt-3">
              <input class="form-control form-control-sm @error('edit' . ucwords($inputImageName)) is-invalid @enderror"
                id="fileEdit{{ ucwords($inputImageName) }}" type="text" disabled placeholder="Unggah photo...">
              <div class="input-group-append">
                <button class="browse btn btn-sm btn-primary" type="button">Pilih</button>
              </div>
            </div>
            <small class="form-text text-muted">Rasio 8R. Ekstensi .jpg, .jpeg, .png, .webp. Maks 500
              KB.</small>
            @error($inputImageName)
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
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="normal-input">Deskripsi</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <textarea class="form-control form-control-sm @error('editDesc') is-invalid @enderror" id="inputEditDesc"
              name="editDesc" maxlength="255" rows="3" required="required">{{ old('editDesc', $data->description) }}</textarea>
            @error('editDesc')
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
            <label class="form-control-label" for="selectType">Tipe Webinar</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2 form-control form-control-sm @error('editType') is-invalid @enderror" id="selectType"
              name="editType" required="required">
              @foreach ($trainingType as $t)
                <option value="{{ $t->id }}" {{ old('editType', $data->t_type) == $t->id ? 'selected' : '' }}>
                  {{ $t->name }}
                </option>
              @endforeach
            </select>
            @error('editType')
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
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="dateInput">Tanggal Pelaksanaan</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <div class="input-group date">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
              </div>
              <input class="form-control form-control-sm" id="dateInput" name="editDate" type="text"
                value="{{ $data->t_date ? date('d F Y', strtotime($data->t_date)) : '' }}" placeholder="Pilih tanggal">
            </div>
            @error('date')
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
            <label class="form-control-label" for="normal-input">Tautan</label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <input class="form-control form-control-sm @error('editLink') is-invalid @enderror" id="editLink"
              name="editLink" type="text" value="{{ old('editLink', $data->meet_link) }}" maxlength="255"
              required="required" placeholder="mis. https://www.google.com/">
            @error('editLink')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row ">
    <div class="col-lg-10 col-md-12">
      <div class="form-group">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="speaker">Pemateri <span class="text-danger">*</span></label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2-multiple form-control" id="speaker" name="editSpeaker[]" multiple="multiple"
              required="required" {{ $data->status == 1 ? 'disabled="disabled"' : '' }}>
              @foreach ($speaker as $s)
                <option value="{{ $s->id }}"
                  {{ $data->speakers()->count() > 0? ($data->speakers()->where('speaker_id', $s->id)->count() > 0? 'selected': ''): '' }}>
                  {{ $s->nameWithTitle }}
                </option>
              @endforeach
            </select>
            @error('speaker')
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
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="moderator">Moderator<span class="text-danger">*</span></label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2-multiple form-control" id="moderator" name="editModerator[]" multiple="multiple"
              required="required" {{ $data->status == 1 ? 'disabled="disabled"' : '' }}>
              @foreach ($moderator as $m)
                <option value="{{ $m->id }}"
                  {{ $data->moderators()->count() > 0? ($data->moderators()->where('moderator_id', $m->id)->count() > 0? 'selected': ''): '' }}>
                  {{ $m->nameWithTitle }}
                </option>
              @endforeach
            </select>
            @error('moderator')
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
        <div class="row">
          <div class="col-lg-3 col-md-4 col-12">
            <label class="form-control-label" for="collaboration">Kolaborasi
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2-multiple form-control" id="collaboration" name="editCollaboration[]"
              multiple="multiple" {{ $data->status == 1 ? 'disabled="disabled"' : '' }}>
              @foreach ($collaboration as $c)
                <option value="{{ $c->id }}"
                  {{ $data->collaborators()->count() > 0? ($data->collaborators()->where('collabs_id', $c->id)->count() > 0? 'selected': ''): '' }}>
                  {{ $c->name }}
                </option>
              @endforeach
            </select>
            @error('collaboration')
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
            <label class="form-control-label" for="selectSignature">Penandatangan Sertifikat <span
                class="text-danger">*</span></label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2 form-control form-control-sm @error('editSignature') is-invalid @enderror"
              id="selectSignature" name="editSignature" required="required">
              @foreach ($signature as $s)
                <option value="{{ $s->id }}"
                  {{ $data->signature()->where('signature_id', $s->id)->count() > 0? 'selected': '' }}>
                  {{ $s->nameWithTitle }}
                </option>
              @endforeach
            </select>
            @error('editSignature')
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
            <label class="form-control-label" for="selectSignature">Penandatangan SK <span
                class="text-danger">*</span></label>
          </div>
          <div class="col-lg-9 col-md-8 col-12">
            <select class="select2 form-control form-control-sm @error('editSkSignature') is-invalid @enderror"
              id="selectSkSignature" name="editSkSignature" required="required">
              @foreach ($sksignature as $sks)
                <option value="{{ $sks->id }}"
                  {{ $data->sksignature()->where('sksignature_id', $sks->id)->count() > 0? 'selected': '' }}>
                  {{ $sks->nameWithTitle }}
                </option>
              @endforeach
            </select>
            @error('editSkSignature')
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

<script>
  $('input[name="editActive"]').bootstrapToggle({
    width: 60
  });
</script>

@include('template.footjs.global.datepicker')
@include('template.footjs.global.select2-multiple')
