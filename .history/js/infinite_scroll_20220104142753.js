function init(page_num = 1) {
	let list_count = 1; // 1度に取得する件数
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