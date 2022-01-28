// infinite_scroll.jsとfavorite.jsの共通ファイル

$(function () {
	// ブラウザバックのイベント
	history.replaceState(null, null, null);
	// このページから離れる時のイベント
	$(window).on('beforeunload', function (e) {
		history.pushState(null, null, "/");
	});
	// 「戻る」ボタンを押した時のイベント
	$(window).on("popstate", function (e) {
		// 遷移した回数分+1 戻す
		let backCount = $("#history_count").val();
		backCount = parseInt(backCount, 10) + 1;

		let userAgent = window.navigator.userAgent;
		if (userAgent.indexOf('Firefox') != -1) {
			backCount = parseInt(backCount, 10) + 1;
		}
		backCount = backCount * -1;

		history.go(backCount);
	});

	// ウィンドゥの高さを出してスクロール部分に適用
	let windowHeight = $(window).height();
	$(".wrap").height(windowHeight);
	$(".detail_card").height(windowHeight);
	// スクロールを合わせた初期表示の高さを取得する
	let scrollHeight = $(".wrap").get(0).scrollHeight;
	let page_num = 1;
	init(page_num);
	// スクロール部分の動作
	$(".wrap").on("scroll", function () {
		// スクロールした量（取得する）
		let scroll_mv = $(this).scrollTop();
		// ウィンドゥの高さ + スクロールした量を出す
		let scroll = windowHeight + scroll_mv;
		// 動いた量が初期表示のスクロールを含めた高さを上回ったら要素を追加する
		if (scroll > scrollHeight) {
			page_num = page_num + 1;
			history.pushState(null, null, "/articles/?p=" + page_num);
			init(page_num);
			// 要素を追加したらその分のスクロールを初期化し直す
			scrollHeight = $(".wrap").get(0).scrollHeight;
			// 履歴を変更した回数を加算
			incrementHistory();
		}
	});
	// 続きを見るクリック
	// $('.wrap').on('click', '.article_box span.tobecontinue', function () {
	//	$('.article_box').on('click', 'span.tobecontinue', function () {
	$(document).on('click', 'a.tobecontinue', function () {
		let id = $(this).data("id");
		// 履歴を変更
		history.pushState(null, null, "/articles/" + id);

		// 履歴を変更した回数を加算
		// incrementHistory();

		// 変更 履歴のカウントを0に 
		$("#history_count").val(0);

		// 詳細を取得して展開
		getDetail(id);

		// PV カウント
		// pageview(send_title, sendURL);
	});

	// お気に入り記事ID追加
	$(document).on("click", ".add", function () {
		const dataId = $(this).attr('data-id');
		const key = 'favorite_article';
		const getjson = localStorage.getItem(key);
		const idlist = JSON.parse(getjson);

		if(idlist == null){
			// 初めて「favorite_article」というキーがローカルストレージに登録される時の処理
			idary = new Array(dataId);
			const setjson = JSON.stringify(idary);
			localStorage.setItem(key, setjson);

			favBtn(dataId,'add');
		} else {
			// 既に「favorite_article」というキーが存在する時
			if(idlist.indexOf(dataId) == -1){
				// 且つ、まだfavorite_articleに登録されていない時
				idlist.push(dataId);
				const setjson = JSON.stringify(idlist);
				localStorage.setItem(key, setjson);

				favBtn(dataId,'add');
			}
		}
	});
	// お気に入り記事ID削除
	$(document).on("click", ".remove", function () {
		const dataId = $(this).attr('data-id');
		const key = 'favorite_article';

		// ローカルストレージから値を取得
		const getjson = localStorage.getItem(key);
		const idlist = JSON.parse(getjson);
	
		if(idlist != null){
			// 「favorite_article」というキーが存在した時
			const checkitem = idlist.indexOf(dataId); // 配列の何番目に該当のIDがあるかを見る
			if(checkitem != -1){
				// 「favorite_article」の中に該当のIDが見つかった時
				idlist.splice( checkitem, 1 );
				const setjson = JSON.stringify(idlist);
				localStorage.setItem(key, setjson);

				favBtn(dataId,'remove');
			}
		}
	});
});

