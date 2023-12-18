<div class="modal fade modalAllReports" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Download All Reports</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="get" action="{{ route('inventaris.k3.report_periode') }}" target="_blank" enctype="multipart/form-data">
                {{-- @csrf --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">From</label>
                                <select name="periode_from" class="form-control" id="">
                                    <option value="-">-- Pilih Periode Awal --</option>
                                    @for ($i = 2020; $i <= date("Y"); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                {{-- <input type="date" name="from" class="form-control"> --}}
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">To</label>
                                <select name="periode_to" class="form-control" id="">
                                    <option value="-">-- Pilih Periode Akhir --</option>
                                    @for ($i = 2020; $i <= date("Y"); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
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
