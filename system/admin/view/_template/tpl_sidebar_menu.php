<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="100" style="padding-top: 20px">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper hide">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler"> </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>

        <!-- BEGIN MENU ITEMS -->

        <!-- KEZDŐOLDAL -->
        <li class="nav-item start <?php $this->menu_active('home'); ?> ">
            <a href="admin/home" class="nav-link">
                <i class="fa fa-home"></i>
                <span class="title">Kezdőoldal</span>
            </a>
        </li>

        <!-- SZERKESZTHETŐ OLDALAK -->
        <li class="nav-item <?php $this->menu_active('pages|content'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-files-o"></i>
                <span class="title">Oldalak</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('pages'); ?> ">
                    <a href="admin/pages" class="nav-link ">
                        <span class="title">Oldalak listája</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('content'); ?>"> 
                    <a href="admin/content" class="nav-link ">
                        <span class="title">Egyéb tartalom</span>
                    </a>
                </li>				
            </ul>
        </li>

        <!-- SZOLGÁLTATÁSOK MENÜ -->

        <li class="nav-item <?php $this->menu_active('szolgaltatasok'); ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-star"></i> 
                <span class="title">Szolgáltatások</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'index'); ?>">
                    <a href="admin/szolgaltatasok" class="nav-link">
                        <span class="title">Szolgáltatások listája</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'uj_szolgaltatas'); ?>">
                    <a href="admin/szolgaltatasok/uj_szolgaltatas" class="nav-link">
                        <span class="title">Új szolgáltatás</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'szolgaltatas_sorrend'); ?>">
                    <a href="admin/szolgaltatasok/szolgaltatas_sorrend" class="nav-link">
                        <span class="title">Szolgáltatások sorrendje</span>
                    </a>
                </li> 
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'category'); ?>">
                    <a href="admin/szolgaltatasok/category"class="nav-link">
                        <span class="title">Szolgáltatás kategóriák</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'category_insert'); ?>">
                    <a href="admin/szolgaltatasok/category_insert" class="nav-link">
                        <span class="title">Új kategória hozzáadása</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('szolgaltatasok', 'szolgaltatas_kategoria_sorrend'); ?>">
                    <a href="admin/szolgaltatasok/szolgaltatas_kategoria_sorrend" class="nav-link">
                        <span class="title">Kategóriák sorrendje</span>
                    </a>
                </li>               
            </ul>
        </li>

        <!-- SZOLGÁLTATÁSOK MENÜ VÉGE -->        

        <!--  GALÉRIÁK -->
        <li class="nav-item <?php $this->menu_active('photo_gallery'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-picture-o"></i>
                <span class="title">Képgaléria</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('photo_gallery', 'index'); ?> ">
                    <a href="admin/photo_gallery" class="nav-link ">
                        <span class="title">Képgaléria</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('photo_gallery', 'category'); ?> ">
                    <a href="admin/photo_gallery/category" class="nav-link ">
                        <span class="title">Képgaléria kategóriák</span>
                    </a>
                </li>
            </ul>
        </li>  

        <!--  GALÉRIÁK -->
        <li class="nav-item <?php $this->menu_active('before_after_photo_gallery'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-files-o"></i>
                <span class="title">Előtte-utána képek</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('before_after_photo_gallery', 'index'); ?> ">
                    <a href="admin/before_after_photo_gallery" class="nav-link ">
                        <span class="title">Előtte-utána képek</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('before_after_photo_gallery', 'category'); ?> ">
                    <a href="admin/before_after_photo_gallery/category" class="nav-link ">
                        <span class="title">Előtte-utána kategóriák</span>
                    </a>
                </li>
            </ul>
        </li>        

        <!-- CREW MEMBERS MENÜ -->		
        <li class="nav-item <?php $this->menu_active('crew_members'); ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-male"></i> 
                <span class="title">Kollégák</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('crew_members', 'index'); ?>">
                    <a href="admin/crew_members">
                        Kollégák listája</a>
                </li>
                <li class="nav-item <?php $this->menu_active('crew_members', 'new_crew_member'); ?>">
                    <a href="admin/crew_members/new_crew_member">
                        Új kolléga hozzáadása</a>
                </li>
                <li class="nav-item <?php $this->menu_active('crew_members', 'category'); ?>">
                    <a href="admin/crew_members/category">
                        Kategóriák</a>
                </li>
                <li class="nav-item <?php $this->menu_active('crew_members', 'category_insert'); ?>">
                    <a href="admin/crew_members/category_insert">
                        Új kategória hozzáadása</a>
                </li>                

            </ul>
        </li>				
        <!-- CREW MEMBERS MENÜ VÉGE -->        

        <!-- ADMIN USERS -->
        <li class="nav-item <?php $this->menu_active('users'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-users"></i>
                <span class="title">Felhasználók</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('users', 'index'); ?> ">
                    <a href="admin/users" class="nav-link">
                        <span class="title">Felhasználók listája</span>
                    </a>
                </li>
                <?php if (1) { ?>
                    <li class="nav-item <?php $this->menu_active('users', 'insert'); ?> ">
                        <a href="admin/users/insert" class="nav-link">
                            <span class="title">Új felhasználó</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item <?php $this->menu_active('users', 'profile'); ?> ">
                    <a href="admin/users/profile/<?php echo Session::get('user_id'); ?>" class="nav-link">
                        <span class="title">Profilom</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('users', 'user_roles|edit_roles'); ?> ">
                    <a href="admin/users/user_roles" class="nav-link">
                        <span class="title">Csoportok</span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- MODULOK -->
        <li class="nav-item <?php $this->menu_active('slider|testimonials|clients|promotions|offers|pop_up_windows'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-suitcase"></i>
                <span class="title">Modulok</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <!-- SLIDER -->
                <li class="nav-item <?php $this->menu_active('slider'); ?> ">
                    <a href="admin/slider" class="nav-link">
                        <span class="title">Slider beállítások</span>
                    </a>
                </li>
                <!-- RÓLUNK MONDTÁK --> 
                <li class="nav-item <?php $this->menu_active('testimonials'); ?> ">
                    <a href="admin/testimonials" class="nav-link">
                        <span class="title">Rólunk mondták</span>
                    </a>
                </li>
                <!-- CSOMAGOK --> 
                <li class="nav-item <?php $this->menu_active('offers'); ?> ">
                    <a href="admin/offers" class="nav-link">
                        <span class="title">Kedvezményes csomagok</span>
                    </a>
                </li>
                <!-- RÓLUNK MONDTÁK --> 
                <li class="nav-item <?php $this->menu_active('promotions'); ?> ">
                    <a href="admin/promotions" class="nav-link">
                        <span class="title">Akciók kezelése</span>
                    </a>
                </li>
                <!-- RÓLUNK MONDTÁK --> 
                <li class="nav-item <?php $this->menu_active('pop_up_windows'); ?> ">
                    <a href="admin/pop_up_windows" class="nav-link">
                        <span class="title">Felugró ablak</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- GYAKORI KÉRDÉSEK -->
 <!--       <li class="nav-item <?php $this->menu_active('gyik'); ?>">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-suitcase"></i>
                <span class="title">Gyakori kérdések</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('gyik', 'index'); ?>">
                    <a href="admin/gyik" class="nav-link">
                        GYIK listája</a>
                </li>
                <li class="nav-item <?php $this->menu_active('gyik', 'new_gyik'); ?>">
                    <a href="admin/gyik/new_gyik" class="nav-link">
                        Új kérdés hozzáadása</a>
                </li>
                <li class="nav-item <?php $this->menu_active('gyik', 'category'); ?>">
                    <a href="admin/gyik/category" class="nav-link">
                        GYIK kategóriák</a>
                </li>
                <li class="nav-item <?php $this->menu_active('gyik', 'category_insert'); ?>">
                    <a href="admin/gyik/category_insert" class="nav-link">
                        Új kategória hozzáadása</a>
                </li>
            </ul>
        </li> -->
        <!-- REFERENCIÁK VÉGE -->   


        <!-- FELIRATKOZOTTAK -->
        <li class="nav-item <?php $this->menu_active('site_users'); ?>">
         
            <a href="admin/site-users" class="nav-link">
                <i class="fa fa-user"></i> 
                <span class="title">Hírlevélre feliratkozók</span>
            </a>
        </li>  
        <!-- FELIRATKOZOTTAK VÉGE -->

        <!-- HÍRLEVÉL MENÜ -->
        <li class="nav-item <?php $this->menu_active('newsletter'); ?>">
             <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-envelope"></i>
                <span class="title">Hírlevél</span>
                <span class="arrow"></span>
            </a>
           <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('newsletter', 'index'); ?>">
                    <a href="admin/newsletter"  class="nav-link">Hírlevelek</a>
                </li>
                <li class="nav-item <?php $this->menu_active('newsletter', 'new_newsletter'); ?>">
                    <a href="admin/newsletter/new_newsletter"  class="nav-link">Új hírlevél</a>
                </li>
                <li class="nav-item <?php $this->menu_active('newsletter', 'newsletter_stats'); ?>">
                    <a href="admin/newsletter/newsletter_stats"  class="nav-link">Elküldött hírlevelek</a>
                </li>
                <li class="nav-item <?php $this->menu_active('newsletter', 'templates'); ?>">
                    <a href="admin/newsletter/templates"  class="nav-link">Hírlevél sablonok</a>
                </li>                                

            </ul>
        </li>	        


        <!-- FILE-KEZELŐ -->
        <li class="nav-item <?php $this->menu_active('file_manager'); ?> ">
            <a href="admin/file_manager" class="nav-link">
                <i class="fa fa-folder-open-o"></i>
                <span class="title">Fájlkezelő</span>
            </a>
        </li>

        <!-- TARTALOM CÍMKÉZÉSA -->
        <li class="nav-item <?php $this->menu_active('terms'); ?> ">
            <a href="admin/terms" class="nav-link">
                <i class="fa fa-tags"></i>
                <span class="title">Tartalom címkézése</span>
            </a>
        </li>

        <!-- ALAP BEÁLLÍTÁSOK -->
        <li class="nav-item <?php $this->menu_active('settings'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-cogs"></i>
                <span class="title">Beállítások</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('settings'); ?> ">
                    <a href="admin/settings" class="nav-link">
                        <span class="title">Oldal szintű beállítások</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- BLOG -->
 <!--       <li class="nav-item <?php $this->menu_active('blog'); ?> ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-suitcase"></i>
                <span class="title">Hírek / blog</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php $this->menu_active('blog', 'index'); ?> ">
                    <a href="admin/blog" class="nav-link ">
                        <span class="title">Bejegyzések</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('blog', 'insert'); ?> ">
                    <a href="admin/blog/insert" class="nav-link ">
                        <span class="title">Új bejegyzés</span>
                    </a>
                </li>
                <li class="nav-item <?php $this->menu_active('blog', 'category'); ?> ">
                    <a href="admin/blog/category" class="nav-link ">
                        <span class="title">Kategóriák</span>
                    </a>
                </li>
            </ul>
        </li> -->

        <!-- DOKUMENTÁCIÓ -->
  <!--      <li class="nav-item <?php $this->menu_active('user_manual'); ?> ">
            <a href="admin/user-manual" class="nav-link">
                <i class="fa fa-file-text-o"></i>
                <span class="title">Dokumentáció</span>
            </a>
        </li>  -->
        <!--  DOKUMENTÁCIÓ VÉGE -->

    </ul> <!-- END SIDEBAR MENU -->
</div> <!-- END SIDEBAR -->