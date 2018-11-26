<!-- BEGIN SLIDER-->
<div id="slider-wide" class="slider slider--wide">
    <div class="slider__block js-slick-slider">
        <?php foreach ($this->slider as $value) { ?> 
            <div class="slider__item">
                <div class="slider__preview">
                    <div class="slider__img slider__img--lg"><img data-lazy="<?php echo Config::get('slider.upload_path') . $value['picture']; ?>" src="<?php echo SITE_ASSETS; ?>img/lazy-image.jpg" alt=""></div>
                    <div class="slider__img slider__img--sm"><img data-lazy="<?php echo Config::get('slider.upload_path') . $value['picture']; ?>" src="<?php echo SITE_ASSETS; ?>img/lazy-image.jpg" alt=""></div>
                </div>
                <div class="slider__caption">
                    <!-- end of block .slider__price--><a href="#" class="slider__address"><?php echo $value['title']; ?>
                        <p><?php echo $value['text']; ?></p>
                    </a>

                </div>
                <!-- end of block .slider__caption-->
            </div>
        <?php } ?>




    </div>
    <!-- end of block .slider__block-->
    <div class="slider__controls">
        <button class="slider__control slider__control--prev js-banner-prev"></button>
        <button class="slider__control slider__control--next js-banner-next"></button>
    </div>
</div>
<!-- END SLIDER-->
<!-- BEGIN SEARCH-->
<div class="search js-search-form search--index">
    <div class="container">

        <!-- end of block .search__header-->
        <form id="search-form" action="" class="search__form">
            <div class="search__row">
                <div class="search__form-group form-group">
                    <label for="in-contract-type" class="search__form-label control-label">Eladó / kiadó</label>
                    <select id="in-contract-type" name="tipus" data-placeholder="-- mindegy --" class="search__form-control search__form-control--select form-control js-in-select">
                        <option value="elado">Eladó</option>
                        <option value="kiado">Kiadó</option>
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
                                                        <input id="scom-property-map-<?php echo $map; ?>_treeterm_<?php echo $treeterm; ?>" type="checkbox" name="varos[]" value="<?php echo $city['city_name']; ?>" class="in-checkbox">
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
                                        <input id="kategoria_<?php echo $i; ?>" type="checkbox" name="kategoria[]" class="in-checkbox" value="<?php echo $value['kat_nev']; ?>">
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



<section class="properties properties--index">
    <div class="container">
                <header class="properties__header">
            <h3 class="properties__title">Kiemelt ingatlanok</h3>
<a href="ingatlanok" class="properties__btn-more">Összes ingatlan</a>
        </header>
        <div class="properties__list">
            
            
            <div id="owl-demo" class="owl-carousel owl-theme">
                
                
                                    <?php foreach ($this->all_properties as $value) { ?>
                        <?php $photo_array = json_decode($value['kepek']); ?>
                        <div class="properties__item">
                            <div class="properties__thumb">
                                <a href="ingatlanok/adatlap/<?php echo $value['id'] . '/' . Replacer::filterName($value['ingatlan_nev']); ?>" class="item-photo">
                                    <?php if ($value['kepek']) { ?>
                                        <img src="<?php echo Util::small_path(Config::get('ingatlan_photo.upload_path') . $photo_array[0]); ?>" alt="<?php echo $value['ingatlan_nev']; ?>">
                                    <?php } ?>
                                    <?php if ($value['kepek'] == null) { ?>
                                        <img src="<?php echo Util::small_path(Config::get('ingatlan_photo.upload_path') . $photo_array[0]); ?>" alt="<?php echo $value['ingatlan_nev']; ?>">
                                    <?php } ?>
                                </a>
                                <span class="properties__ribon"><?php echo($value['tipus'] == 1) ? 'Eladó' : 'Kiadó'; ?></span>
                            </div>
                            <!-- end of block .properties__thumb-->
                            <div class="properties__info">
                                <a href="ingatlanok/adatlap/<?php echo $value['id'] . '/' . Replacer::filterName($value['ingatlan_nev']); ?>" class="properties__address">
                                    <span class="properties__address-street"><?php echo $value['ingatlan_nev']; ?></span>
                                    <span class="properties__address-city">
                                        <?php
                                        echo $value['city_name'];
                                        echo (isset($value['kerulet'])) ? ', ' . $value['kerulet'] . ' kerület' : '';
                                        ?>
                                    </span>
                                </a>
                                <a href="ingatlanok/adatlap/<?php echo $value['id'] . '/' . Replacer::filterName($value['ingatlan_nev']); ?>" class="properties__more">Részletek <i class="fa fa-chevron-right"></i></a>
                                <!-- end of block .properties__param--><span class="properties__price"><?php echo ($value['tipus'] == 1) ? number_format($value['ar_elado'], 0, ',', '.') : number_format($value['ar_kiado'], 0, ',', '.') ?> Ft</span>
                            </div>
                            <!-- end of block .properties__info-->
                        </div>
                    <?php } ?>
                    <!-- end of block .properties__item-->
                
  
            </div>
        </div>
    </div>
