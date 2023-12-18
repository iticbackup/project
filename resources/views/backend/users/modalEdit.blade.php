<div class="modal fade modalEdit" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Edit User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form" method="post">
                @csrf
                <input type="hidden" name="edit_id" id="edit_id">
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="edit_username" class="form-control" id="edit_username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="edit_name" class="form-control" id="edit_name" placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="edit_email" class="form-control" id="edit_email" aria-describedby="emailHelp" placeholder="Email">
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="edit_password" class="form-control" id="edit_password" placeholder="Password">
                </div> --}}
                <div class="mb-3">
                    <label class="form-label">Roles</label>
                    <select class="form-control" name="edit_roles" id="edit_roles">
                        <option>-- Roles --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->roles }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-soft-primary btn-sm">Update</button>
                <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>