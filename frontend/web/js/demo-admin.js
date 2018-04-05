function showMessage(status, message){

    var ib = $('#flash-message');
    if ($.inArray(status, ['info', 'danger', 'warning', 'success']) != -1) {
        ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-'+status));
    } else {
        ib.attr('class', ib.attr('class').replace(/\balert-\w+\b/g, 'alert-info'));
    }

    ib.clearQueue();
    ib.stop();
    ib.hide();
    ib.html(message);

    setTimeout(function(){
        ib.fadeIn(450);
        setTimeout(function(){
            ib.fadeOut(4000, function() {
            });
            ib.mouseenter(function() {
                ib.clearQueue();
                ib.stop();
                ib.animate({opacity: 1});
            });
            ib.mouseleave(function() {
                ib.fadeOut(8000, function() {
                });
            });
        }, 4000)

    }, 100)
}

$(window).load(function(){
    $("#scrollContent").mCustomScrollbar({
        alwaysShowScrollbar: 1,
        autoExpandScrollbar:true,
        advanced:{
            updateOnContentResize: true,
            updateOnImageLoad: true
        },
        callbacks:{
            whileScrolling: function () {

            },
            onCreate: function() {
                $('#scrollContent').mCustomScrollbar('scrollTo','bottom');
            },
            onUpdate: function(){
                if (checkBottomEdge() == true) {
                    $('#scrollContent').mCustomScrollbar('scrollTo','bottom');
                }
            }
        }
    });
    function checkBottomEdge() {
        var scrollbar = $('#mCSB_1_scrollbar_vertical').height();
        var dragger = $('#mCSB_1_dragger_vertical').height();
        var draggerPosition = $('#mCSB_1_dragger_vertical').position().top;
        var pctButton =  (1 - (dragger + draggerPosition)/scrollbar);
        var psA =  49 / $('#postsArea3').height();
        return pctButton < psA;
    }
});