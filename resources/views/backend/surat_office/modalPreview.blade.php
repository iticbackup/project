<div class="modal fade modalPreviews" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="lihat_title_pengajuan"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-verifikasi" method="post">
                @csrf
                <input type="hidden" name="preview_id" readonly id="preview_id">
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" readonly id="lihat_nomor_surat">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="text" class="form-control" readonly id="lihat_tanggal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Perihal</label>
                        <input type="text" class="form-control" readonly id="lihat_keterangan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Verifikasi</label>
                        <div class="col-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="2">
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="4">
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="3">
                                <label class="form-check-label" for="inlineRadio3">Update</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="files"></tbody>
                        </table>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remaks</label>
                        <textarea name="remaks" class="form-control" id="" cols="30" rows="5"></textarea>
                        {{-- <input type="text" class="form-control" readonly id="preview_keterangan"> --}}
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