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

// 記事の日付比較
function datetostr(dt) {
	const datetime = dt;
	const from = new Date(datetime);

	const diff = new Date().getTime() - from.getTime();
	const elapsed = new Date(diff);

	if (elapsed.getUTCFullYear() - 1970) {
		return elapsed.getUTCFullYear() - 1970 + '年前';
	} else if (elapsed.getUTCMonth()) {
		return elapsed.getUTCMonth() + 'ヶ月前';
	} else if (elapsed.getUTCDate() - 1) {
		return elapsed.getUTCDate() - 1 + '日前';
	} else if (elapsed.getUTCHours()) {
		return elapsed.getUTCHours() + '時間前';
	} else if (elapsed.getUTCMinutes()) {
		return elapsed.getUTCMinutes() + '分前'
	} else {
		return elapsed.getUTCSeconds() + 'たった今';
	}
}

function get_before() {
	let now = new Date();
	let year = now.getFullYear();
	let mon  = now.getMonth() + 1;
	let date = now.getDate() - 1;
	let hour = now.getHours();
	let min  = now.getMinutes();
	let sec  = now.getSeconds();
	if (mon < 10) {mon= '0' + mon;}
	if (date < 10){date = '0' + date;}
	if (hour < 10){hour = '0' + hour;}
	if (min < 10) {min = '0' + min;}
	if (sec < 10) {sec = '0' + sec;}
	return year + '-' + mon + '-' + date + ' ' + hour + ':' + min + ':' +sec;
}

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
});