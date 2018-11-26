<!-- Sidebar -->
<div class="col-md-4 marbot40">
    <div class="panel panel-body panel-grey marbot0">
        <div class="clearfix">
            <div class="input-group stylish-input-group">
                <input type="text" class="form-control"  placeholder="Keresés" >
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button> 
            </div>
        </div>
        <div class="border-seperator"></div>
        <div class="clearfix">
            <h3 class="text-center sidebar-heading"> Hír kategóriák </h3>

            <ul class="list-type1-small fontresize">
                <?php foreach ($this->blog_categories as $value) { ?>
                    <li><a href="<?php echo 'hirek/kategoria/' . $value['category_id']; ?>" class="reverse"><?php echo $value['category_name']; ?></a></li>
                <?php } ?>
            </ul>

            </ul>
        </div>
        <div class="border-seperator"></div>

    </div>

    <div class="panel panel-body panel-grey marbot0 bottom-right">
        <div class="clearfix">
            <h3 class="text-center sidebar-heading"> Kezelések </h3>
            <ul class="list-type1-small fontresize">
                <li><a href="#" class="reverse">Kezelés 1</a></li>
                <li><a href="#" class="reverse">Kezelés 2</a></li>
                <li><a href="#" class="reverse">Kezelés 3</a></li>
                <li><a href="#" class="reverse">Kezelés 4</a></li>
            </ul>
        </div>

    </div>
    <!-- Sidebar -->
</div>
