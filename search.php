<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
    <h1 class="c-section__heading"><span class="c-section__heading--mark">検索キーワード：</span> "<?php echo get_search_query(); ?>"</h1>
	<?php get_template_part('list'); ?>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>