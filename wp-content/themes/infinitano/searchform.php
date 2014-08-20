<!-- search form format -->
<form role="search" method="get" id="searchform"
      action="<?php echo esc_url(home_url('/')); ?>" class="form-horizontal">
    <div class="searchform">
        <input type="text" value="" name="s" id="s" class="form-control input-sm"
               placeholder="Search..." required="required" />
        <input type="submit" id="searchsubmit" value="Search"
               class=" btn btn-danger" />
    </div>
</form>
