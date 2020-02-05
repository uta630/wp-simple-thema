<form method="get" class="c-search" action="<?php echo esc_url( home_url('/') ); ?>">
    <label for="search" class="c-search__label">検索</label><input type="search" name="s" class="c-search__field" id="search" value="<?php echo get_search_query(); ?>">
    <button class="c-search__submit">検索</button>
</form>