<?php
/*
Template Name: Info 〜インフォメーション〜
*/
?>

<!-- ヘッダ -->
<?php get_header(); ?>

    <!-- メニュー -->
    <?php get_template_part('content', 'menu'); ?>

    <div id="main">

        <!-- blog_list -->
        <section class="block" id="map">
            <div class="block-head title">
                <h1 class="block-head__header"><?php echo get_the_title(); ?></h1>
            </div>
            
            <?php if(have_posts()) :
                    while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('block-col post'); ?>>
                    <div class="post__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile;
                    else :?>
                <div class="post">
                    <h2>記事はありません</h2>
                    <p>お探しの記事は見つかりませんでした。</p>
                </div>
            <?php endif; ?>
        </section>

    </div>

<!-- フッタ -->
<?php get_footer(); ?>