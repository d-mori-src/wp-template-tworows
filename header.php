<?php
    $uri = get_theme_file_uri(); // ルートpath
    global $post;
    $slug = $post->post_name; // スラッグ
    $site_url = site_url(); // サイトURL
    $server_uri = $_SERVER['REQUEST_URI'];
    $server_uri_trimed = substr($server_uri, 0, strcspn($server_uri,'?')); 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>Kiss PRESS(キッスプレス) | 兵庫五国を楽しもう</title>
    <meta name="description" content="KissPRESSは兵庫五国の地域情報サイトです。兵庫五国のおでかけ情報やイベント・スポット情報が盛りだくさん">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="canonical" href="<?=$site_url?>">
    <meta property="og:title" content="Kiss PRESS(キッスプレス) | 兵庫五国を楽しもう">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?=$site_url?>">
    <meta property="og:image" content="<?= $uri ?>/meta/OGP.jpg">
    <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <meta name="theme-color" content="">
    <link rel="apple-touch-icon" href="<?= $uri ?>/meta/icon.png">
    <link rel="shortcut icon" href="<?= $uri ?>/meta/favicon.ico">
    
    <!-- フォント関係 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- 各種css -->
    <link rel="stylesheet" href="<?= get_stylesheet_uri(); ?>">
    <link rel="stylesheet" href="<?= $uri ?>/css/normalize.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/style.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/bottomSlidein.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/header.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/footer.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/hamburger.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/modal.css">
    <link href="<?= $uri ?>/js/slick-theme.css" rel="stylesheet" type="text/css">
    <link href="<?= $uri ?>/js/slick.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= $uri ?>/css/slide_orijinal.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/hero.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/top.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/search.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/news_detail.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/news.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/new_shop.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/special.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/special_detail.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/advertisement.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/present.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/present_detail.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/institution.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/mail_magazine.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/contact.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/favorite.css">
    <link rel="stylesheet" href="<?= $uri ?>/css/infinite_scroll.css">
    <?php wp_head(); ?>