/**
 * お気に入り 表示ソースの切り替え
 *
 */
 function favBtn(dataId,event){
    if(event == 'add'){
        // 未チェック(class="add")を非表示にして、チェック済(class="remove")を表示する
        $('li.add[data-id=' + dataId + ']').hide();
        $('li.remove[data-id=' + dataId + ']').show();
    } else if(event == 'remove'){
        // チェック済(class="remove")を非表示にして、未チェック(class="add")を表示する
        $('li.add[data-id=' + dataId + ']').show();
        $('li.remove[data-id=' + dataId + ']').hide();
    }
}
/**
 * お気に入りボタンオンオフ
 */
function toglleItem() {
	$(".remove").each(function() {
		// 初めは消す
		$(".remove").hide();
		// お気に入りリストに存在するか確認
		const key = 'favorite_article';
		const getjson = localStorage.getItem(key);
		const oidlist = JSON.parse(getjson);
		if(oidlist != null){
			oidlist.forEach( function( dataId ) {
				favBtn(dataId,'add');
			});
		}
	});
}

/* 概要 --------------------------------------------------------------------
 * 「JSON文字列」 は JSON.parse 関数でオブジェクト(objData)に変換する
 * for (let i in objData) {} で回して取り出すことができる(iは1から始まる ※データによって異なるかも知れないので確認してから使う)
 * 例) objData[i].title
 * i は回さなくても、数値で指定して取り出すことができる
 * パーズした後、オブジェクトの要素の数は Object.keys(objData).length で取得することができる
 */

function scroll_data(objData, list_count) {
	// 初期化 -----------------------------------------------------------------
	let count = 1; // ページ数
	let pagePer = 20; // 1ページあたりのデータ数
	let boxHeight = $(".wrap").height(); // ページングする要素の高さ
	let heightPer = 0; // スクロールした割合
	//let boxHeight = 200;                  // データを表示すエリアの高さ (指定する場合)
	let evHeight = 160; // データを表示するエリアのイベントが発生する高さ

	// 検証コード ---------------------------------------------------------------
	//console.log(Object.keys(objData).length); // オブジェクトの要素の数
	//console.log(objData[27].title_s);           // オブジェクトの値を、要素番号を指定して取得

	// データを5件取得する ------------------------------------------------------
	// データを展開する ----------------------------------------------------------
	let DataArr = pagingData(count, pagePer, objData);
	// console.log(DataArr);
	writeData(DataArr);

	// スクロールの量によって、ページングを実行する
	$(".wrap").scroll(function () {

		// 取得した記事数を超過したらデータを読み直す
		let article_sum = $(".article_box").length; // 出力した記事件数
		let article_page = $('.article_page').val(); // 現在のページ数
		let article_output_sum = list_count * article_page; // 該当ページ数の上限記事数
		if (article_sum == article_output_sum) {
			let article_page = $('.article_page').val();
			article_page = article_page + 1;
			init(article_page);
		}

		let scrollTop = $(this).scrollTop(); // スクロールした位置
		let eventPosition = (count - 1) * boxHeight + evHeight; // イベントが発生する位置
		// スクロールした位置がイベントが発生する位置を超えたら、次の件数を要素の中に追加する
		if (scrollTop > eventPosition) {
			// ページ数を+1する
			count = count + 1;
			DataArr = pagingData(count, pagePer, objData);
			writeData(DataArr);
		}

	});
}

/**
 * JSON からデータを出力する
 *
 */

