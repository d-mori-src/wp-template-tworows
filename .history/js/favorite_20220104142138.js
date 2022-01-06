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

		// ローカルストレージに保存したIDを取得
		const favorites = localStorage.getItem("favorite_article");
		const favObj = JSON.parse(favorites);
		const favObjDataId = favObj.map(value => {
		    return value;
		});

		// 全体のデータからお気に入り記事IDのみ抽出
		const filterKeys = favObjDataId;
		const filterObjData = objData.filter(function(value) {
			return filterKeys.some( x => value["id"] === x );
		});

		scroll_data(filterObjData, list_count);
		toglleItem();
	}).fail(function (jqXHR, textStatus, errorThrown) {

	}).always(function (jqXHR, textStatus) {

	});
}