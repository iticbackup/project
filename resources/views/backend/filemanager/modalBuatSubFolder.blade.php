<div class="modal fade hide-modal modalBuatSubFolder" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title mt-0" id="exampleModalLabel">Buat Sub Folder</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-buatSubFolder-simpan" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="buat_file_managers_id" id="buat_file_managers_id">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <input type="text" class="form-control" value="{{ $departemen->departemen->nama_departemen }}" name="buat_nama_departemen" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Sub Folder</label>
                    <input type="text" class="form-control" name="buatSubFolder" id="buatSubFolder">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Buat</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>