function writeData(DataArr) {
	let area_name = "";
	let new_icon = "";

	for (let i in DataArr) {
		// エリア名の抽出
		if (typeof DataArr[i].district !== 'undefined') {
			if (typeof DataArr[i].district[0] !== 'undefined') {
				if (typeof DataArr[i].district[0].name_jp !== 'undefined') {
					area_name = DataArr[i].district[0].name_jp;
				}
			}
		}

		// Newアイコン
		if (get_before() < DataArr[i].release_datetime) {
			// ローカル
			new_icon = "<img src='http://kisspresslocal.local/wp-content/themes/kisspress_tworows/img/common/new.svg' class='newIcon' loading='lazy' />";
			// サーバー
			// new_icon = "<img src='http://dev2.kisspress.jp/assets/img/new.svg' class='newIcon' loading='lazy' />";
		}

		$('.wrap').append(
			"<div class='article_box' data-id='" + DataArr[i].id + "'>" +
				"<div class='inner_article_box'>" +
					// PC時の画像
					"<div class='pc_thumbnail'>" +
						new_icon +
						"<img src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + DataArr[i].image.file_path.xl + "' loading='lazy'>" +
					"</div>" +

					"<div class='textWrapper'>" +
						// スマホ時の画像
						"<div class='sp_thumbnail'>" +
							new_icon +
							"<img src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + DataArr[i].image.file_path.xl + "' loading='lazy'>" +
						"</div>" +
						"<h2>" + DataArr[i].title_copy + "</h2>" +
						"<h1>" + DataArr[i].title_s + "</h1>" +
						"<p class='sp_term'>" + DataArr[i].event_term + "</p>" +
						"<div class='article_sentence'>" +
							modifyNameString(DataArr[i].sentence1, 80, DataArr[i].id) +
						"</div>" +
						"<a href='javascript:void(0)' class='tobecontinue sp_tobecontinue' data-id='" + DataArr[i].id + "'>続きを読む<i class='fas fa-chevron-down'></i></a>" +
						"<div class='article_middle'>" +
							"<div class='sns'>" +
								"<a href='http://www.facebook.com/share.php?u=https://kisspress.jp/articles/" + DataArr[i].id + "/&t=" + DataArr[i].title_s + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-facebook'></i></a>" +
								"<a href='https://twitter.com/share?url=https://kisspress.jp/articles/" + DataArr[i].id + "&text=" + DataArr[i].title_s + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-twitter'></i></a>" +
								"<a href='http://line.me/R/msg/text/?https://kisspress.jp/articles/" + DataArr[i].id + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-line'></i></a>" +
							"</div>" +
							"<ul>" +
								"<li data-id='" + DataArr[i].id + "' class='add'>" +
									"<i class='far fa-heart'></i>" + "<span>お気に入り</span>" +
								"</li>" +
								"<li data-id='" + DataArr[i].id + "' class='remove'>" +
									"<i class='fas fa-heart'></i>" + "<span>お気に入り</span>" +
								"</li>" +
							"</ul>" +
						"</div>" +
						"<div class='article_bottom'>" +
							"<ul>" +
								"<div class='left'>" +
									"<li class='article_tag_name" + " " + DataArr[i].tag_type + "'>" +
										DataArr[i].tag_type_name +
									"</li>" +
									"<li class='article_area_name'>" +
										"<i class='fas fa-map-marker-alt'></i>" +
										area_name +
									"</li>" +
								"</div>" +

								"<div class='right'>" +
									"<li class='article_time'>" + datetostr(DataArr[i].release_datetime) +
									"</li>" +
								"</div>" +
 							"</ul>" +
						"</div>" +
						"<a href='javascript:void(0)' class='tobecontinue pc_tobecontinue' data-id='" + DataArr[i].id + "'>続きを読む<i class='fas fa-chevron-down'></i></a>" +
					"</div>" +
				"</div>" +
			"</div>"
		);
	}
}

/** ページングのデータを取得する
 * @param count int ページ数
 * @param per int 1ページあたりのデータ量
 */
 function pagingData(page, per, objData) {
	let start = 0;
	let end = 0;
	let DataArr = []; // 描画用の配列

	// 2ページ以降の開始位置を取得する
	if (page !== 1) {
		start = (page - 1) * per + 1;
	}
	// ページの最終数を取得
	end = page * per;

	for (let i in objData) {
		// 指定範囲内であればデータを取得する
		if (i >= start) {
			DataArr.push(objData[i]);
		}
		if (i >= end) {
			break;
		}
	}
	return DataArr;
}

/**
 * 本日の日付を出す
 */
function getDateStr(separate = "-") {
	// Date オブジェクト作成
	let dateObject = new Date();
	let year = dateObject.getFullYear();
	let month = dateObject.getMonth() + 1;
	let week = dateObject.getDay();
	let day = dateObject.getDate();
	let hour = dateObject.getHours();
	let minute = dateObject.getMinutes();
	// セパレートと合わせて出力
	let todayStr = year + separate.toString() + month + separate.toString() + day;
	return todayStr;
}

