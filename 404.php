<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
        <h1 class="c-section__heading">お探しのページが見つかりませんでした。</h1>

        <div class="c-error">
            <p>お探しのページが見つかりませんでした。</p>
            <p>お手数ですが改めてお求めのページをお探しください。</p>
            <a href="<?php echo home_url() ?>">TOPページへ</a>
        </div>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>