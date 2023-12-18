<div class="modal fade modalFormEdit" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Edit Formulir Perangkat Komputer - {{ $inventarisITPerangkat->lokasi }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-edit">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Jenis Asset</label>
                    <select name="edit_jenis_asset" class="form-control" id="edit_jenis_asset">

                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Label Asset</label>
                    <select name="edit_label_asset" class="form-control" id="edit_label_asset">
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Status Perangkat</label>
                    <select name="edit_status" class="form-control" id="edit_status">
                        <option value="-">-- Pilih Status Perangkat --</option>
                        <option value="1">Ada</option>
                        <option value="0">Tidak Ada</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Update</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>