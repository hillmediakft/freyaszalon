<!-- BEGIN SEARCH-->
<div class="search js-search-form search--map-bottom">
    <div class="container">
        <div class="search__header">
            <h3 class="search__title"><span class="search__title-btn js-search-title-btn">Keresés</span></h3>
        </div>
        <!-- end of block .search__header-->
        <form id="search-form" action="ingatlanok" class="search__form">
            <div class="search__row">
                <div class="search__form-group form-group">
                    <label for="in-contract-type" class="search__form-label control-label">Eladó / kiadó</label>
                    <select id="in-contract-type" name="tipus" data-placeholder="-- mindegy --" class="search__form-control search__form-control--select form-control js-in-select">
                        <option value="1">Eladó</option>
                        <option value="2">Kiadó</option>
                    </select>
                </div>
                <div class="search__form-group form-group"><span class="search__form-label control-label">Település</span>
                    <div class="dropdown dropdown--select">
                        <button type="button" data-toggle="dropdown" data-placeholder="-- mindegy --" class="dropdown-toggle js-select-checkboxes-btn">-- mindegy --</button>
                        <div class="dropdown-menu js-dropdown-menu js-select-checkboxes">
                            <div class="region-select">
                                <ul id="region" class="bonsai region-select__list">
                                  
                                     
                                    <li>
                                        <input id="scom-property-map-1_treeterm_37" type="checkbox" name="varos[]" value="budapest" class="in-checkbox">
                                        <label for="scom-property-map-1_treeterm_37" data-toggle="tooltip" data-placement="top" title="Budapest" class="in-label">Budapest</label>
                                        <ul>
                                            <?php for ($i = 1; $i <= 23; $i++) { ?>
                                                <li>
                                                    <input id="scom-property-map-1_treeterm_<?php echo $i; ?>" type="checkbox" name="kerulet[]" value="<?php echo $i; ?>" class="in-checkbox">
                                                    <label for="scom-property-map-1_treeterm_<?php echo $i; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $i; ?>. kerület" class="in-label"><?php echo $i; ?>. kerület</label>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </li>
                                    <?php $map = 2; ?>
                                    <?php $treeterm = $i; ?>
                                    <?php foreach ($this->city_list as $key => $value) : ?>

                                        <li>
                                            <input id="scom-property-map-<?php echo $map; ?>_treeterm_<?php echo $treeterm; ?>" type="checkbox" name="megye[]" value="<?php echo $key; ?>" class="in-checkbox">
                                            <label for="scom-property-map-<?php echo $map; ?>_treeterm_<?php echo $treeterm; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $key; ?>" class="in-label"><?php echo $key; ?></label>

                                            <ul>
                                                <?php foreach ($value as $city) { ?>
                                                    <?php $treeterm++; ?>
                                                    <li>
                                                        <input id="scom-property-map-<?php echo $map; ?>_treeterm_<?php echo $treeterm; ?>" type="checkbox" name="varos[]" value="<?php echo $city['city_id']; ?>" class="in-checkbox">
                                                        <label for="scom-property-map-<?php echo $map; ?>_treeterm_<?php echo $treeterm; ?>" data-toggle="tooltip" data-placement="top" title="Glendale" class="in-label"><?php echo $city['city_name']; ?></label>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php $map++; ?>
                                    <?php endforeach ?>
                                </ul>
                                <div class="region-select__buttons">
                                    <button type="button" class="region-select__btn region-select__btn--reset js-select-checkboxes-reset">Törlés</button>
                                    <button type="button" class="region-select__btn js-select-checkboxes-accept">OK</button>
                                </div>
                            </div>
                            <!-- end of block .region-select-->
                        </div>
                        <!-- end of block .dropdown-menu-->
                    </div>
                </div>
                <div class="search__form-group form-group"><span class="search__form-label control-label">Ingatlan típus</span>
                    <div class="dropdown dropdown--select">
                        <button type="button" data-toggle="dropdown" data-placeholder="---" class="dropdown-toggle js-select-checkboxes-btn">-- mindegy --</button>
                        <div class="dropdown-menu js-dropdown-menu js-select-checkboxes">
                            <ul>
                                <?php $i = 1; ?>
                                <?php foreach ($this->ingatlan_kat_list as $value) : ?>
                                    <li>
                                        <input id="kategoria_<?php echo $i; ?>" type="checkbox" name="kategoria[]" class="in-checkbox" value="<?php echo $value['kat_id']; ?>">
                                        <label for="kategoria_<?php echo $i; ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $value['kat_nev']; ?>" class="in-label"><?php echo $value['kat_nev']; ?></label>
                                    </li>
                                    <?php $i++; ?>
                                <?php endforeach ?> 

                            </ul>
                            <!-- end of block .dropdown-menu-->
                        </div>
                    </div>
                </div>


                <div class="search__form-group form-group">
                    <label for="range_price" class="search__form-label control-label">Ár</label>
                    <div class="search__ranges">
                        <input id="range_price" name="range_price" class="js-search-range search__ranges-in">
                    </div>
                </div>
                <div class="search__form-group form-group">
                    <label for="range_area" class="search__form-label control-label">Alapterület</label>
                    <div class="search__ranges">
                        <input id="range_area" name="range_area" class="js-search-range search__ranges-in">
                    </div>
                </div>
                <div class="search__form-group form-group">
                    <label for="range_room" class="search__form-label control-label">Szobák száma</label>
                    <div class="search__ranges">
                        <input id="range_room" name="range_room" class="js-search-range search__ranges-in">
                    </div>
                </div>
            </div>
            <input id="action" type="hidden" name="action" value="search">
            <div class="search__row search__row--buttons">
                <div class="search__buttons">
                    <button type="button" class="search__btn search__btn--reset js-form-reset">Töröl</button>
                    <button type="submit" class="search__btn search__btn--action">Keresés</button>
                </div>
            </div>
        </form>
        <!-- end of block .search__form#search-form-->
    </div>
</div>
<!-- END SEARCH-->

