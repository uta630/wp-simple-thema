<?php get_header(); ?>

<body <?php body_class(); ?>>

<?php get_template_part('content', 'menu'); ?>

<div class="c-section l-section">
    <main class="c-section__primary">
        <article class="c-article">   
            <?php if(have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h2><?php the_title(); ?></h2>
                    <time class="material-icons"><?php the_time("Y/m/d"); ?></time>
                    <?php if(has_post_thumbnail()): ?><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" loading="lazy"><?php endif; ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <h2 class="title">記事が見つかりませんでした。</h2>
                <p>検索で見つかるかもしれません。</p><br>
                <?php get_search_form(); ?>
            <?php endif; ?>
            
            <div class="c-social">
                <a href="https://twitter.com/share?url=<?php echo get_the_permalink(); ?>&text=<?php echo get_the_title(); ?>" target="_blank" class="c-social--twitter">Twitter</a>
                <a href="http://getpocket.com/edit?url=<?php echo get_the_permalink();?>&title=<?php echo get_the_title(); ?>" target="_blank" class="c-social--pocket">Pocket</a>
                <a href="https://social-plugins.line.me/lineit/share?url=<?php echo get_the_permalink(); ?>" target="_blank" class="c-social--line">LINE</a>
                <a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo get_the_permalink();?>&title=<?php echo get_the_title(); ?>" target="_blank" class="c-social--hatebu">はてブ</a>
            </div>
        </article>
    </main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>