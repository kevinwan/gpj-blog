<?php get_header(); ?>
<!-- list posts -->

<article class="col-md-9">
    <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
            <!-- post format -->
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="post-container">
                    <div class="col-md-2 text-center">
                        <?php
                        /**
                         * @gets the avatar image and adds img-circle class for round image display
                         */
                        echo str_replace("class='avatar", "class='img-circle ", get_avatar(get_the_author_meta('ID'), 80)); ?>
                        <br />
                        by <?php the_author_link(); ?>
                    </div>
                    <div class="col-md-10">
                        <h2 class="post-title"><a href="<?php the_permalink(); ?>">
                                <?php
                                if ( empty($post->post_title) ):
                                    echo 'No Title'; // Show if no title is found
                                else:
                                    the_title(); // Show the title
                                endif;
                                ?>
                                <?php if ( is_sticky($post->ID) ) {
                                    echo '<i class="fa fa-paperclip" title="Sticky Post"></i>';
                                } // show sticky icon ?>
                            </a></h2>
                        <!-- post statistics start here -->
                        <aside class="stats">
                            <?php edit_post_link('Click to Edit', '<span class="btn btn-warning btn-xs edit-link"><i class="fa fa-edit"></i> ', '</span>'); // edit post link ?>
                            <i class="fa fa-clock-o text-danger"></i>
                            <?php the_time('F dS, Y'); // time format ?>
                            <i class="fa fa-comments text-danger"></i>
                            <?php comments_popup_link(); // comments link ?>
                            <i class="fa fa-tag text-danger"></i>
                            <?php the_category(', '); // categories list ?>
                            <?php if ( has_tag() ): // if post has tags show them ?>
                                <i class="fa fa-tags text-danger"></i>
                                <?php the_tags(); ?>
                            <?php endif; ?>
                        </aside>
                        <!-- post statistics ends here -->
                        <article class="content">
                            <?php the_content(); ?>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <?php wp_link_pages('before=<div class="pagination">Pages: &after=</div>&pagelink=<span class="btn btn-danger">%</span>'); // if post has pagination, show it. ?>
                            </div>
                        </article>
                        <div class="clearfix"></div>
                        <br />
                        <hr />
                        <!-- pagination functions here. -->
                        <div class="nav-previous pull-left">
                            <?php next_post_link('%link', '<span class="btn btn-danger"><i class="fa fa-angle-left"></i> %title </span>'); // next post ?>
                        </div>
                        <div class="nav-next pull-right">
                            <?php previous_post_link('%link', '<span class="btn btn-danger">%title <i class="fa fa-angle-right"></i></span>'); // previous post ?>
                        </div>
                        <div class="clearfix"></div>
                        <!-- pagination functions ends here -->
                        <br />
                        <br />
                        <!-- comments template -->
                        <?php if ( is_singular() ) wp_enqueue_script("comment-reply"); ?>
                        <?php comments_template(); // include comments.php ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>
            <!-- end post-format -->
        <?php endwhile; ?>
    <?php endif; ?>
    <div class="clearfix"></div>
    <br>
</article>
<!-- sidebar starts here -->
<aside class="col-md-3">
    <?php get_sidebar(); // get sidebar ?>
</aside>
<!-- sidebar ends here -->
<div class="clear"></div>
</div>
<!-- end wrapper -->
<?php get_footer(); ?>
