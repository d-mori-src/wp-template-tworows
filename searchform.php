<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<div class="pc-searchForm">
    <form action="<?=$site_url?>" method="get">
        <button type="submit"><img src="<?=$uri?>/img/common/search.svg" alt="検索"></button>
        <input type="text" class="searchInput" name="s" placeholder="イベント × キーワード検索"/>
    </form>
</div>                      
