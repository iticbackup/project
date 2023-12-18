<div class="modal fade modalBuat" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Buat Inventaris K3</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-simpan">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" name="kode_barcode" class="form-control" placeholder="Kode">
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                </div>
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="departemen_id" class="form-control" id="">
                        <option value="0">-- Pilih Departemen --</option>
                        @foreach ($departemens as $departemen)
                            <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Barang</label>
                    <label class="form-label">(Tekan tombol <b>CTRL + Klik</b> jika memilih lebih dari satu)</label>
                    <select multiple="" name="jenis_barang[]" class="form-select" id="">
                        <option value="0">-- Pilih Jenis Barang --</option>
                        <option value="APAR">APAR</option>
                        <option value="HYDRANT">HYDRANT</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Barang</label>
                    <select name="status" class="form-control" id="">
                        <option value="0">-- Pilih Status Barang --</option>
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>
                    </select>
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