<div class="modal fade" tabindex="-1" role="dialog" id="email-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Üzenetküldés</h4>
            </div>
            <div class="modal-body">
                <div class="contact register signup">
                    <h2>Küldjön üzenetet</h2>

                    <div id="email_message"></div>   

                    <form method="post" action="send_email/init/contact" id="contact_form">
                        <div class="form-group">
                            <label>Név*</label>
                            <input type="text" class="form-control" placeholder="Teljes név" name="name">
                        </div>
                        <div class="form-group">
                            <label>E-mail cím*</label>
                            <input type="text" class="form-control" placeholder="E-mail cím" name="email">
                        </div>
                        <input type="text" name="mezes_bodon" id="mezes_bodon">

                        <div class="form-group">
                            <label>Üzenet*</label>
                            <textarea name="message" rows="4"></textarea>
                        </div>
                        <button type="submit" name="submit_contact_email" id="submit-button"> Küldés </button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

