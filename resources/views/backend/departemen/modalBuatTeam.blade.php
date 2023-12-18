<div class="modal fade modalBuatTeam" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="modalBuatTeamTitle"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-team-simpan" method="post">
                @csrf
                <input type="hidden" name="buat_departemen_id" id="buat_departemen_id">
                {{-- <input type="hidden" name="buat_team_id" id="buat_team_id"> --}}
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="buat_user_id" class="form-control" id="">
                        <option>-- Pilih User --</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    {{-- <input type="text" name="username" class="form-control" placeholder="Username"> --}}
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Departemen</label>
                    <input type="text" class="form-control" name="nama_departemen" placeholder="Nama Departemen">
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Submit</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>