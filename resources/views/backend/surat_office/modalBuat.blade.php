<div class="modal fade modalBuat" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Buat Surat Office</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form-simpan">
            {{-- <form method="post" action="{{ route('surat_office.simpan') }}"> --}}
                @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kop Surat</label>
                    <input type="text" name="nama_kop_surat" class="form-control" placeholder="Nama Kop Surat">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">Bulan</label>
                            <select name="bulan" class="form-control" id="">
                                <option>-- Pilih Bulan --</option>
                                @foreach ($bulan as $b)
                                <option value="{{ $b['no'] }}">{{ $b['nama_bulan'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Tahun</label>
                            <select name="tahun" class="form-control" id="">
                                <option>-- Pilih Tahun --</option>
                                <?php 
                                $earliest_year_first = 2000;
                                $earliest_year_end = 2040;
                                foreach (range(date('Y'), $earliest_year_end)as $key => $x) {
                                    echo '<option value="'.$x.'"'.($x === $earliest_year_first ? ' selected="selected"' : '').'>'.$x.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Jumlah</label>
                            <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                        </div>
                    </div>
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