</section>



<!-- END PROPERTIES INDEX-->

<!-- BEGIN SECTION WORKER INDEX-->
<section class="worker worker--index">
    <div class="container">
        <header class="worker__header">
            <h3 class="worker__title">Our Agents</h3>
            <h4 class="worker__headline">Our agents are licensed professionals that specialise in searching, evaluating and negotiating the purchase of property on behalf of the buyer. They will sell you real estate. Insights, tips &amp; how-to guides on selling property and preparing your home or investment property for sale and working to maximise your sale price.</h4>
        </header>
        <!-- end of block .worker__header-->
        <div class="worker__list">
            <div data-sr="enter bottom move 80px, scale(0), over 0s" data-animate-end="animate-end" class="worker__item vcard">
                <div class="worker__photo"><a href="agent_listing.html" class="item-photo item-photo--static"><img src="<?php echo SITE_ASSETS; ?>media-demo/workers/worker-1.jpg" alt="Christopher Pakulla" class="photo"></a>
                    <div class="worker__details"><span class="worker__post">Realtor, West USA Realty</span>
                        <div class="worker__links"><a class="worker__link">
                                <svg class="worker__link-icon">
                                <use xlink:href="#icon-mail"></use>
                                </svg></a><a class="worker__link"><i class="fa fa-linkedin"></i></a><a class="worker__link"><i class="fa fa-facebook"></i></a><a class="worker__link"><i class="fa fa-twitter"></i></a></div>
                    </div>
                </div>
                <div class="worker__info">
                    <h4 class="worker__name fn">Christopher Pakulla</h4><a href="tel:+44(0)2035102390" class="worker__tel uri">+44 (0) 20 3510 2390</a><a href="agent_listing.html" class="worker__more">Read more</a>
                    <!-- end of block .worker__contacts-->
                </div>
                <!-- end of block .worker__info-->
            </div>
            <!-- end of block .worker__item-->
            <div data-sr="enter bottom move 80px, scale(0), over 0.3s" data-animate-end="animate-end" class="worker__item vcard">
                <div class="worker__photo"><a href="agent_listing.html" class="item-photo item-photo--static"><img src="<?php echo SITE_ASSETS; ?>media-demo/workers/worker-2.jpg" alt="Lisa Wemert" class="photo"></a>
                    <div class="worker__details"><span class="worker__post">Managing Broker/Partner, e-PRO</span>
                        <div class="worker__links"><a class="worker__link">
                                <svg class="worker__link-icon">
                                <use xlink:href="#icon-mail"></use>
                                </svg></a><a class="worker__link"><i class="fa fa-linkedin"></i></a><a class="worker__link"><i class="fa fa-facebook"></i></a><a class="worker__link"><i class="fa fa-twitter"></i></a></div>
                    </div>
                </div>
                <div class="worker__info">
                    <h4 class="worker__name fn">Lisa Wemert</h4><a href="tel:+44(0)203510567" class="worker__tel uri">+44 (0) 20 3510 567</a><a href="agent_listing.html" class="worker__more">Read more</a>
                    <!-- end of block .worker__contacts-->
                </div>
                <!-- end of block .worker__info-->
            </div>
            <!-- end of block .worker__item-->
            <div data-sr="enter bottom move 80px, scale(0), over 0.6s" data-animate-end="animate-end" class="worker__item vcard">
                <div class="worker__photo"><a href="agent_listing.html" class="item-photo item-photo--static"><img src="<?php echo SITE_ASSETS; ?>media-demo/workers/worker-3.jpg" alt="Mariusz Ciesla" class="photo"></a>
                    <div class="worker__details"><span class="worker__post">Real Estate Professional</span>
                        <div class="worker__links"><a class="worker__link">
                                <svg class="worker__link-icon">
                                <use xlink:href="#icon-mail"></use>
                                </svg></a><a class="worker__link"><i class="fa fa-linkedin"></i></a><a class="worker__link"><i class="fa fa-facebook"></i></a><a class="worker__link"><i class="fa fa-twitter"></i></a></div>
                    </div>
                </div>
                <div class="worker__info">
                    <h4 class="worker__name fn">Mariusz Ciesla</h4><a href="tel:+44(0)203510334" class="worker__tel uri">+44 (0) 20 3510 334</a><a href="agent_listing.html" class="worker__more">Read more</a>
                    <!-- end of block .worker__contacts-->
                </div>
                <!-- end of block .worker__info-->
            </div>
            <!-- end of block .worker__item-->
            <div data-sr="enter bottom move 80px, scale(0), over 0.8999999999999999s" data-animate-end="animate-end" class="worker__item vcard">
                <div class="worker__photo"><a href="agent_listing.html" class="item-photo item-photo--static"><img src="<?php echo SITE_ASSETS; ?>media-demo/workers/worker-4.jpg" alt="Vladimir Babic" class="photo"></a>
                    <div class="worker__details"><span class="worker__post">Realtor, CDPE</span>
                        <div class="worker__links"><a class="worker__link">
                                <svg class="worker__link-icon">
                                <use xlink:href="#icon-mail"></use>
                                </svg></a><a class="worker__link"><i class="fa fa-linkedin"></i></a><a class="worker__link"><i class="fa fa-facebook"></i></a><a class="worker__link"><i class="fa fa-twitter"></i></a></div>
                    </div>
                </div>
                <div class="worker__info">
                    <h4 class="worker__name fn">Vladimir Babic</h4><a href="tel:+44(0)2044442390" class="worker__tel uri">+44 (0) 20 4444 2390</a><a href="agent_listing.html" class="worker__more">Read more</a>
                    <!-- end of block .worker__contacts-->
                </div>
                <!-- end of block .worker__info-->
            </div>
            <!-- end of block .worker__item-->
        </div>
        <!-- end of block .worker__list-->
    </div>
