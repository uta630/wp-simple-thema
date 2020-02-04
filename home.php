<?php
/*
Template Name: Home 〜トップページ〜
*/
?>

<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
	<?php get_template_part('loop'); ?>

    <?php if(function_exists("pagination")) pagination($additional_loop->max_num_pages); ?>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>