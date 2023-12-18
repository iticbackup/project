<div class="modal fade modalCheck" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0">Detail Perangkat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Kode Asset</td>
                        <td>:</td>
                        <td><span id="check_kode"></span></td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center">Spesifikasi</th>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td><span id="check_lokasi"></span></td>
                    </tr>
                    <tr>
                        <td>Jenis Merk</td>
                        <td>:</td>
                        <td><span id="check_jenis_merk"></span></td>
                    </tr>
                    <tr>
                        <td>Jenis Type</td>
                        <td>:</td>
                        <td><span id="check_jenis_type"></span></td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>:</td>
                        <td><span id="check_spesifikasi"></span></td>
                    </tr>
                </table>
                {{-- <div class="mb-3">
                    <label class="form-label">Kode Barcode</label>
                    <input type="text" name="kode_barcode" class="form-control" placeholder="Kode Barcode">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                </div>
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-control" id="">
                        <option>-- Pilih Departemen --</option>
                        @foreach ($departemens as $departemen)
                            <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                        @endforeach
                    </select>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>