<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="admin/home">Kezdőoldal</a> 
				<i class="fa fa-angle-right"></i>
			</li>
			<li><span>Beállítások</span></li>
		</ul>
	</div>
    <!-- END PAGE TITLE & BREADCRUMB-->
	<!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">

            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>

            <form action='' name='settings_form' id='settings_form' method='POST'>
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption"><i class="fa fa-cogs"></i>Beállítások szerkesztése</div>
	                    <div class="actions">
                            <button class='btn green btn-sm' type='submit' name='submit_settings'><i class="fa fa-check"></i> Mentés</button>
                        </div>							
					</div>
					<div class="portlet-body">

                        <div class="form-group">
                            <label for="setting_ceg">Cég</label>	
                            <input type='text' name='setting_ceg' class='form-control input-large' value="<?php echo (empty($this->settings['ceg'])) ? "" : $this->settings['ceg']; ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="setting_cim">Cím</label>	
                            <input type='text' name='setting_cim' class='form-control input-large' value="<?php echo (empty($this->settings['cim'])) ? "" : $this->settings['cim']; ?>"/>
                        </div>

                        <div class="form-group">
                            <label for="setting_tel">Telefonszám</label>	
                            <input type='text' name='setting_tel' class='form-control input-large' value="<?php echo (empty($this->settings['tel'])) ? "" : $this->settings['tel']; ?>"/>
                        </div>
                                            
                        <div class="form-group">
                            <label for="setting_tel2">Telefonszám 2</label>	
                            <input type='text' name='setting_tel2' class='form-control input-large' value="<?php echo (empty($this->settings['tel2'])) ? "" : $this->settings['tel2']; ?>"/>
                        </div>                                            
                                            
                         <div class="form-group">
                            <label for="setting_opening_hours">Nyitva tartás</label>	
                            <input type='text' name='setting_opening_hours' class='form-control input-large' value="<?php echo (empty($this->settings['opening_hours'])) ? "" : $this->settings['opening_hours']; ?>"/>
                        </div>                                           

                        <div class="form-group">
                            <label for="setting_email">E-mail (lábléc e-mail űrlap)</label>	
                            <input type='text' name='setting_email' class='form-control input-large' value="<?php echo (empty($this->settings['email'])) ? "" : $this->settings['email']; ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="setting_pagination">Megjelenített elemek száma oldalanként</label>  
                            <select name="setting_pagination" class="form-control input-large">
                                <?php for ($i = 6; $i < 22 ; $i += 3) {
                                    echo '<option value="' . $i . '"';
                                    echo ($this->settings['pagination'] == $i) ? 'selected' : '';
                                    echo '>' . $i . '</option>' . "\r\n";
                                } ?>

                            </select>
                        </div> 
						
						<div class="checkbox">
                            <label>
                                <input type="checkbox" name='setting_pop_up' value="1" <?php echo ($this->settings['pop_up']) ? "checked" : ""; ?>>
                                    Felugró ablak megjelenítése
                            </label>
                        </div>  

					</div> <!-- END USER GROUPS PORTLET BODY-->
				</div> <!-- END USER GROUPS PORTLET-->
            </form>
		</div> <!-- END COL-MD-12 -->
	</div> <!-- END ROW -->	
</div> <!-- END PAGE CONTENT-->