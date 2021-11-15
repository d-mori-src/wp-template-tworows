<?php
    $uri = get_theme_file_uri(); 
    $site_url = site_url();
?>

<?php get_header(); ?>

<main class="mail_magazine">
    <?php include('inc/left_sidebar.php'); ?>
    <article>
        <section class="intro">
            <img src="<?=$uri?>/img/mail_magazine/merumaga.jpg" class="titleImage" alt="兵庫五国のおでかけ情報をメールでお届け">
            <p>
                Kiss PRESSメールマガジンは、毎週水曜日 (※1) に会員の皆さまに兵庫五国 (※2) の旬のおでかけ・イベント情報やプレゼントキャンペーン、その他お得な情報などをお届けするメールマガジンです。<br />
                <strong>登録解除も簡単</strong>にできますので、ぜひお気軽にご登録下さい。
            </p>
        </section>

        <section class="contents">
            <div class="register">
                <h3>メールマガジン会員登録</h3>
                <p>
                    Kiss PRESSメールマガジンはメールアドレスだけで登録が可能。登録解除もメールアドレスを入力するだけ。お気軽にご登録ください。<br />
                    <br />
                    ご登録いただく場合は以下の内容をご確認の上、同意いただける方はメールアドレス記入欄にご入力いただき「登録」をご選択ください。<br />
                    <br />
                    「Kiss PRESSメールマガジンのご登録について」をご理解の上、お申し込みください。注意事項の確認は こちら
                </p>
                <ul>
                    <li><span>・</span>「Kiss PRESSメールマガジン 個人情報保護方針」をご理解の上、お申し込みください。</li>
                    <li><span>・</span>個人情報保護方針の確認は こちら</li>
                </ul>
                <form action="">
                    <div class="formSet">
                        <div class="formTitle">メールアドレス</div>
                        <div class="formItem">
                            <input type="email" name="email" class="input" placeholder="入力してください"><input type="submit" class="mailbtn" value="登録" />
                        </div>
                    </div>
                </form>
                <h4>下記からのメールを受信できるよう設定してください。</h4>
                <ul class="frame">
                    <li><span>・</span>ドメイン指定をされている場合：「@kisspress.jp」</li>
                    <li><span>・</span>メールアドレス指定をされている場合：「magazine@kisspress.jp」</li>
                </ul>
            </div>

            <p>
                ※1諸般の事情により配信されない週もございます。ご了承ください。<br />
                <br />
                ※2兵庫五国とは兵庫県を構成する摂津・播磨・但馬・丹波・淡路の5つのエリア
            </p>
            <ul class="bigTitle">
                <li><span>摂津：</span><span class="address">神戸市・尼崎市・西宮市・芦屋市・伊丹市・宝塚市・川西市・三田市・猪名川町</span></li>
                <li><span>播磨：</span><span class="address">明石市・加古川市・西脇市・三木市・高砂市・小野市・加西市・加東市・多可町・稲美町・播磨町・姫路市・相生市・たつの市・赤穂市・宍粟市・福崎町・神河町・市川町・太子町・上郡町・佐用町</span></li>
                <li><span>但馬：</span><span class="address">豊岡市・香美町・新温泉町・養父市・朝来市</span></li>
                <li><span>丹波：</span><span class="address">丹波市・丹波篠山市</span></li>
                <li><span>淡路：</span><span class="address">淡路市・洲本市・南あわじ市</span></li>
            </ul>

            <div class="register">
                <h3>メールマガジン登録解除</h3>
                <p>
                    メールマガジン登録解除は簡単。下記入力欄にメールアドレスをご入力頂き「登録解除」ボタンを押すだけです。<br />
                    <br />
                    まずはお気軽にKiss PRESSのメールマガジンをお楽しみ下さい。
                </p>
                <form action="" class="nomargin">
                    <div class="formSet">
                        <div class="formTitle">メールアドレス</div>
                        <div class="formItem">
                            <input type="email" name="email" class="input" placeholder="入力してください"><input type="submit" class="mailbtn" value="解除" />
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </article>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>