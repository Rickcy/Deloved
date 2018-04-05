'use strict';
var isHide = false;
var count = 0;
$(function () {
    $('.noFile').click(function () {
        $('#file').click();
    });

    $('#file').change(function () {
        var input =$("#file");
        var files = input[0].files;
        var deal_id = $(this).attr('deal-id');
        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('File', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/deal/upload-file?id='+deal_id,
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

    $('#dealpost-post').keypress(function (event) {
        if ( event.which == 13 ) {
            $('#send-message').click();
        }
    });

    $('#deal-last-post-inpost').val('');
    $('#deal-last-post-istatus').val('');





    $('#send-message').click(function () {
        count++;
        if(count === 6){
            $('.change-statuses').next().show();
            count = 0;
        }
    });

    $('#deal-post-form').on('beforeSubmit',function () {
        var post = $('#dealpost-post').val();
        var postId = $('[name=postId]').last().val();
        $('#deal-last-post-inpost').val(postId);
        if(!post){
            return false;
        }
        var formData = $(this).serialize();
        $('#dealpost-post').val('');
        $.ajax({
            url:'/admin/deal/send-message',
            method: $(this).attr('method'),
            data: formData,
            success:function (data) {
                if(data['error']){
                    showMessage('danger',data['error'])
                }
                else {
                    $('#postArea').append(data);
                    $('#deals > a > span.badge_red').remove();
                    getStatuses(postId);
                    getProgress(postId);
                }
            },
            error:function () {
                showMessage('danger','Error connection')
            }
        });
        return false;
    });


    $('#deal-status-form').on('beforeSubmit',function () {
        var postId = $('[name=postId]').last().val();
        $('#deal-last-post-instatus').val(postId);
        var formData = $(this).serialize();
        $.ajax({
            url:'/admin/deal/change-status',
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
                        $('#form-deal-post').show();
                    }
                    getStatuses(postId);
                    getProgress(postId);
                    $('#deals > a > span.badge_red').remove();
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
        url:'/admin/deal/get-unread-posts',
        data:{postId:postId},
        success:function (data) {
            if(data['error']){
                showMessage('danger',data['error'])
            }
            else {
                if(data){
                    $('#postArea').append(data);
                    getStatuses(postId);
                    getProgress(postId);
                    if(isHide === false){
                        $('#form-deal-post').show();
                    }
                }
                $('#deals > a > span.badge_red').remove();
            }
        },
        error:function () {
            showMessage('danger','Error connection')
        }
    })
}


function setStatus(status) {
    if (status == '102' || status == '103' || status == '104' ){
        $('#Status').modal('show');
        $('#change-status-success').click(function () {
            $('#deal-status-val').val(status);
            $('#deal-status-form').submit()
            $('#Status').modal('hide');
        })
    }
    else{
        $('#deal-status-val').val(status);
        $('#deal-status-form').submit();
        if(status == '500' || status == '501' || status == '502' || status == '503' || status == '504'){
            isHide = true;
            $('#form-deal-post').hide();
            $('#deal-statuses-row').hide();
        }
    }



}
function getStatuses(postId) {
    $.ajax({
        type:'POST',
        url:'/admin/deal/get-statuses',
        data:{postId:postId},
        success:function (data) {
            console.log(data);
            $('#deal-statuses > li').remove();
            $('#deal-statuses').append(data);
        },
        error:function () {
            console.log('Error statuses')
        }
    })
}

function getProgress(postId) {
    $.ajax({
        type:'POST',
        url:'/admin/deal/get-progress',
        data:{postId:postId},
        success:function (data) {
            console.log(data);
            $('#dealProgress > div').remove();
            $('#dealProgress').append(data);
        },
        error:function () {
            console.log('Error statuses')
        }
    })
}