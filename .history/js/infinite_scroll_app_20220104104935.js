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