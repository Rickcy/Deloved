'use strict'
$(function () {
    $('#ticket-last-post-inpost').val('');
    $('#ticket-last-post-istatus').val('');
    $("#scrollContent").mCustomScrollbar({
        alwaysShowScrollbar: 1,
        advanced:{
            updateOnContentResize: true,
            updateOnImageLoad: true
        },
        callbacks:{
            whileScrolling: function () {

            },
            onInit: function() {
                $('#scrollContent').mCustomScrollbar('scrollTo','bottom');
            },
            onUpdate: function(){
                if (checkBottomEdge() == true) {
                    $('#scrollContent').mCustomScrollbar('scrollTo','bottom');
                }
            }
        }
    });


    $('#ticket-post-form').on('beforeSubmit',function () {
        var post = $('#ticketpost-post').val();
        var postId = $('[name=postId]').last().val();
        $('#ticket-last-post-inpost').val(postId);
        if(!post){
            return false;
        }
        var formData = $(this).serialize();
        $.ajax({
            url:'/admin/ticket/send-message',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#ticketpost-post').val('');
                    $('#postArea').append(data);
                    $('#support > a > span.badge_red').remove();
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });
        return false;
    });


    $('#ticket-status-form').on('beforeSubmit',function () {
        var postId = $('[name=postId]').last().val();
        $('#ticket-last-post-instatus').val(postId);
        var formData = $(this).serialize();
        $.ajax({
            url:'/admin/ticket/change-status',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#status-10').parent().remove();
                    $('#form-ticket-post').show();
                    $('#support > a > span.badge_red').remove();
                    $('#technical_support >a > span.badge_red').remove();
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });

        return false;
    });

    function checkBottomEdge() {
        var scrollbar = $('#mCSB_1_scrollbar_vertical').height();
        var dragger = $('#mCSB_1_dragger_vertical').height();
        var draggerPosition = $('#mCSB_1_dragger_vertical').position().top;
        var pctButton =  (1 - (dragger + draggerPosition)/scrollbar);
        var psA =  49 / $('#postsArea3').height();
        return pctButton < psA;
    }

    setInterval(getUnreadPosts,30000)
});

function getUnreadPosts() {
    var postId = $('[name=postId]').last().val();
    $.ajax({
        type:'post',
        url:'/admin/ticket/get-unread-posts',
        data:{postId:postId},
        success:function (data) {
            if(data['error']){
                showMessage('danger',data['error'])
            }
            else {
                if(data){
                    $('#ticketpost-post').val('');
                    $('#postArea').append(data);

                }
                $('#support > a > span.badge_red').remove();
                $('#technical_support >a > span.badge_red').remove();
            }
        },
        error:function () {
            showMessage('danger','Error connection')
        }
    })
}


function setStatus(status) {
    $('#ticket-status-val').val(status);
    $('#ticket-status-form').submit();
    if(status === '20'){
        $('#form-ticket-post').hide();
    }
}