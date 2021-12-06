// ふわっと出るエフェクト
// エフェクトかけたいDOMのclassにbottomSlideinをつける
const showElementAnimation = () => {
    const element = document.getElementsByClassName('bottomSlidein');
    if (!element) return;

    const showTiming = window.innerHeight > 768 ? 200 : 40;
    const scrollY = window.pageYOffset;
    const windowH = window.innerHeight;

    for (let i=0; i<element.length; i++) { 
        const elemClientRect = element[i].getBoundingClientRect(); 
        const elemY = scrollY + elemClientRect.top; 
        
        if(scrollY + windowH - showTiming > elemY) {
            element[i].classList.add('is-show');
        } else if (scrollY + windowH < elemY) {
            element[i].classList.remove('is-show');
        }
    }
}
showElementAnimation();
window.addEventListener('scroll', showElementAnimation);

// ハンバーガーメニュー
function hamburger() {
    document.getElementById('line1').classList.toggle('line_1');
    document.getElementById('line2').classList.toggle('line_2');
    document.getElementById('line3').classList.toggle('line_3');
    document.getElementById('nav').classList.toggle('in');
}
document.getElementById('hamburger').addEventListener('click' , function () {
    hamburger();
});


// 検証用
// リファラーURL取得
const refUrl = document.referrer;

// セッションストレージ保存
const data = refUrl;
const dataStr = JSON.stringify(data);
sessionStorage.setItem('ref', dataStr);
const refItem = sessionStorage.getItem('ref');
const refObj = JSON.parse(refItem);
console.log(refObj);

$(function(){
    // Kiss PRESS広告プラン モーダルウィンドウ
    $('.js-modal-open').each(function(){
        $(this).on('click',function(){
            const target = $(this).data('target');
            const modal = document.getElementById(target);
            $(modal).fadeIn();
            return false;
        });
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });

    // header 検索アコーディオンメニュー
    $('#acMenu .searchBtn a').on('click', function() {
        $(this).next().slideToggle();
    });

    // 履歴
    // window.onpopstate = function(event) {
    //     console.log('location: ' + document.location + ', state: ' + JSON.stringify(event.state));
    // };
    // history.pushState(null, null, '?p=1');
    // history.pushState(null, null, '?p=2');
    // history.back();
    // history.back();

    // 無限スクロール(SEO対策なしの実装)
    // let documentHeight = $(document).height();
	// let windowsHeight = $(window).height();
	// let url = 'http://kisspresslocal.local/wp-content/themes/kisspress_tworows/ajax-item.php';
	// let postNumNow = 5;
	// let postNumAdd = 5;
	// let flag = false;
	// $(window).on('scroll', function() {
	// 	let scrollPosition = windowsHeight + $(window).scrollTop();
	// 	if (scrollPosition >= documentHeight) {
	// 		if (!flag) {
	// 			flag = true;
	// 			$.ajax({
	// 				type: 'POST',
	// 				url: url,
	// 				data: {
	// 					post_num_now: postNumNow,
	// 					post_num_add: postNumAdd
	// 				},
	// 				success: function(response) {
	// 					$('.topNewsItems').append(response);
	// 					documentHeight = $(document).height();
	// 					postNumNow += postNumAdd;
	// 					flag = false;
	// 				}
	// 			});
	// 		}
	// 	}
	// });
});