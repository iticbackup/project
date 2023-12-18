<div class="modal fade modalPreviewsVerifikasi" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="preview_title_pengajuan"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" readonly id="preview_nomor_surat">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="text" class="form-control" readonly id="preview_tanggal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Perihal</label>
                        <input type="text" class="form-control" readonly id="preview_keterangan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pengguna</label>
                        <input type="text" class="form-control" readonly id="preview_pengguna">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div id="preview_status"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File</label>
                        <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama File</th>
                                    <th>Status</th>
                                    <th>Remaks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="preview_files"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>