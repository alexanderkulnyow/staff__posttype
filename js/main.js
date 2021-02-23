let intFrameWidth = window.innerWidth;
if (intFrameWidth < 768){
    console.log('true');
    document.getElementById('penis').classList.add('news__block');
} else {
    document.getElementById('penis').classList.remove('news__block');
}
jQuery(document).ready(function ($) {
    $('.staff').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: true
    });
    $('.news__block').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        dots: false,
        arrows: true
    });
});
