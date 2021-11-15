<?php
    $uri = get_theme_file_uri();
    $site_url = site_url();
    $server_uri = $_SERVER['REQUEST_URI'];
    global $post;
    $slug = $post->post_name;
?>

<section class="leftSidebar">
    <ul>
        <li><a href="<?=$site_url?>" class="<?=$active = ($server_uri === '/') ? 'active' : ''; ?>"><img src="<?=$uri?>/img/common/home.svg" alt="ホーム" />ホーム</a></li>
        <li><a href="<?=$site_url?>/present" class="<?=$active = ($slug === 'present') ? 'active' : ''; ?>"><img src="<?=$uri?>/img/common/precent.svg" alt="プレゼント応募" />プレゼント応募</a></li>
        <li><a href="<?=$site_url?>/institution" class="<?=$active = ($slug === 'institution') ? 'active' : ''; ?>"><img src="<?=$uri?>/img/common/building.svg" alt="施設一覧" />施設一覧</a></li>
    </ul>
    <ul class="snsList">
        <li>KissPRESSの最新情報は<br />各種SNSでも配信中</li>
        <li><a href=""><img src="<?=$uri?>/img/common/fb.svg" alt="Facebook" />Facebook</a></li>
        <li><a href=""><img src="<?=$uri?>/img/common/tw.svg" alt="Twitter" />Twitter</a></li>
        <li><a href=""><img src="<?=$uri?>/img/common/insta.svg" alt="INSTAGRAM" />INSTAGRAM</a></li>
        <li><a href=""><img src="<?=$uri?>/img/common/line.svg" alt="LINE" />LINE</a></li>
    </ul>
</section>