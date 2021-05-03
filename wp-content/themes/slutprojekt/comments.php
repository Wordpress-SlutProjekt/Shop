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
