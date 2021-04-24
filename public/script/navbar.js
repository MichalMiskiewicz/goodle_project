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
        //$('main').css('transition-property', 'width, left, right');
       // $('main').css('transition-duration', '.2s');
        //$('main').css('transition-timing-function', 'ease-in-out');
        //$('main').css('width', '100vw');
        setTimeout(() => {  $('main').css('transition-property', 'none'); }, 1000);
        $('#bt_nav').text('>');

    }else{ 
        //$('main').css('transition-property', 'width, left, right');
        //$('main').css('transition-duration', '.2s');
        //$('main').css('transition-timing-function', 'ease-in-out');
        $('header>img').css('opacity', '0');
        $('#navigation').css('width', '15vw');
        //$('main').css('width', '85vw');
        //$('main').css('right', '0');
        $('#navigation').css('left', '0');
        $('#bt_nav').text('X');
        var newWidth = $('#navigation').width() * (100 / document.documentElement.clientWidth);
        setTimeout(() => {  $('main').css('transition-property', 'none'); }, 500);
    }
}
