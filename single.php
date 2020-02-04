<?php
/*
Template Name: Article 〜記事ページ〜
*/
?>

<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
        <article class="c-article">   
            <?php if(have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    <time><?php the_time("Y/m/d"); ?></time>
                    <?php if(has_post_thumbnail()): ?><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"><?php endif; ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <h2 class="title">記事が見つかりませんでした。</h2>
                <p>検索で見つかるかもしれません。</p><br>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </article>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>