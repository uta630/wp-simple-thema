<?php
add_theme_support( 'title-tag' );
add_theme_support('post-thumbnails');

$custom_header_defaults = array(
    'default-image' => get_bloginfo('template_url').'/images/headers/logo.png',
    'header-text' => false,
);

add_theme_support('custom-header', $custom_header_defaults);

function add_default_scripts() {
    wp_enqueue_script( 
      'base-script', 
      get_theme_file_uri( '/script.js' ),
      false
    );
  }
  add_action('wp_enqueue_scripts', 'add_default_scripts');

register_nav_menu('mainmenu', 'メインメニュー');
function addMenuClass( $classes ) {
    $classes = array(
        'nav__listItem',
    );
    return $classes;
}
add_filter( 'nav_menu_css_class', 'addMenuClass', 10, 2 );

function pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;

    global $paged;
    if(empty($paged)) $paged = 1 ;
   
    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }
   
    if(1 != $pages) {
        echo "<div class=\"c-pager\">";
        echo "<ul class=\"c-pager__items\">\n";

        if($paged > 1) echo "<li class=\"c-pager__item c-pager__prev\"><a href='".get_pagenum_link($paged - 1)."'>Prev</a></li>\n";

        for($i=1; $i <= $pages; $i++){
            if(1 != $pages && ( !($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )){
                echo ($paged == $i) ? "<li class=\"c-pager__item active\">".$i."</li>\n" : "<li class=\"c-pager__item\"><a href='".get_pagenum_link($i)."' class=\"c-pager__link\">".$i."</a></li>\n" ;
            }
        }

        if($paged < $pages) echo "<li class=\"c-pager__item c-pager__next\"><a href='".get_pagenum_link($paged + 1)."' class=\"c-pager__link\">Next</a></li>\n";
        echo "</ul>\n";
        echo "</div>\n";
    }
}

add_action('widgets_init', 'widgets_area');
add_action('widgets_init', create_function('', 'return register_widget("panel_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("recommend_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("custom_category_widget");'));
add_action('widgets_init', create_function('', 'return register_widget("custom_archive_widget");'));

function widgets_area() {
    register_sidebar(
        array(
            'name'          => 'サイドバー',
            'id'            => 'right_sidebar',
            'before_widget' => '<section class="c-aside__item">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="c-aside__heading">',
            'after_title'   => '</h4>',
        )
    );
}

class panel_widget extends WP_Widget {
    function panel_widget() {
        parent::WP_Widget(false, $name = 'パネルウィジェット');
    }

    function form($instance) {
        $title = esc_attr($instance['title']);
        $body  = esc_attr($instance['body']);
        ?>
            <p>
                <label for="<?php echo $this-> get_field_id('title'); ?>">
                    <?php echo 'タイトル : '; ?>
                </label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
            </p>
            <p>
                <label for="<?php echo $this-> get_field_id('body'); ?>"><?php echo '内容 : '; ?></label>
                <textarea class="widefat" cols="20" rows="16" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo $body ; ?></textarea>
            </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body']  = trim($new_instance['body']);

        return $instance;
    }

