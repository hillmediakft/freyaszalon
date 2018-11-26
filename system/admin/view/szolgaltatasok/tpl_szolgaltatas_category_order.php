<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <!-- 
        <h3 class="page-title">
                Szolgáltatás <small>hozzáadása</small>
        </h3>
        -->

        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="admin/home">Kezdőoldal</a> 
                    <i class="fa fa-angle-right"></i>
                </li>
                <li><span>Szolgáltatás hozzáadása</span></li>
            </ul>
        </div>
        <div class="margin-bottom-20"></div>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <!-- END PAGE HEADER-->

        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <!-- ÜZENETEK -->
                <div id="message">
                    <?php $this->renderFeedbackMessages(); ?>			
                </div> 
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption"><i class="fa fa-sort-numeric-asc"></i>Szolgáltatás kategóriák sorba rendezése</div>

                    </div>

                    <div class="note note-info">
                        A sorrend módosításához mozgassa kurzort a sor elején lévő ikon fölé. A négy irányú nyíl kurzor jelzi, hogy az elem mozgatható. Az új helyre helyezés után a sorrend frissítése azonnal megtörténik, nem szükség mentésre.
                    </div>                   


                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="dd" id="nestable_list_3">
                                    <ol class="dd-list">
                                        <?php foreach ($this->category_list as $value) { ?>
                                            <li class="dd-item dd3-item" data-id="<?php echo $value['szolgaltatas_list_id']; ?>">
                                                <div class="dd-handle dd3-handle">
                                                </div>
                                                <div class="dd3-content">
                                                    <?php echo $value['szolgaltatas_list_name']; ?>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ol>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>

            </div> <!-- END COL-MD-12 -->
        </div> <!-- END ROW -->	
    </div> <!-- END PAGE CONTENT-->    
</div> <!-- END PAGE CONTENT WRAPPER -->
</div><!-- END CONTAINER -->