<!-- *********************** Teszt hírlevél küldés modal ***************************** -->
<div class="modal fade" id="test-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Teszt e-mail küldése</h4>
            </div>
            <div class="modal-body">


                <form method="post" action="<?php echo BASE_URL . 'admin/newsletter/test_email'; ?>" name="test_email" id="test_email">
                    <div class="form-group">	
                        <label for="email">Email cím</label>
                        <input id="email" class="form-control" type="text" name="email">
                    </div>
                    	
                        
                        <input id="newsletter_id" class="form-control" type="hidden" name="newsletter_id" value="">
                   
                    
                    
                    
                    <div class="form-group text-center">
                        <input class="btn btn-info" type="submit"  name="submit_test_email" value="Küldés" />
                    </div>
                </form>     
                
                <div id="test_email_message"></div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>

            </div>
        </div>
    </div>
</div>


