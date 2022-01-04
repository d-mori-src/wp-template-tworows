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