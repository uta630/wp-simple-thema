<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
<?php $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.jp/640x360.png' ; ?>
    <article class="c-contents">
        <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="c-contents__thumb" loading="lazy"></a>

        <div class="c-contents__detail">
            <?php if(has_category()):?><p class="c-contents__tag"><a href="<?php echo get_category_link( get_the_category()[0]->cat_ID ); ?>"><?php echo get_the_category()[0]->cat_name; ?></a></p><?php endif; ?>
            <h3 class="c-contents__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <time class="c-contents__date"><?php the_time("Y.m.d"); ?></time>
        </div>
    </article>
<?php endwhile;
    else :?>
    <p>お探しの記事は見つかりませんでした。</p>
<?php endif; ?>