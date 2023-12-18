<div class="modal fade modalEdit" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Buat Disk Management</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form" method="post">
                @csrf
                <input type="hidden" name="edit_file_manager_disk_id" id="edit_file_manager_disk">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="edit_departemen_id" class="form-control" id="edit_departemen_id">
                        <option>-- Pilih Departemen --</option>
                        @foreach ($departemens as $departemen)
                        <option value="{{ $departemen->id }}">{{ $departemen->nama_departemen }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" class="form-control" name="departemen_id" placeholder="Nama Departemen"> --}}
                </div>
                <div class="mb-3">
                    <label class="form-label">Limit Disk</label>
                    <input type="text" name="edit_limit_disk" id="edit_range_01">
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