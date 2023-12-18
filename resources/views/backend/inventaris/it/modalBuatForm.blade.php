<div class="modal fade modalBuat" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Buat Label - {{ $inventaris_asset->nama_perangkat }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-simpan">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Label</label>
                    <input type="text" name="label" class="form-control" placeholder="Nama Label">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Lokasi">
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Jumlah Label</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Label">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Submit</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>