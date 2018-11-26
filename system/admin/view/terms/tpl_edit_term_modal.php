<div class="modal fade" id="edit_term" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Címke szerkesztése</h4>
            </div>
            <form action="admin/terms/update_term" method="POST" id="update_term_form">
                <div class="modal-body">


                    <div class="row">	
                        <div class="col-md-12">

                            <!-- CÍMKE -->	
                            <div class="form-group">
                                <label for="term" class="control-label">Címke<span class="required">*</span></label>
                                <input type="text" name="term" id="term" value="" class="form-control" required>
                                <input type="hidden" name="id" id="term_id" value="" class="form-control" />
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Bezár</button>
                    <button id="submit_update_term" class="btn green btn-sm" type="submit"><i class="fa fa-check"></i> Mentés</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