/*
 * 文字数制限
 * @param {type} name 文字列
 * @param {type} num 制限したい文字数（超えると...が付き、省略される）「
 * @returns {modifyNameString.name|String}
 */
function modifyNameString(str, num) {
	let String = str;
	if (String.length >= num) {
		String = String.substr(0, num) + "<span>...</span>";
	}
	return String;
}


/**
 * アナリティクス(PVカウント)を手動で行う
 *
 * @param {*} title タイトル
 * @param {*} page ページ
 */
function pageview(title, page) {
	ga('set', 'title', title);
	ga('set', 'page', page);
	ga('send', 'pageview');
}

/**
 * 記事詳細を取得
 * WPテーマ レイアウト上階層が変わったため「> .textWrapper」追加
 */
// 改良点
// 一覧表示のカードはそのままイキ（続きを読むボタンは隠し、スマホのみ一覧本文隠す）
// 構成
// 一覧部分（共通 シェアや日時まで含む）
// スマホ → 本文テキスト・閉じるボタン　PC → 閉じるボタン・本文テキスト

// メリット
// ①始めに書いた詳細で再構築すると比べコード量が圧倒的に減りメンテナンス性向上
// ②お気に入り機能を一覧のもので兼ねられるので、詳細ページのお気に入り機能のバグは考えなくて良くなった
// デメリット
// 一覧ページ部分は共通なのでスマホレイアウトのSNSシェアや日時部分の順番は変更できない

function getDetail(id) {
	// let host_name  = location.href;
	// リクエストするベース URL
	let baseURL = "https://api.kisspress.jp/beta/articles/";
	// リクエストパラメータ
	let url = baseURL + id + "/";
	// データを取得して処理を開始する
	
	$.ajax({
		type: 'POST',
		url: url,
		cache: false,
		dataType: 'json',
		timeout: 3000,
	}).done(function (data, textStatus, jqXHR) {
		// 一覧表示削除部分
		if ($(window).width() <= 767) {
			$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_sentence").hide();
		}
		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .tobecontinue").hide();

		let objData = data['basic'];
		let sentence1_view = objData["sentence1_view"];

		$(".article_box[data-id=" + id + "]").append(
			"<div class='inner_article_box'>" +
				"<div class='textWrapper'>" +
					"<p class='sentenceView sp_sentenceView'>" + sentence1_view + "</p>" +
				"</div>"+
			"</div>" +
			"<div class='closeBtnWrap'>" +
				"<div class='closeBtnLeft'></div>" +
				"<a href='/' class='closeBtn'>記事を閉じる<i class='fas fa-chevron-up'></i></a>" +
			"</div>" +
			"<p class='sentenceView pc_sentenceView'>" + sentence1_view + "</p>"
		);
	}).fail(function (jqXHR, textStatus, errorThrown) {
		return false;
	}).always(function (jqXHR, textStatus) {
		return false;
	});
}

// 一覧を一度、全部隠して、詳細を再構築したパターン
// デメリット
// ①コードが冗長なり過ぎメンテナンス性に欠ける
// ②お気に入りボタンが詳細表示に配置するとバグが起きる（ここを改善しないとそもそもこのコードはNG）
// ③仮に②を改善したとしても上のコードに必要部分だけを付け足せばいいのでどちらにせよこのコードはなし
// メリット
// 詳細で再構築してるので要素の順番を自由に変えられる（DOMが一覧と詳細でがらっと変わるようならこれを採用もあり）

// function getDetail(id) {
// 	// let host_name  = location.href;
// 	// リクエストするベース URL
// 	let baseURL = "https://api.kisspress.jp/beta/articles/";
// 	// リクエストパラメータ
// 	let url = baseURL + id + "/";
// 	// データを取得して処理を開始する

// 	let new_icon = "";
	
// 	$.ajax({
// 		type: 'POST',
// 		url: url,
// 		cache: false,
// 		dataType: 'json',
// 		timeout: 3000,
// 	}).done(function (data, textStatus, jqXHR) {
// 		// 一覧表示削除
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .pc_thumbnail").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > h1").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > h2").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_sentence").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .tobecontinue").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_middle").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_bottom").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .sp_thumbnail").hide();
// 		$(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .sp_term").hide();

