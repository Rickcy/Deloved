'use strict'
$(function () {

    $('.noFile').click(function () {
        $('#file').click();
    });

    $('#file').change(function () {
        var input =$("#file");
        var files = input[0].files;
        var claim_id = $(this).attr('claim-id');
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('File', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/claim/upload-file?id='+claim_id,
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



    $('#claim-last-post-inpost').val('');
    $('#claim-last-post-istatus').val('');




    $('#claimpost-post').keypress(function (event) {
        if ( event.which == 13 ) {
            $('#send-message').click();
        }
    })

    $('#claim-post-form').on('beforeSubmit',function () {
        var post = $('#claimpost-post').val();
        var postId = $('[name=postId]').last().val();
        $('#claim-last-post-inpost').val(postId);
        if(!post){
            return false;
        }
        var formData = $(this).serialize();
        $('#claimpost-post').val('');
        $.ajax({
            url:'/admin/claim/send-message',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#claims > a > span.badge_red').remove();
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });
        return false;
    });


    $('#claim-status-form').on('beforeSubmit',function () {
        var postId = $('[name=postId]').last().val();
        $('#claim-last-post-instatus').val(postId);
        var formData = $(this).serialize();
        $.ajax({
            url:'/admin/claim/change-status',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#status-10').parent().remove();
                    $('#form-claim-post').show();
                    $('#claims > a > span.badge_red').remove();
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
        url:'/admin/claim/get-unread-posts',
        data:{postId:postId},
        success:function (data) {
            if(data['error']){
                showMessage('danger',data['error'])
            }
            else {
                if(data){
                    $('#postArea').append(data);
                    $('#claim').show();
                    if(isHide === false){
                        $('#form-claim-post').show();
                    }
                }
                $('#claims > a > span.badge_red').remove();
            }
        },
        error:function () {
            showMessage('danger','Error connection')
        }
    })
}


function setStatus(status) {
    $('#claim-status-val').val(status);
    $('#claim-status-form').submit();
    if(status === '20' || status === '30'){
        $('#form-claim-post').hide();
    }
}