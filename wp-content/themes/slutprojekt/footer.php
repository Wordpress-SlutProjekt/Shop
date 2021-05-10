<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7">
                <div class="footer__about">
                    <div class="footer__payment no-border">
                    <?php dynamic_sidebar('footercolumnone') ?> 
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5">
                <div class="footer__widget">
                    <?php dynamic_sidebar('footercolumntwo') ?> 
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="footer__widget">
                    <?php dynamic_sidebar('footercolumnthree') ?> 
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8">
                <div class="footer__newslatter">
                    
                    <div class="footer__social">
                    <?php dynamic_sidebar('footercolumnfour') ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright__text">
                <?php dynamic_sidebar('footercolumnbottom') ?>     
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
<?php
wp_footer();