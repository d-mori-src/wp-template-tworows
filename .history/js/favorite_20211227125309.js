//history.replaceState(null, null, null);
//window.addEventListener('popstate', function (e) {
//console.log('ブラウザバックを検知しました。');
// 	history.pushState(null, null, "/");
// 	let backCount = $("#history_count").val();
// 	this.history.go(backCount);
//});

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
	$(document).on('click', 'span.tobecontinue', function () {
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

			togleitem(dataId,'add');
		} else {
			// 既に「favorite_article」というキーが存在する時
			if(idlist.indexOf(dataId) == -1){
				// 且つ、まだfavorite_articleに登録されていない時
				idlist.push(dataId);
				const setjson = JSON.stringify(idlist);
				localStorage.setItem(key, setjson);

				togleitem(dataId,'add');
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

				togleitem(dataId,'remove');
			}
		}
	});
});

/**
 * お気に入り 表示ソースの切り替え
 *
 */
 function togleitem(dataId,event){
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

/* 概要 --------------------------------------------------------------------
 * 「JSON文字列」 は JSON.parse 関数でオブジェクト(objData)に変換する
 * for (let i in objData) {} で回して取り出すことができる(iは1から始まる ※データによって異なるかも知れないので確認してから使う)
 * 例) objData[i].title
 * i は回さなくても、数値で指定して取り出すことができる
 * パーズした後、オブジェクトの要素の数は Object.keys(objData).length で取得することができる
 */

function init(page_num = 1) {
	let list_count = 20; // 1度に取得する件数
	let today_str = getDateStr(); // 日付
	// リクエストするベース URL
	let baseURL = "https://api.kisspress.jp/beta/articles/";
	// リクエストパラメータ
	let url = baseURL + "?search=1&opnening_date=" + today_str + "&l=" + list_count + "&p=" + page_num;
	// データを取得して処理を開始する
	$.ajax({
		type: 'POST',
		url: url,
		cache: false,
		dataType: 'json',
		timeout: 3000,
	}).done(function (data, textStatus, jqXHR) {
		let objData = data['data'];
		console.log(objData[0]['id']);
		scroll_data(objData, list_count);
		toglleItem(); // 2021年12月27日追加
	}).fail(function (jqXHR, textStatus, errorThrown) {

	}).always(function (jqXHR, textStatus) {

	});
}

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

	for (let i in DataArr) {
		// エリア名の抽出
		if (typeof DataArr[i].district !== 'undefined') {
			if (typeof DataArr[i].district[0] !== 'undefined') {
				if (typeof DataArr[i].district[0].name_jp !== 'undefined') {
					area_name = DataArr[i].district[0].name_jp;
				}
			}
		}

		$('.wrap').append(
            // PC時article_boxでFlexかける
			"<div class='article_box' data-id='" + DataArr[i].id + "'>" +
				"<div class='inner_article_box'>" +
					// PC時の画像
					"<div class='pc_thumbnail'>" +
						"<img src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + DataArr[i].image.file_path.xl + "' loading='lazy'>" +
					"</div>" +
					"<div class='textWrapper'>" +
						// スマホ時の画像
						"<img class='sp_thumbnail' src='https://kisspress.jp/img_thumb/get_image/480/0/?file=" + DataArr[i].image.file_path.xl + "' loading='lazy'>" +
						"<h2>" + DataArr[i].title_copy + "</h2>" +
						"<h1>" + DataArr[i].title_s + "</h1>" +
						"<p class='sp_term'>" + DataArr[i].event_term + "</p>" +
						"<div class='article_sentence'>" +
							modifyNameString(DataArr[i].sentence1, 60, DataArr[i].id) +
						"</div>" +
						"<article></article>" +
						"<div class='article_bottom'>" +
							"<ul>" +
								"<li class='article_tag_name'>" +
									DataArr[i].tag_type_name +
								"</li>" +
								"<li class='article_area_name'>" +
									"<i class='fas fa-map-marker-alt'></i>" +
									area_name +
								"</li>" +

								// お気に入り未アイコン
								"<li data-id='" + DataArr[i].id + "' class='add'>" +
									"<i class='far fa-heart'></i>" +
								"</li>" +
								// お気に入り済アイコン
								"<li data-id='" + DataArr[i].id + "' class='remove'>" +
									"<i class='fas fa-heart'></i>" +
								"</li>" +

								"<li class='article_time'>30分前" +
								"</li>" +
 							"</ul>" +
							"<div class='clear'>" +
						"</div>" +
					"</div>" +
				"</div>" +
			"</div>"
		);
	}
}

/**
 * お気に入りボタンオンオフ
 * 2021年12月27日
 */
function toglleItem() {
	$(function() {
		$(".remove").each(function() {
			// 初めは消す
			$(".remove").hide();
			// お気に入りリストに存在するか確認
			const key = 'favorite_article';
			const getjson = localStorage.getItem(key);
			const oidlist = JSON.parse(getjson);
			if(oidlist != null){
				oidlist.forEach( function( dataId ) {
					togleitem(dataId,'add');
				});
			}
		});
	});
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
function modifyNameString(str, num, id) {
	let String = str;
	if (String.length >= num) {
		String = String.substr(0, num) + "<span class='tobecontinue' data-id='" + id + "'>続きを読む<i class='fas fa-chevron-down'></i></span>";
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
		// 消す際はコメントアウト外す
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .pc_thumbnail").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > h1").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > h2").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_sentence").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .article_bottom").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .sp_thumbnail").remove();
		// $(".article_box[data-id=" + id + "] > .inner_article_box > .textWrapper > .sp_term").remove();		
		let objData = data['basic'];
		let h1 = objData["title_s"];
		let h2 = objData["title_copy"];
		let time = objData["event_term"];
		let articleSentence1 = objData["sentence1"];
		let articleSentence2 = objData["sentence2"];
		$(".article_box[data-id=" + id + "] > .inner_article_box").after(
			"<section id='articleContents' class='articleContents'>" +
				"<h2>" + h2 + "</h2>" +
				"<h1>" + h1 + "</h1>" +
				"<time>" + time + "</time>" +
				"<p id='articleSentence1' class='articleSentence1'>" + articleSentence1 + "</p>" +
				"<p id='articleSentence2' class='articleSentence2'>" + articleSentence2 + "</p>" +
			"</section>"
		);
	}).fail(function (jqXHR, textStatus, errorThrown) {
		return false;
	}).always(function (jqXHR, textStatus) {
		return false;
	});
}

function incrementHistory() {
	let count = $("#history_count").val();
	count++;
	$("#history_count").val(count);
}