<div class="modal fade scanCheckIT" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0">Detail Scan Barcode</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Kode</td>
                                <td>:</td>
                                <td id="scan_kode_it"></td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td id="scan_lokasi_it"></td>
                            </tr>
                            {{-- <tr>
                                <th class="text-center detailScanTitle" colspan="3"></th>
                            </tr> --}}
                        </thead>
                        <tbody id="data-detail-it">
                        </tbody>
                        {{-- <tbody id="detailK3Apar">
                        </tbody> --}}
                    </table>
                </div>
                {{-- <div class="text-center mt-2 mb-2" id="setInputData"></div> --}}
            </div>
            <div class="modal-footer">
                {{-- <a class="btn btn-success" id="setInputData"><i class="fa fa-plus"></i> <b>Input Data</b></a> --}}
            </div>
        </div>
    </div>
</div>