// 		let objData = data['basic'];
// 		let h1 = objData["title_s"];
// 		let h2 = objData["title_copy"];
// 		let event_term = objData["event_term"];
// 		let sentence1 = objData["sentence1"];
// 		let sentence1_view = objData["sentence1_view"];
// 		let articleImage = objData["top_image"]["file_path"]["xl"];
// 		let articleArea = objData["district"][0]["name_jp"];
// 		let release_datetime = objData["release_datetime"];
// 		// Newアイコン
// 		if (get_before() < release_datetime) {
// 			// ローカル
// 			new_icon = "<img src='http://kisspresslocal.local/wp-content/themes/kisspress_tworows/img/common/new.svg' class='newIcon' loading='lazy' />";
// 			// サーバー
// 			// new_icon = "<img src='http://dev2.kisspress.jp/assets/img/new.svg' class='newIcon' loading='lazy' />";
// 		}
// 		console.log(objData);

// 		$(".article_box[data-id=" + id + "]").append(
// 			"<div class='inner_article_box'>" +
// 				// PC時の画像
// 				"<div class='pc_thumbnail'>" +
// 					new_icon +
// 					"<img src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + articleImage + "' loading='lazy'>" +
// 				"</div>" +
// 				"<div class='textWrapper'>" +
// 					// スマホ時の画像
// 					"<div class='sp_thumbnail'>" +
// 						new_icon +
// 						"<img src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + articleImage + "' loading='lazy'>" +
// 					"</div>" +
// 					"<h2>" + h2 + "</h2>" +
// 					"<h1>" + h1 + "</h1>" +
// 					"<p class='sp_term'>" + event_term + "</p>" +
// 					"<div class='article_sentence'>" +
// 						modifyNameString(sentence1, 60) +
// 					"</div>" +
// 					"<p class='sentenceView sp_sentenceView'>" + sentence1_view + "</p>" +
// 					"<div class='article_middle'>" +
// 						"<div class='sns'>" +
// 							"<a href='http://www.facebook.com/share.php?u=https://kisspress.jp/articles/" + id + "/&t=" + h1 + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-facebook'></i></a>" +
// 							"<a href='https://twitter.com/share?url=https://kisspress.jp/articles/" + id + "&text=" + h1 + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-twitter'></i></a>" +
// 							"<a href='http://line.me/R/msg/text/?https://kisspress.jp/articles/" + id + "' target='_blank' rel='noopener noreferrer'><i class='fab fa-line'></i></a>" +
// 						"</div>" +
// 						"<ul>" + 
// 							"<li data-id='" + id + "' class='add'>" +
// 								"<i class='far fa-heart'></i>" + "<span>お気に入り</span>" +
// 							"</li>" +
// 							"<li data-id='" + id + "' class='remove'>" +
// 								"<i class='fas fa-heart'></i>" + "<span>お気に入り</span>" +
// 							"</li>" +
// 						"</ul>" +
// 					"</div>" +
// 					"<div class='article_bottom'>" +
// 						"<ul>" +
// 							"<div class='left'>" +
// 								// "<li class='article_tag_name" + " " + DataArr[i].tag_type + "'>" +
// 									// DataArr[i].tag_type_name +
// 								"<li class='article_tag_name'>" + // API調整後変更
// 									"カテゴリー" + // API調整後変更
// 								"</li>" +
// 								"<li class='article_area_name'>" +
// 									"<i class='fas fa-map-marker-alt'></i>" +
// 									articleArea +
// 								"</li>" +
// 							"</div>" +

// 							"<div class='right'>" +
// 								"<li class='article_time'>" + datetostr(release_datetime) +
// 								"</li>" +
// 							"</div>" +
// 						"</ul>" +
// 					"</div>" +
// 				"</div>"+
// 			"</div>" +
// 			"<p class='sentenceView pc_sentenceView'>" + sentence1_view + "</p>"
// 		);
// 	}).fail(function (jqXHR, textStatus, errorThrown) {
// 		return false;
// 	}).always(function (jqXHR, textStatus) {
// 		return false;
// 	});
// }

function incrementHistory() {
	let count = $("#history_count").val();
	count++;
	$("#history_count").val(count);
}