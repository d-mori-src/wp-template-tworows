// infinite_scroll.js favorite.js 共通の実行ファイル

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
		scroll_data(objData, list_count);
		toglleItem();
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