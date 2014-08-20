<?php get_header(); ?>
<!-- show 404 error page -->

<article class="col-md-9">
    <div class="jumbotron text-center">
        <h1>Oops, 404!</h1>

        <p>We're unable to find what you are looking for. Search for the content
            below.</p>
        <hr />
        <div class="well">
            <form role="search" method="get" id="searchform"
                  action="<?php echo esc_url(home_url('/')); ?>"
                  class="form-horizontal">
                <div class="searchform">
                    <input type="text" value="" name="s" id="s"
                           class="form-control input-lg"
                           placeholder="Search..." required="required" />
                    <input type="submit" id="searchsubmit" value="Search"
                           class=" btn btn-lg btn-danger" />
                </div>
            </form>
        </div>
    </div>
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
