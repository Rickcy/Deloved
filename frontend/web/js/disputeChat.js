'use strict';
var isHide = false;
$(function () {

    $('.noFile').click(function () {
        $('#file').click();
    });

    $('#file').change(function () {
        var input =$("#file");
        var files = input[0].files;
        var dispute_id = $(this).attr('dispute-id');
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('File', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/dispute/upload-file?id='+dispute_id,
            data:data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function (data) {
                getUnreadPosts();
            },
            error:function () {
                console.log('Error')
            }
        })
    });



    $('#dispute-last-post-inpost').val('');
    $('#dispute-last-post-istatus').val('');





    $('#disputepost-post').keypress(function (event) {
        if ( event.which == 13 ) {
            $('#send-message').click();
        }
    })

    $('#dispute-post-form').on('beforeSubmit',function () {
        var post = $('#disputepost-post').val();
        var postId = $('[name=postId]').last().val();
        $('#dispute-last-post-inpost').val(postId);
        if(!post){
            return false;
        }
        var formData = $(this).serialize();
        $('#disputepost-post').val('');
        $.ajax({
            url:'/admin/dispute/send-message',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#disputes > a > span.badge_red').remove();
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });
        return false;
    });


    $('#dispute-status-form').on('beforeSubmit',function () {
        var postId = $('[name=postId]').last().val();
        $('#dispute-last-post-instatus').val(postId);
        var formData = $(this).serialize();
        $.ajax({
            url:'/admin/dispute/change-status',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#status-10').parent().remove();
                    if(isHide === false){
                        $('#form-dispute-post').show();
                    }

                    $('#disputes > a > span.badge_red').remove();
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });

        return false;
    });



    setInterval(getUnreadPosts,30000)
});

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

function getUnreadPosts() {
    var postId = $('[name=postId]').last().val();
    $.ajax({
        type:'post',
        url:'/admin/dispute/get-unread-posts',
        data:{postId:postId},
        success:function (data) {
            if(data['error']){
                showMessage('danger',data['error'])
            }
            else {
                if(data){
                    $('#postArea').append(data);
                    if(isHide === false){
                        $('#form-dispute-post').show();
                    }


                }
                $('#disputes > a > span.badge_red').remove();
            }
        },
        error:function () {
            showMessage('danger','Error connection')
        }
    })
}


function setStatus(status) {
    $('#dispute-status-val').val(status);
    $('#dispute-status-form').submit();
    if(status === '20' || status === '30'){
        isHide = true;
        $('#form-dispute-post').hide();
    }
}