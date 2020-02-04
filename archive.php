<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
	<?php get_template_part('list'); ?>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>