</section>
<!-- END SECTION WORKER INDEX-->
<!-- BEGIN SECTION ARTICLE-->
<section class="article js-unhide-block article--index">
    <button type="button" class="widget__show js-unhide">Hírek</button>
    <div class="container">
        <div class="article__header">
            <h3 class="article__title">Hírek, hasznos cikkek</h3>
            <h4 class="article__headline">Integer sit amet magna ac ligula gravida auctor ut sed erat. Mauris sit amet tortor quis diam elementum elementum. Cras convallis eget mi nec iaculis.</h4>
        </div>
        <!-- end of block .article__header-->
        <div class="article__list">
            <div data-sr="enter left over 1s and scale up 20%" data-animate-end="" class="article__item"><a href="blog_details.html" class="article__photo"><img src="<?php echo SITE_ASSETS; ?>media-demo/news/news-1.jpg" alt="News title" class="article__photo-img">
                    <time datetime="2009-08-29" class="article__time">OCT<strong>27</strong></time></a>
                <div class="article__details"><a href="blog_details.html" class="article__item-title">Sustainable architecture &amp; design.</a>
                    <div class="article__intro">
                        <p>With the current state of the global climate and the depletion of natural  resources ...</p>
                    </div><a href="blog_details.html" class="article__more">Read more</a>
                </div>
            </div>
            <!-- end of block .article__item-->
            <div data-sr="enter bottom over 1s and scale up 20%" data-animate-end="" class="article__item"><a href="blog_details.html" class="article__photo"><img src="<?php echo SITE_ASSETS; ?>media-demo/news/news-2.jpg" alt="News title" class="article__photo-img">
                    <time datetime="2009-08-29" class="article__time">SEP<strong>02</strong></time></a>
                <div class="article__details"><a href="blog_details.html" class="article__item-title">You’ve been approved for a rental home.</a>
                    <div class="article__intro">
                        <p>If you bought a home in these four areas during the downturn, you’ll make a tidy ...</p>
                    </div><a href="blog_details.html" class="article__more">Read more</a>
                </div>
            </div>
            <!-- end of block .article__item-->
            <div data-sr="enter right over 1s and scale up 20%" data-animate-end="" class="article__item"><a href="blog_details.html" class="article__photo"><img src="<?php echo SITE_ASSETS; ?>media-demo/news/news-3.jpg" alt="News title" class="article__photo-img">
                    <time datetime="2009-08-29" class="article__time">AUG<strong>11</strong></time></a>
                <div class="article__details"><a href="blog_details.html" class="article__item-title">The Block Glasshouse winners.</a>
                    <div class="article__intro">
                        <p>The low-slung ranch house has been reborn. These minimalist designs have high ...</p>
                    </div><a href="blog_details.html" class="article__more">Read more</a>
                </div>
            </div>
            <!-- end of block .article__item-->
        </div>
        <!-- end of block .article__list--><a href="blog.html" class="article__btn-more"> More articles...</a>
    </div>
