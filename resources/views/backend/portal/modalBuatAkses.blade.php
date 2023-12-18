<div class="modal fade modalBuat" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Akses Portal - {{ $portal->title }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-simpan">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-control select2 custom-select" id="">
                    {{-- <select name="departemen_id" class="js-example-basic-single" id=""> --}}
                        <option>-- Pilih Departemen --</option>
                        @foreach ($departemens as $departemen)
                        <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="title" class="form-control" placeholder="Title"> --}}
                </div>
                <div class="mb-3">
                    <label class="form-label">Color</label>
                    <select name="color" class="form-control" id="">
                        <option>-- Pilih Warna --</option>
                        <option value="full-type">Hijau</option>
                        <option value="internship-type">Merah</option>
                    </select>
                    {{-- <input type="text" name="link" class="form-control" placeholder="Link"> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Submit</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>