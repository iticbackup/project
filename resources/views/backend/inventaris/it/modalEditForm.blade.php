<div class="modal fade modalEdit" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Edit Label - {{ $inventaris_asset->nama_perangkat }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-edit">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kode Label</label>
                    <input type="text" name="edit_kode_label" class="form-control" placeholder="Kode Label" id="edit_kode_label">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi Label</label>
                    <input type="text" name="edit_keterangan" class="form-control" placeholder="Nama Label" id="edit_label">
                </div>
                <div class="mb-3">
                    <label class="form-label">Perubahan Data</label>
                    <select name="edit_perubahan_data" class="form-control" id="edit_perubahan_data">
                        <option value="-">-- Pilih --</option>
                        <option value="true">Ya</option>
                        <option value="false">Tidak</option>
                    </select>
                    {{-- <input type="text" name="edit_keterangan" class="form-control" placeholder="Nama Label" id="edit_label"> --}}
                </div>
                <div class="mb-3" style="display:none;" id="view_jenis_merk">
                    <label class="form-label">Jenis Merk</label>
                    <input type="text" name="edit_jenis_merk" class="form-control" placeholder="Jenis Merk" id="edit_jenis_merk">
                </div>
                <div class="mb-3" style="display:none;" id="view_jenis_type">
                    <label class="form-label">Jenis Type</label>
                    <input type="text" name="edit_jenis_type" class="form-control" placeholder="Jenis Type" id="edit_jenis_type">
                </div>
                <div class="mb-3" style="display:none;" id="view_status_barang">
                    <label class="form-label">Status Barang</label>
                    <select name="edit_status" class="form-control" id="edit_status">
                        <option value="-">-- Pilih Status --</option>
                        <option value="1">Ada</option>
                        <option value="2">Tidak</option>
                        <option value="3">Rusak / Dijual</option>
                    </select>
                    {{-- <input type="text" name="edit_keterangan" class="form-control" placeholder="Nama Label" id="edit_label"> --}}
                </div>
                <div class="mb-3" style="display:none;" id="view_keterangan">
                    <label class="form-label">Keterangan</label>
                    <textarea name="view_keterangan" class="form-control" id="edit_view_keterangan" cols="30" rows="5"></textarea>
                    {{-- <input type="text" name="view_keterangan" class="form-control" placeholder="Nama Label" id="edit_label"> --}}
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