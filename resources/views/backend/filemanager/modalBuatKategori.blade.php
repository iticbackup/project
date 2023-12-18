<div class="modal fade hide-modal modalBuatKategori" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title mt-0" id="exampleModalLabel">Buat Folder</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-buatKategori-simpan" method="post">
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <input type="text" class="form-control" value="{{ $departemen->departemen->nama_departemen }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Folder</label>
                    <input type="text" class="form-control" name="buat_nama_berkas" placeholder="Nama Folder">
                </div>
                {{-- <form class="form-horizontal" action="index">
                    <div class="mb-4 mt-2 ">
                        <span class="thumb-xl justify-content-center d-flex align-items-center bg-soft-danger rounded-circle mx-auto"><i class="las la-lock"></i></span>
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="HideCard">
                        <button class="btn btn-primary" type="button" id="HideCard"><i class="las la-key"></i></button>
                    </div>
                    <div class="text-end mt-1">
                        <a href="#" class="text-primary font-12"><i class="las la-lock"></i> Forgot password?</a>
                    </div>
                </form> --}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Buat</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>