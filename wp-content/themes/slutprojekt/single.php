<?php 
get_header();
?>

<div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./blog.html">Blog</a>
                        <span>Being seen: how is age diversity effecting change in fashion and beauty?</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                <?php if (have_posts()) : ?>
        <?php if (($wp_query->post_count) > 1) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php the_excerpt() ?>
       <?php endwhile; ?>
       <?php else : ?>

     <?php while (have_posts()) : the_post(); ?>
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                        <?php the_post_thumbnail( array(500, 500 ) );?> 
                            <div class="blog__details__item__title">
                                <span class="tip"><?php the_category(', '); ?> </span>
                                <h4><?php the_title(); ?></h4>
                                <ul>
                                    <li>by <span><a href="<?php the_permalink() ?>"><?php the_author(); ?></a></span></li>
                                    <li><?php the_time(); ?></li>
                                    <li><?php echo sprintf(__('<a href="%s">%s comment(s)</a>', 'textdomain'), get_comments_link(),get_comments_number()); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p><?php the_content() ?></p>
                        </div>
                        <?php $tags = get_tags(); ?>
                        <div class="blog__details__tags">
                        <?php foreach ( $tags as $tag ) { ?>
                            <a href="<?php echo get_tag_link( $tag->term_id ); ?> " rel="tag"><?php echo $tag->name; ?></a>
                            <?php } ?>

                        </div>
                        <?php endwhile; ?>

<?php endif; ?>

<?php else : ?>

<?php endif; ?>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6> <?php previous_post_link()?>        	  
<i class="fa fa-angle-left"></i> </h6>
                                    </div>
                                </div>
         
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        <h6><?php next_post_link() ?> <i class="fa fa-angle-right"></i></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h5><?php echo sprintf(__('<a href="%s">%s comment(s)</a>', 'textdomain'), get_comments_link(),get_comments_number()); ?></h5>
                            <a href="#" class="leave-btn">Leave a comment</a>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="img/blog/details/comment-1.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                <?php if( is_single() ) : ?>

                                <?php  foreach (get_comments() as $comment): ?>
                                    <div><?php echo $comment->comment_author; ?> said: "<?php echo $comment->comment_content; ?>".</div>
                                    <?php endforeach; ?>
                                <?php comments_template(); ?>      

                                <?php endif; ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                <li><a href="#">All <span>(250)</span></a></li>
                                <li><a href="#">Fashion week <span>(80)</span></a></li>
                                <li><a href="#">Street style <span>(75)</span></a></li>
                                <li><a href="#">Lifestyle <span>(35)</span></a></li>
                                <li><a href="#">Beauty <span>(60)</span></a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Feature posts</h4>
                            </div>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-1.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-2.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                            <a href="#" class="blog__feature__item">
                                <div class="blog__feature__item__pic">
                                    <img src="img/blog/sidebar/fp-3.jpg" alt="">
                                </div>
                                <div class="blog__feature__item__text">
                                    <h6>Amf Cannes Red Carpet Celebrities Kend...</h6>
                                    <span>Seb 17, 2019</span>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>