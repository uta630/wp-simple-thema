<form method="get" class="c-search" action="<?php echo esc_url( home_url('/') ); ?>">
    <input type="search" name="s" class="c-search__field" value="<?php echo get_search_query(); ?>">
    <button class="c-search__submit material-icons"></button>
</form>