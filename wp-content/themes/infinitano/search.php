<?php get_header(); ?>
<!-- list posts -->

<article class="col-md-9">
    <?php if ( is_category() ) { // category ?>
        <h1>
            <?php single_cat_title(); ?>
            <?php _e(" Archive", "infinitano"); ?>
        </h1>
    <?php } elseif ( is_tag() ) { // tag ?>
        <h1>
            <?php single_tag_title(); ?>
            <?php _e(" Archive", "infinitano"); ?>
        </h1>
    <?php } elseif ( is_search() ) { // search ?>
        <h1>
            <?php _e("Search Results for:", "infinitano"); ?>
            <?php the_search_query(); ?>
        </h1>
    <?php } elseif ( is_author() ) { // author ?>
        <h1>
            <?php _e("Author Archive", "infinitano"); ?>
        </h1>
    <?php } elseif ( is_day() ) { // by day ?>
        <h1>
            <?php _e("Daily Archive:", "infinitano"); ?>
            <?php the_time('l, F j, Y'); ?>
        </h1>
    <?php } elseif ( is_month() ) { // by month ?>
        <h1>
            <?php _e("Monthly Archive:", "infinitano"); ?>
            :
            <?php the_time('F Y'); ?>
        </h1>
    <?php } elseif ( is_year() ) { // by year ?>
        <h1>
            <?php _e("Yearly Archive:", "infinitano"); ?>
            :
            <?php the_time('Y'); ?>
        </h1>
    <?php } ?>
    <hr />


    <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
            <!-- post format -->
            <div class="post-container">
                <div class="col-md-2 text-center">
                    <?php
                    /**
                     * @gets the avatar image and adds img-circle class for round image display
                     */
                    echo str_replace("class='avatar", "class=' img-circle ", get_avatar(get_the_author_meta('ID'), 80)); ?>
                    <br>
                    by
                    <?php the_author_link(); ?>
                </div>
                <div class="col-md-10">
                    <h2 class="post-title"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></h2>
                    <!-- post statistics start here -->
                    <aside class="stats">
                        <?php edit_post_link('Click to Edit', '<span class="btn btn-warning btn-xs edit-link"><i class="fa fa-edit"></i> ', '</span>'); // edit link ?>
                        <i class="fa fa-clock-o text-danger"></i>
                        <?php the_time(get_option('date_format')); // time format ?>
                        <i class="fa fa-comments text-danger"></i>
                        <?php comments_popup_link(); // comments link ?>
                        <i class="fa fa-tag text-danger"></i>
                        <?php the_category(', '); // show categories ?>
                        <?php if ( has_tag() ): // show tags ?>
                            <i class="fa fa-tags text-danger"></i>
                            <?php the_tags(); ?>
                        <?php endif; ?>
                    </aside>
                    <!-- post statistics ends here -->
                    <div class="excerpt">
                        <?php if ( has_post_thumbnail() ): // featured image display ?>
                            <a href="<?php the_permalink(); ?>"
                               class="img-thumbnail pull-left img-thumbnail-fix">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        <?php endif; ?>
                        <!-- show content of the post here-->
                        <?php
                        /* @Display content and read more link. */
                        $ismore = @strpos($post->post_content, '<!--more-->');
                        if ( $ismore ) : // If there's a match
                            the_content('<span class="btn btn-danger">Read More <i class="fa fa-angle-right"></i></span>');
                        else : // Else if no <!-- more --> tag exists
                            the_excerpt();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- end post-format -->
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- pagination functions here. -->
    <div class="nav-previous pull-left">
        <?php next_posts_link('<i class="fa fa-angle-left"></i> Older posts'); ?>
    </div>
    <div class="nav-next pull-right">
        <?php previous_posts_link('Newer posts <i class="fa fa-angle-right"></i>'); ?>
    </div>
    <!-- pagination functions ends here -->

    <div class="clearfix"></div>
    <br>
</article>
<!-- sidebar starts here -->
<aside class="col-md-3">
    <?php get_sidebar(); ?>
</aside>
<!-- sidebar ends here -->
<div class="clear"></div>
</div>
<!-- end wrapper -->
<?php get_footer(); ?>
