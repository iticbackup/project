<div class="modal fade modalTeamEdit" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="modalTeamTitleEdit"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-team-update" method="post">
                @csrf
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-centered">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Departemen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data_table_edit"></tbody>
                    </table>
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