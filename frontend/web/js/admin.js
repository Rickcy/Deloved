


function showMessage(status, message){
        console.log(status, message);
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