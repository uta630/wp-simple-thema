<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
<?php $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.jp/640x360.png' ; ?>
    <?php if($wp_query->current_post === 0) : ?>
    <article class="c-jumbotron">
        <h2 class="c-jumbotron__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <time class="c-jumbotron__date"><?php the_time("Y.m.d"); ?></time>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="c-jumbotron__thumb"></a>
    </article>
    <?php else :?>
    <article class="c-contents">
        <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="c-contents__thumb"></a>

        <div class="c-contents__detail">
            <?php
                $first_key = key(array_slice(get_the_tags(), 0, 1, true));
                $last_key = key(array_slice(get_the_tags(), -1, 1, true));
                foreach ( get_the_tags() as $key => $tag ) {
            ?>
                <?php if( $key === $first_key ) :?><p class="c-contents__tag"><?php endif; ?>
                <a href="<?php echo get_tag_link( $tag->term_id ); ?>"><?php echo $tag->name ?></a>
                <?php if( $key === $last_key ) :?></p><?php else: ?> / <?php endif; ?>
            <?php } ?>
            <h3 class="c-contents__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <time class="c-contents__date"><?php the_time("Y.m.d"); ?></time>
        </div>
    </article>
    <?php endif; ?>
<?php endwhile;
    else :?>
    <p>お探しの記事は見つかりませんでした。</p>
<?php endif; ?>