    function widget($args, $instance) {
        extract( $args );
     
        if($instance['title'] != ''){
            $title = apply_filters('widget_title', $instance['title']);
        }
        echo $before_widget;
        if( $title ){
            echo $before_title . $title . $after_title;
        }

        $title = apply_filters('widget_title', $instance['title']);
        $body  = apply_filters('widget_body' , $instance['body']);

        if($title) {
            ?>
                <p><?php echo $body; ?></p>
            <?php
        }
        echo $after_widget;
    }
}
class recommend_widget extends WP_Widget {
    function recommend_widget() {
        parent::WP_Widget(false, $name = '最近の投稿(写真付き)');
    }
    function form( $instance ) {
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('表示する投稿数:'); ?></label>
                <input type="text" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" value="<?php echo esc_attr( $instance['limit'] ); ?>" size="3">
            </p>
        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = is_numeric($new_instance['limit']) ? $new_instance['limit'] : 5;
        return $instance;
    }
    function widget( $args, $instance ) {
        extract( $args );
     
        if($instance['title'] != ''){
            $title = apply_filters('widget_title', $instance['title']);
        }
        echo $before_widget;
        if( $title ){
            echo $before_title . $title . $after_title;
        }
        ?>
        <?php
            query_posts("posts_per_page=".$instance['limit']);
            if(have_posts()):
            while(have_posts()): the_post();
        ?>
        <article class="c-list">
            <h4 class="c-list__heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php $image_url = has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://placehold.jp/640x360.png' ; ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" class="c-list__thumb"></a>
        </article>
        <?php endwhile; endif; ?>
        <?php
        echo $after_widget;
    }
}
class custom_category_widget extends WP_Widget {
    function custom_category_widget() {
        parent::WP_Widget(false, $name = 'カスタムカテゴリー');
    }
    function form( $instance ) {
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
    function widget( $args, $instance ) {
        extract( $args );
     
        if($instance['title'] != ''){
            $title = apply_filters('widget_title', $instance['title']);
        }
        echo $before_widget;
        if( $title ){
            echo $before_title . $title . $after_title;
        }
        ?>
        <?php
            $last_key = key(array_slice(get_categories(), -1, 1, true));
            foreach( get_categories() as $key => $category ){
        ?>
            <a href="<?php echo get_category_link( $category->term_id ); ?>" class="c-links__item"><?php echo $category->name; ?></a><?php if( $key !== $last_key ) :?> / <?php endif; ?>
        <?php } ?>
        <?php
        echo $after_widget;
    }
}
class custom_archive_widget extends WP_Widget {
    function custom_archive_widget() {
        parent::WP_Widget(false, $name = 'カスタムアーカイブ');
    }
    function form( $instance ) {
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
        <?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
 
    function widget( $args, $instance ) {
        extract($args);
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Archives') : $instance['title'], $instance, $this->id_base);
 
        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
 
        $this->get_archives(apply_filters('widget_archives2_args', array('show_post_count' => $c)));
 
        echo $after_widget;
    }
 
    function get_archives($args = '') {
 
        $defaults = array(
            'limit' => '',
            'before' => '',
            'after' => '',
            'show_post_count' => false,
            'echo' => 1,
            'order' => 'DESC',
        );
 
        $r = wp_parse_args( $args, $defaults );
        extract( $r, EXTR_SKIP );
 
        $arcresults = $this->get_monthly_archives_data($r);
 
        $output = $this->build_html($r, $arcresults);
 
        if ( $echo )
            echo $output;
        else
            return $output;
    }
 
    function get_monthly_archives_data($args) {
        global $wpdb;
        extract( $args, EXTR_SKIP );
 
        if ( '' != $limit ) {
            $limit = absint($limit);
            $limit = ' LIMIT '.$limit;
        }
 
        $order = strtoupper( $order );
        if ( $order !== 'ASC' )
            $order = 'DESC';
 
        //filters
        $where = apply_filters( 'getarchives2_where', "WHERE post_type = 'post' AND post_status = 'publish'", $args );
        $join = apply_filters( 'getarchives2_join', '', $args );
 
        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
        $key = md5($query);
        $cache = wp_cache_get( 'get_archives2' , 'general');
        if ( !isset( $cache[ $key ] ) ) {
            $arcresults = $wpdb->get_results($query);
            $cache[ $key ] = $arcresults;
            wp_cache_set( 'get_archives2', $cache, 'general' );
        } else {
            $arcresults = $cache[ $key ];
        }
 
        return $arcresults;
    }
 
    function build_html($args, $arcresults) {
        extract( $args, EXTR_SKIP );
 
        if ( !$arcresults )
            return '';
 
        $cur_year = -1;
        $afterafter = $after;
 
        foreach ( (array) $arcresults as $arcresult ) {
            $output .= $this->get_archives_link($arcresult->year, $arcresult->month, $before, $after);
        }
 
        return $output;
    }
 
    function get_archives_link($year, $month, $before = '', $after = '') {
        global $wp_locale;
 
        $url = get_month_link($year, $month);
        $url = esc_url($url);
 
        $link_html = "$before<a href='$url' class='c-archive'>$year.$month</a>$after";
        $link_html = apply_filters( 'get_archives2_link', $link_html );
 
        return $link_html;
    }
}

function excerpt_length($length) {
    return 46;
}
add_filter('excerpt_length', 'excerpt_length');
function excerpt_more($more) {
    return '…<a href="'. get_permalink($post->ID) . '">' . '続きを読む' . '</a>';
}
add_filter('excerpt_more', 'excerpt_more');

add_action('admin_menu', 'add_custom_inputbox');
add_action('save_post', 'save_custom_postdata');

function add_custom_inputbox() {
    add_meta_box( 'about_id', 'ABOUT入力欄', 'custom_area', 'page', 'normal' );
    add_meta_box( 'profile_id', 'プロフィール入力欄', 'custom_area2', 'page', 'normal' );
}

function custom_area() {
    global $post;

    echo 'コメント : <textarea cols="50" rows="5" name="about_msg">'.get_post_meta($post->ID, 'about', true).'</textarea>';
}
function custom_area2() {
    global $post;

    echo '<table>';
    for($i = 1; $i <= 8; $i++) {
        echo '<tr><td>info'.$i.' : </td><td><input cols="50" rows="5" name="profile_info'.$i.'" value="'.get_post_meta($post->ID, 'profile_info'.$i, true).'"></td></tr>';
    }
    echo '</table>';
}

function save_custom_postdata($post_id) {

    $about_msg    = '';
    $profile_data = '';
    
    if( $img_top != get_post_meta($post_id, 'img-top', true)){
        update_post_meta($post_id, 'img-top', $img_top);
    } elseif($img_top == '') {
        delete_post_meta($post_id, 'img-top', get_post_meta($post_id, 'img-top', true));
    }
    if(isset($_POST['about_msg'])){
        $about_msg = $_POST['about_msg'];
    }

    if( $about_msg != get_post_meta($post_id, 'about', true)){
        update_post_meta($post_id, 'about', $about_msg);
    } elseif($about_msg == '') {
        delete_post_meta($post_id, 'about', get_post_meta($post_id, 'about', true));
    }

    for($i = 1; $i <= 8; $i++) {
        if(isset($_POST['profile_info'.$i])){
            $profile_data = $_POST['profile_info'.$i];
        }
        if($profile_data != get_post_meta($post_id, 'profile_info'.$i, true)){
            update_post_meta($post_id, 'profile_info'.$i, $profile_data);
        } elseif($profile_data == '') {
            delete_post_meta($post_id, 'profile_info'.$i, get_post_meta($post_id, 'profile_info'.$i, true));
        }
    }
}
