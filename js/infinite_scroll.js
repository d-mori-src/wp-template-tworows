function init(page_num = 1) {
	let list_count = 20; // 1度に取得する件数
	let today_str = getDateStr(); // 日付
	// リクエストするベース URL
	let baseURL = "https://api.kisspress.jp/beta/articles/";
	// リクエストパラメータ
	let url = baseURL + "?html=1&opnening_date=" + today_str + "&l=" + list_count + "&p=" + page_num;
	// データを取得して処理を開始する
console.log('---');
	$.ajax({
		type: 'POST',
		url: url,
		cache: false,
		dataType: 'json',
		timeout: 30000,
	}).done(function (data, textStatus, jqXHR) {
//		console.log('aaa');
//		$('.wrap').append('aaa');

//		let objData = data['data'];
//		scroll_data(objData, list_count);
//		toglleItem();
	}).fail(function (jqXHR, textStatus, errorThrown) {
//console.log(jqXHR.responseText);
		$('.wrap').append(jqXHR.responseText);
		toglleItem();

	}).always(function (jqXHR, textStatus) {

	});
}