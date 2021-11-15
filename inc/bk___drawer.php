<?php 
  $uri = get_theme_file_uri(); // ルートpath
  global $post;
  $slug = $post->post_name;
  $site_url = site_url(); // サイトURL
  $server_uri = $_SERVER['REQUEST_URI'];
  $server_uri_trimed = substr($server_uri, 0, strcspn($server_uri,'?'));
?>

<input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
<label for="openSidebarMenu" class="sidebarIconToggle">
<div class="spinner diagonal part-1"></div>
<div class="spinner horizontal"></div>
<div class="spinner diagonal part-2"></div>
</label>
<div id="sidebarMenu">
    <ul>
        <li>
            <a href="<?=$site_url;?>">トップページ</a>
        </li>
    </ul>
</div>