</section>
<!-- END SECTION ARTICLE-->
<!-- BEGIN SECTION ACHIEVEMENT-->
<div class="achievement">
    <div class="container">
        <div class="row">
            <div data-sr="enter right move 0 over 0 wait 0s" data-animate-callback="countUp" data-animate-end="achievement__item--animate-end" class="achievement__item">
                <svg class="achievement__icon">
                <use xlink:href="#icon-transactions"></use>
                </svg>
                <div data-count-end="755300" data-count-duration="1" class="achievement__counter achievement__counter--lg js-count-up"></div>
                <div class="achievement__counter">755 300</div>
                <div class="achievement__name">Transactions</div>
            </div>
            <div data-sr="enter right move 0 over 0 wait 0.5s" data-animate-callback="countUp" data-animate-end="achievement__item--animate-end" class="achievement__item">
                <svg class="achievement__icon">
                <use xlink:href="#icon-customers"></use>
                </svg>
                <div data-count-end="17620" data-count-duration="1" class="achievement__counter achievement__counter--lg js-count-up"></div>
                <div class="achievement__counter">17 620</div>
                <div class="achievement__name">Satisfied Customers</div>
            </div>
            <div data-sr="enter right move 0 over 0 wait 1s" data-animate-callback="countUp" data-animate-end="achievement__item--animate-end" class="achievement__item">
                <svg class="achievement__icon">
                <use xlink:href="#icon-agency"></use>
                </svg>
                <div data-count-end="790" data-count-duration="1" class="achievement__counter achievement__counter--lg js-count-up"></div>
                <div class="achievement__counter">790</div>
                <div class="achievement__name">Agencies</div>
            </div>
            <div data-sr="enter right move 0 over 0 wait 1.5s" data-animate-callback="countUp" data-animate-end="achievement__item--animate-end" class="achievement__item">
                <svg class="achievement__icon">
                <use xlink:href="#icon-sales"></use>
                </svg>
                <div data-count-end="1528715" data-count-duration="1" class="achievement__counter achievement__counter--lg js-count-up"></div>
                <div class="achievement__counter">1 528 715</div>
                <div class="achievement__name">Sales &amp; Rents</div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION ACHIEVEMENT-->
