<?php

// テーマのセットアップ
// HTML5でマークアップさせる
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// Feedのリンクを自動で生成する
add_theme_support( 'automatic-feed-links' );
// アイキャッチ画像を使用する設定
add_theme_support( 'post-thumbnails' );

// 画像パスを出力するショートコード
add_shortcode('img', 'img_func');
  function img_func() {
  return get_template_directory_uri().'/img/';
}

add_action( 'init' , 'my_remove_post_editor_support' );
function my_remove_post_editor_support() {
 // remove_post_type_support( 'post', 'title' ); //タイトル
 remove_post_type_support( 'post', 'editor' ); //本文
}

// カスタム投稿タイプの追加
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'newshop', // 投稿タイプ名の定義
        array(
            'labels' => array(
            'name' => __( 'NEW SHOP' ), // 表示する投稿タイプ名
            'singular_name' => __( 'NEW SHOP' )
            ),
            'public' => true,
            'menu_position' => 5,
        )
    );
    register_post_type( 'special', // 投稿タイプ名の定義
        array(
            'labels' => array(
            'name' => __( '特集記事' ), // 表示する投稿タイプ名
            'singular_name' => __( '特集記事' )
            ),
            'public' => true,
            'menu_position' => 5,
            'supports' => array('title','editor'),
        )
    );

    // カスタム分類（タクソノミー）
    // register_post_type( 'products', /* カスタム投稿タイプスラッグ */
    //     array(
    //         'labels' => array( /* 表示させる文字 */
    //             'name' => '製品',
    //             'singular_name' => '製品',
    //             'all_items' => '製品一覧',
    //             'add_new' => '製品追加',
    //             'add_new_item' => '製品の追加',
    //             'edit_item' => '製品の編集',
    //             'new_item' => '製品追加',
    //             'view_item' => '製品を表示',
    //             'search_items' => '製品を検索',
    //             'not_found' =>  '製品が見つかりません',
    //             'not_found_in_trash' => 'ゴミ箱内に製品が見つかりませんでした。',
    //             'parent_item_colon' => ''
    //         ),
    //         'public' => true, /* 管理画面にメニューを作る */
    //         'show_ui' => true, /* 管理画面にメニューを作る */
    //         'query_var' => true,
    //         'hierarchical' => false, /* 固定ページみたいに記事間の親子関係をつくる */
    //         'supports' => array('title','editor','thumbnail'), /* 管理画面で登録できる項目 */
    //         'menu_position' =>5, /* 管理画面のメニューの位置（5,10,15・・・） */
    //         'has_archive' => true, /* アーカイブページを持つ */
    //         'rewrite' => array( /* slug:スラッグ名　with_front:アーカイブページURLに/archive/をつける */
    //         'slug' => 'products','with_front' => false)
    //     )
    // );
    // register_taxonomy('products_cat','products', array(
    //     'hierarchical' => true,
    //     'labels' => array( /* 表示させる文字 */
    //         'name' => 'カテゴリ',
    //         'singular_name' => 'カテゴリ',
    //         'search_items' =>  'カテゴリを検索',
    //         'all_items' => 'すべてのカテゴリ',
    //         'parent_item' => '親分類',
    //         'parent_item_colon' => '親分類：',
    //         'edit_item' => '編集',
    //         'update_item' => '更新',
    //         'add_new_item' => 'カテゴリを追加',
    //         'new_item_name' => '名前',
    //     ),
    //     'show_ui' => true, /* 管理画面にメニューを作る */
    //     'rewrite' => array(
    //         'slug' => 'products','with_front' => true,'hierarchical' => true)
    // ));
}

function add_prev_posts_link_class() {
    return 'class="prevLink"';
}
add_filter( 'previous_posts_link_attributes', 'add_prev_posts_link_class' );

function add_next_posts_link_class() {
    return 'class="nextLink"';
}
add_filter( 'next_posts_link_attributes', 'add_next_posts_link_class' );

/* 投稿アーカイブページの作成 */
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news'; //任意のスラッグ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

// 投稿ページのパーマリンクをカスタマイズ
function add_article_post_permalink( $permalink ) {
    $permalink = '/news' . $permalink;
    return $permalink;
}
add_filter( 'pre_post_link', 'add_article_post_permalink' );
 
function add_article_post_rewrite_rules( $post_rewrite ) {
    $return_rule = array();
    foreach ( $post_rewrite as $regex => $rewrite ) {
        $return_rule['news/' . $regex] = $rewrite;
    }
    return $return_rule;
}
add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );

function my_custom_search_url() {
	if ( is_search() && ! empty( $_GET['s'] ) ) {
		wp_safe_redirect( home_url( '/search/' ) . urlencode( get_query_var( 's' ) ) );
	exit();
	}
}
add_action( 'template_redirect', 'my_custom_search_url' );

function filter_ptags_on_images($content){
return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');