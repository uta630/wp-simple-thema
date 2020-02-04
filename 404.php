<?php get_header(); ?>

    <body <?php body_class(); ?>>
        <?php get_template_part('content', 'menu'); ?>

        <main class="main main-col" ontouchstart="">
            <div class="main--inner">
                <section class="block" id="coding">
                    <div class="block-col post">
                        <div class="post__text">
                            <h2>お探しのページが見つかりませんでした。</h2>

                            <p>申し訳ありません。お探しのページが見つかりませんでした。</p>
                            <p>お手数ですが改めてお求めのページをお探しください。</p>
                            <a href="<?php echo home_url() ?>">TOPページに戻る</a>
                        </div>
                    </div>
                </section>
                
                <?php get_sidebar(); ?>
            </div>
        </main><!-- /main -->

<?php get_footer(); ?>