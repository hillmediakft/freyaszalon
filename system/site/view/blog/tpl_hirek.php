<div class="center">
    <div class="container">
        <div class="row">
            <!-- BEGIN LISTING-->
            <div class="listing listing--properties-list">
                <header class="listing__header">
                    <h1 class="listing__title">Hírek</h1>
                    <h5 class="listing__headline">Friss hírek, információk</h5>
                </header>



                <div class="listing__main">
                    <div class="article article--details article--page">
                     
<?php foreach ($this->blog_list as $value) { ?>

                            <article class="article__item"><a class="article__comment" href="blog_details.html"><i class="fa fa-comments"></i>2 Comments</a>
                                <time class="article__time" datetime="2009-08-29">SEP<strong>02</strong></time>
                                <h3 class="article__item-title"><a href="blog_details.html">You’ve been approved for a rental home. Now what?</a></h3>
                                <div class="article__tags">Category:<a href="#">Villa for sale</a>, <a href="#">Florida</a>, <a href="#">Miami</a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="article__preview">

                                </div>
                                <div class="article__intro">
                                    <p>Congratulations! You’ve found the perfect rental property and your application has been approved. Now there’s just a few things you’ll need. We work hard to achieve quality at affordable prices for our customers through optimizing our entire value chain, by building long-term supplier relationships, investing in highly automated production and producing large volumes.</p>
                                </div><a class="article__more" href="blog_details.html">Read more</a>
                            </article>                            

<?php } ?>

                    </div>
                </div>                


            </div>
            <!-- END LISTING-->
            <!-- SIDEBAR -->
            <?php include SITE . '/view/_template/tpl_sidebar.php'; ?>
            <!-- END SIDEBAR-->
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- END CENTER SECTION-->

