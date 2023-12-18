<div class="modal fade modalFormDetail" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Formulir Perangkat Komputer - {{ $inventarisITPerangkat->lokasi }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-simpan">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Jenis Asset</label>
                    <select name="jenis_asset" class="form-control">
                        <option>-- Pilih Asset --</option>
                        @foreach ($inventarisITAssets as $inventarisITAsset)
                        <option value="{{ $inventarisITAsset->nama_perangkat }}">{{ $inventarisITAsset->nama_perangkat }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="jenis_asset" class="form-control" placeholder="Jenis Asset"> --}}
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
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