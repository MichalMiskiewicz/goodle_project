window.onload = function() {
    $('.username>p').click(function() {
        $(location).attr('href', 'login.html')
    });
};

function showhideNav(){
    if ($('#navigation').css('left') == '0px') {
        $('nav').css('left', '-100vw');
        var newWidth = $('#navigation').width() * (100 / document.documentElement.clientWidth);
        setTimeout(() => {  $('header>img').css('opacity', '1');}, 500);
        setTimeout(() => {  $('main').css('transition-property', 'none'); }, 1000);
        $('#bt_nav').text('>');

    }else{
        $('header>img').css('opacity', '0');
        $('#navigation').css('width', '15vw');
        $('#navigation').css('left', '0');
        $('#bt_nav').text('X');
        var newWidth = $('#navigation').width() * (100 / document.documentElement.clientWidth);
        setTimeout(() => {  $('main').css('transition-property', 'none'); }, 500);
    }
}
