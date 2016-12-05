<?php
?>
<div id="flash-message" class="flash-alert alert alert-info" hidden></div>

<script>

    var ib = $('#flash-message');

    <g:if test="${flash.message}">
        showMessage('${flash.status}', '${flash.message}')
        </g:if>

    function showMessage(status, message){

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

</script>
