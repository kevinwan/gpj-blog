<div class="sidebar">
    <ul class="sidebar_list">
        <?php if ( ! dynamic_sidebar('Sidebar') ) : // if sidebar widgets not specified, show this sidebar as default. ?>
            <li id="sidebar-search" class="widget">
                <h3><i class="fa fa-search"></i> Search</h3>
                <?php get_search_form(); ?>
            </li>
            <li id="sidebar-archives" class="widget">
                <h3><i class="fa fa-th"></i> Archives</h3>
                <ul>
                    <?php wp_get_archives('type=monthly'); ?>
                </ul>
            </li>
            <li id="sidebar-meta" class="widget">
                <h3><i class="fa fa-user"></i> Meta</h3>
                <ul>
                    <?php wp_register(); ?>
                    <li>
                        <?php wp_loginout(); ?>
                    </li>
                    <?php wp_meta(); ?>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
</div>