<!-- BEGIN SECTION REVIEW-->
<section class="review review--wide review--undefined">
    <div class="container">
        <div class="review__header">
            <h3 class="review__title">Rólunk mondták</h3>
            
        </div>
        <!-- end of block .review__header-->
        <div id="review-slider" class="review__list">
            <div class="review__slider js-slick-slider">
                <?php foreach($this->testimonials as $value) : ?>
                <div class="review__item">
                   
                    <div class="review__details"><span class="review__name"><?php echo $value['name'];?></span><span class="review__post"><?php echo $value['title'];?></span>
                        <div class="review__stars"><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i><i class="glyphicon glyphicon-star"></i></div>
                    </div>
                    <div class="review__info">
                        <div class="review__info-quote review__info-quote--open">&rdquo;</div>
                        <p><?php echo $value['text'];?>
                        </p>
                        <div class="review__info-quote review__info-quote--close">&ldquo;</div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- end of block .review__item-->
                </div>
                <?php endforeach ?>


            </div>
        </div>
        <!-- end of block .review__list-->
    </div>
</section>
<!-- END SECTION REVIEW-->
<!-- BEGIN BLOCK GO SUBMIT-->
<div data-sr="flip 45deg over 0.5s" class="gosubmit">
    <div class="container">
        <div class="gosubmit__title">
            <div class="gosubmit__title__row gosubmit__title__row--first">Looking to</div>
            <div class="gosubmit__title__row gosubmit__title__row--second"><span class="gosubmit__title__option">Sell</span>or<span class="gosubmit__title__option">Rent</span></div>
            <div class="gosubmit__title__row gosubmit__title__row--third">Your Property?</div>
        </div>
        <!-- end of block .gosubmit__title--><a href="my_listings_add_edit.html" class="gosubmit__btn">Submit now</a>
    </div>
</div>
<!-- END BLOCK GO SUBMIT-->
<div class="center">
    <div class="container">
    </div>
</div>
<!-- END CENTER SECTION-->
<!-- BEGIN AFTER CENTER SECTION-->
<!-- END AFTER CENTER SECTION-->
<!-- BEGIN PARTNERS-->
<section class="partners">
    <div class="container">
        <header class="partners__header">
            <h3 class="partners__title">Our Partners</h3>
            <h4 class="partners__headline">
                At RS, our partners make great digital experiences possible by offering our products, consulting
                expertise and the products of our technology partners
            </h4>
        </header>
        <!-- end of block .partners__header-->
        <div id="partners-slider" class="partners__list">
            <div class="partners__slider js-slick-slider">
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-1.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-2.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-3.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-4.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-5.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-3.png" alt=""></div>
                <div class="partners__item"><img src="<?php echo SITE_ASSETS; ?>media-demo/partners/logo-company-2.png" alt=""></div>
            </div>
            <div class="partners__controls">
                <button class="partners__arrow partners__arrow--prev js-partners-prev"></button>
                <button class="partners__arrow partners__arrow--next js-partners-next"></button>
            </div>
            <!-- end of block .partners__controls-->
        </div>
        <!-- end of block .partners__list-->
    </div>
</section>
<!-- end of block .partners-->
<!-- END PARTNERS-->
<!-- BEGIN SUBSCRIBE-->
<div class="subscribe">
    <div class="container">
        <div class="subscribe__row">
            <form action="#" class="subscribe__form js-subscribe-form">
                <h4 class="subscribe__title">Newsletters</h4>
                <div class="subscribe__group form-group">
                    <label class="sr-only">Newsletters</label>
                    <input type="email" placeholder="Input your e-mail" name="email" required data-parsley-trigger="change" class="subscribe__field form-control js-subscribe-email">
                </div>
                <button type="submit" class="subscribe__submit js-subscribe-submit">SUBMIT</button>
            </form>
            <!-- end of block .subscribe__form-->
        </div>
    </div>
</div>
<!-- END SUBSCRIBE-->
