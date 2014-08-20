<?php get_header(); ?>
<!-- list posts -->

<article class="col-md-9">
  <?php if(have_posts()): ?>
  <?php while(have_posts()): the_post(); ?>
  <!-- page post format -->
  <div class="post-container">
    <div>
      <h2 class="post-title"><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <!-- page post statistics start here -->
      <aside class="stats"> 
      <?php edit_post_link('Click to Edit', '<span class="btn btn-warning btn-xs edit-link"><i class="fa fa-edit"></i> ', '</span>'); ?>
      <i class="fa fa-clock-o text-danger"></i>
        <?php the_time('F dS, Y'); ?>
        <i class="fa fa-comments text-danger"></i>
        <?php comments_popup_link(); ?>
      </aside>
      <!-- page post statistics ends here -->
      <div class="content">
        <?php the_content(); ?>
      </div>
     <div class="clearfix"></div>
      <br />
      <br />
      <!-- page comments template -->
      <?php comments_template(); ?>
    </div>
    <div class="clearfix"></div>
  </div>
  <!-- end page post-format -->
  <?php endwhile; ?>
  <?php endif; ?>
  
  
  
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
