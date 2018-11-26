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
            <li><span>Feliratkozottak</span></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>  

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <div id="message"></div> 						
            <!-- echo out the system feedback (error and success messages) -->
            <?php $this->renderFeedbackMessages(); ?>				


            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption"><i class="fa fa-user"></i>Regisztrált látogatók</div>

                    <div class="actions">

                        <div class="btn-group">
                            <a data-toggle="dropdown" href="#" class="btn btn-sm default">
                                <i class="fa fa-wrench"></i> Eszközök <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="#" id="print_users"><i class="fa fa-print"></i> Nyomtat </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>


                <!-- *************************** REGISZTRÁLT LÁTOGATÓK TÁBLA *********************************** -->						

                <div class="portlet-body">
                    <div class="table-container">
                        <div class="table-actions-wrapper">
                            <span>
                            </span>
                            <select class="table-group-action-input form-control input-inline input-small input-sm">
                                <option value="">Válasszon...</option>
                                <option value="delete">Töröl</option>
                                <option value="activate">Aktivál</option>
                                <option value="deactivate">Blokkol</option>
                            </select>
                            <button class="btn btn-sm grey-cascade table-group-action-submit" title="Csoportos művelet végrehajtása"><i class="fa fa-check"></i> Csoportművelet</button>
                        </div>
                        <table class="table table-striped table-bordered table-hover" id="users">
                            <thead>
                                <tr role="row" class="heading">
                                    <th width="1%">
                                        <input type="checkbox" class="group-checkable">
                                    </th>
                                    <th width="5%">
                                        ID
                                    </th>
                                    <th width="20%">
                                        Név
                                    </th>
                                    <th width="30%">
                                        E-mail cím
                                    </th>
                                    <th width="10%">
                                        Státusz
                                    </th>
                                    <th width="5%">

                                    </th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="search_user_id">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="search_user_name">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-sm" name="search_user_email">
                                    </td>


                                    <td>
                                        <select name="search_user_active" class="form-control form-filter input-sm">
                                            <option value="">Válasszon...</option>
                                            <option value="1">Aktív</option>
                                            <option value="0">Inaktív</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div style="width:80px">
                                            <button class="btn btn-sm grey-cascade filter-submit margin-bottom" title="Szűrés indítása"><i class="fa fa-search"></i></button>
                                            <button class="btn btn-sm grey-cascade filter-cancel" title="Szűrési feltételek törlése"><i class="fa fa-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>	
            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
