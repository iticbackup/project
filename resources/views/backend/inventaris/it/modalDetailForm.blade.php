<div class="modal fade modalDetailForm" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="title_form"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-detailForm">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
                <input type="hidden" name="edit_id" id="edit_form_id">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="edit_form_lokasi" class="form-control" placeholder="Lokasi">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Merk Barang</label>
                    <input type="text" name="edit_form_jenis_merek" class="form-control" placeholder="Jenis Merk Barang">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Type Barang</label>
                    <input type="text" name="edit_form_jenis_type" class="form-control" placeholder="Jenis Type Barang">
                </div>
                <div class="mb-3">
                    <label class="form-label">Spesifikasi</label>
                    {{-- <textarea name="edit_form_spesifikasi" class="form-control" id="basic-conf" cols="30" rows="5"></textarea> --}}
                    <textarea name="edit_form_spesifikasi" class="form-control" id="editor" cols="30" rows="5"></textarea>
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