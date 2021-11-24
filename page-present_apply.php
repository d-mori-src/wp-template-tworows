<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();

    // プレゼントID取得
    $id = $_GET['id'];
    $shop_name = $_GET['shop_name'];
?>

<?php get_header(); ?>

<main class="contact">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <h3 class="headTitle"><img src="<?=$uri?>/img/contact/contact.svg" class="contactIcon" alt="">プレゼント応募フォーム</h3>
            <p>
                <?=$shop_name ?>
                <span>Kiss PRESSをよりよいサービスにする為、アンケートにお答えください。ご入力頂いた個人情報はプレゼント発送の目的に限り使用します。</span>
            </p>
        </section>

        <section class="contents">
            <form action="" method="POST">
                <input type="hidden" class="input" name="id" value="<?=$id;?>" />

                <div class="requiredForm">
                    <dl>
                        <dt>アンケート<span>必須</span></dt>
                        <dd>
                            <p>Kiss PRESSサイトの気に入っている点、不満点などがあれば教えてください。</p>
                            <textarea class="input inputs good" name="introduction" placeholder="GOOD 気に入っている点"></textarea>
                            <textarea class="input bad" name="introduction" placeholder="BAD 不満点・改善点の要望"></textarea>
                        </dd>
                    </dl>
                    <dl class="lastForm">
                        <dt>性別<span>必須</span></dt>
                        <dd>
                            <div class="radio">
                                <input type="radio" id="man" class="" name="gender" value="man" />
                                <label for="man">男性</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="woman" class="" name="gender" value="woman" />
                                <label for="woman" class="nextLabel">女性</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="another" class="" name="gender" value="another" />
                                <label for="another" class="nextLabel">その他</label>
                            </div>
                        </dd>
                    </dl>
                </div>
                
                <div class="anyForm">
                    <dl class="first">
                        <dt>プレゼントお届け先<span class="require">必須</span></dt>
                    </dl>
                    <dl>
                        <dt>お名前</dt>
                        <dd><input type="text" class="input" name="fullname" placeholder="例　神戸太郎" /></dd>
                    </dl>
                    <dl>
                        <dt>お電話番号</dt>
                        <dd><input type="tel" class="input" name="phone" placeholder="例　078123456 ※ハイフン不要" /></dd>
                    </dl>
                    <dl>
                        <dt>郵便番号<span>※住所自動入力</span></dt>
                        <dd>
                            <input type="text" class="input inputs" name="zip01" onKeyUp="AjaxZip3.zip2addr(this,'','pref01','addr01');" placeholder="例）6508589 ※半角で入力して下さい。 ※ハイフン不要" />
                            <a href="https://www.post.japanpost.jp/zipcode/" target="_blank" rel="noopener noreferrer">郵便番号を調べる</a>
                        </dd>
                    </dl>
                    <dl>
                        <dt>住所</dt>
                        <dd>
                            <input type="text" class="input inputs" name="pref01" />
                            <input type="text" class="input" name="addr01" />
                        </dd>
                    </dl>
                    <dl class="lastForm">
                        <dt>番地以下</dt>
                        <dd>
                            <input type="text" class="input" name="" />
                        </dd>
                    </dl>
                </div>

                <div class="privacyCheck">
                    <input type="checkbox" id="agreebtn" class="visuallyHidden" name="agree" value="agree" />
                    <label for="agreebtn"><a href="">プライバシーポリシー</a>に同意する</label>
                </div>
                <input type="submit" class="submit" value="確認" />
            </form>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>