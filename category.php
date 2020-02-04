<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
    <h1 class="c-section__heading"><?php echo esc_html( get_category( $cat )->name ); ?></h1>
	<?php get_template_part('list'); ?>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>