</head>
    <body>
        <div class="container">
            <header>
                <div class="innerHeader">
                    <a href="<?=$site_url;?>" class="logo">
                        <img src="<?=$uri?>/img/common/logo.svg" class="logo" alt="logo">
                    </a>
                    <ul class="pc-navi">
                        <li><a href="<?=$site_url;?>/search/イベント"><span class="eventLink">EVENTS</span>イベント</a></li>
                        <li><a href="<?=$site_url;?>/search/グルメ"><span class="groumetLink">GOURMETS</span>グルメ</a></li>
                        <li><a href="<?=$site_url;?>/search/ニュース"><span class="newsLink">NEWS</span>ニュース</a></li>
                        <li><a href="<?=$site_url;?>/features"><span class="featureLink">FEATURES</span>特集記事</a></li>
                    </ul>
                    
                    <ul id="acMenu" class="icon">
                        <li>
                            <a href="<?=$site_url;?>/favorite">
                                <img src="<?=$uri?>/img/header/nice.svg" alt="お気に入り">
                                <span>お気に入り</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="<?=$uri?>/img/header/roulette.svg" alt="おでかけ">
                                <span>おでかけ</span>
                            </a>
                        </li>
                        <li class="searchBtn">
                            <a href="javascript:void(0)">
                                <img src="<?=$uri?>/img/header/search_black.svg" alt="検索">
                                <span>検索</span>
                            </a>
                            <div class="searchContents">
                                <?php get_search_form(); ?>
                            </div>
                        </li>
                        <div id="hamburger">
                            <div class="innerHamburger">
                                <span class="inner_line" id="line1"></span>
                                <span class="inner_line" id="line2"></span>
                                <span class="inner_line" id="line3"></span>
                            </div>
                        </div>
                    </ul>

                    <!-- activeにする場合の例 -->
                    <!-- <ul>
                        <li><a href="<?=$site_url;?>" class="<?=$active = ($server_uri === '/') ? 'active' : ''; ?>">HOME</a></li>
                        <li><a href="<?=$site_url;?>/news" class="<?=$active = ($server_uri === '/news/') ? 'active' : ''; ?>">NEWS</a></li>
                        <li><a href="<?=$site_url;?>/contact" class="<?=$active = ($slug === 'contact') ? 'active' : ''; ?>">CONTACT</a></li>
                    </ul> -->
                </div>
            </header>

            <nav id="nav">
                <section class="innerNav">
                    <a href="<?=$site_url;?>" class="topNavLink">トップページ</a>
                    <ul class="navLink">
                        <li><a href="<?=$site_url;?>/search/イベント"><img src="<?=$uri?>/img/hamburger/ivent.svg" alt="イベント">イベント</a></li>
                        <li><a href="<?=$site_url;?>/search/グルメ"><img src="<?=$uri?>/img/hamburger/gourmet.svg" alt="グルメ">グルメ</a></li>
                        <li><a href="<?=$site_url;?>/search/スイーツ"><img src="<?=$uri?>/img/hamburger/sweets.svg" alt="スイーツ">スイーツ</a></li>
                        <li><a href="<?=$site_url;?>/search/ファミリー"><img src="<?=$uri?>/img/hamburger/family.svg" alt="ファミリー">ファミリー</a></li>
                        <li><a href="<?=$site_url;?>/search/今週末"><img src="<?=$uri?>/img/hamburger/weekend.svg" alt="今週末">今週末</a></li>
                        <li><a href="<?=$site_url;?>/presents"><img src="<?=$uri?>/img/hamburger/present.svg" alt="プレゼント応募">プレゼント応募</a></li>
                    </ul>
                    
                    <div class="pcFlex">
                        <div class="tagLinkWrapper">
                            <h4>話題のタグ</h4>
                            <ul class="tagLink">
                                <!-- 動的表示部分 -->
                                <li><a href=""><span>#</span>秋</a></li>
                                <li><a href=""><span>#</span>紅葉狩り</a></li>
                                <li><a href=""><span>#</span>体験レポ</a></li>
                                <li><a href=""><span>#</span>パン</a></li>
                                <li><a href=""><span>#</span>アート</a></li>
                                <li><a href=""><span>#</span>絶景</a></li>
                            </ul>
                        </div>
                        <ul class="pcAnotherLink">
                            <li><a href="<?=$site_url;?>/mail_magazine">メルマガ登録・解除</a></li>
                            <li><a href="<?=$site_url;?>/facilities">施設一覧</a></li>
                            <li><a href="<?=$site_url;?>/contribute">情報提供</a></li>
                            <li><a href="<?=$site_url;?>/questionnaire">ご意見・ご要望</a></li>
                            <li><a href="<?=$site_url;?>/advertisement">広告掲載のご案内</a></li>
                        </ul>
                    </div>
                    <ul class="snsLink">
                        <li><a href="https://www.facebook.com/KissWEBjp/" target="_blank" rel="noopener noreferrer"><img src="<?=$uri?>/img/common/fb.svg" alt="Facebook"></a></li>
                        <li><a href="https://twitter.com/KissPRESS" target="_blank" rel="noopener noreferrer"><img src="<?=$uri?>/img/common/tw.svg" alt="Twitter"></a></li>
                        <li><a href="https://www.instagram.com/kisspress/" target="_blank" rel="noopener noreferrer"><img src="<?=$uri?>/img/common/insta.svg" alt="INSTAGRAM"></a></li>
                        <li><a href="https://line.me/R/ti/p/@oa-kisspress?from=page" target="_blank" rel="noopener noreferrer"><img src="<?=$uri?>/img/common/line.svg" alt="LINE"></a></li>
                    </ul>
                    <ul class="spAnotherLink">
                        <li><a href="<?=$site_url;?>/mail_magazine">メルマガ登録・解除</a></li>
                        <li><a href="<?=$site_url;?>/facilities">施設一覧</a></li>
                        <li><a href="<?=$site_url;?>/contribute">情報提供</a></li>
                        <li><a href="<?=$site_url;?>/questionnaire">ご意見・ご要望</a></li>
                        <li><a href="<?=$site_url;?>/advertisement">広告掲載のご案内</a></li>
                    </ul>
                </section>
            </nav>

            <ul class="spNavi">
                <li><a href="<?=$site_url;?>">新着</a></li>
                <li><a href="<?=$site_url;?>/search/グルメ">グルメ</a></li>
                <li><a href="<?=$site_url;?>/search/イベント">イベント</a></li>
                <li><a href="<?=$site_url;?>/search/スイーツ">スイーツ</a></li>
                <li><a href="<?=$site_url;?>/search/今週末">今週末</a></li>
            </ul>
