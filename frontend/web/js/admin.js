


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

function getLenta() {
    $.ajax({
        type:'POST',
        url:'/admin/default/get-lenta',
        success:function (data) {
            var lenta = data;
            console.log(data);
            if (lenta.length!==null){
                $(".badge_red").remove();
                if(lenta['accounts']){
                    $('#account >a').append('<span class="badge badge_red" >+'+lenta['accounts'].length+'</span>')
                }
                if(lenta['goods']){
                    $('#goods >a').append('<span class="badge badge_red" >+'+lenta['goods'].length+'</span>')
                }
                if(lenta['services']){
                    $('#services >a').append('<span class="badge badge_red" >+'+lenta['services'].length+'</span>')
                }
                if(lenta['suggestions']){
                    $('#suggestions >a').append('<span class="badge badge_red" >+'+lenta['suggestions'].length+'</span>')
                }
                if(lenta['tickets']){
                    $('#support >a').append('<span class="badge badge_red" >+'+lenta['tickets'].length+'</span>')

                }
                if(lenta['tickets_posts']){
                    $('#support >a').append('<span class="badge badge_red" >+'+lenta['tickets_posts'].length+'</span>')
                    $('#technical_support >a').append('<span class="badge badge_red" >+'+lenta['tickets_posts'].length+'</span>')
                }
            }
        },
        error:function () {
            showMessage('danger','Error')
        }
    })
}




$(function () {
    var photoPath = []
    $('#imgGoods').change(function () {
        var input =$("#imgGoods");
        var files = input[0].files;

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('photoGoodsFile', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/goods/upload-photo',
            data:data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function (data) {
                photoPath.push(data);
                $('#image-template').append("<span><img style='max-width: 25%;margin: 10px' src="+data+" /><span style='cursor:pointer;' class='deletePhotoGood' path='"+data+"' >X</span></span>")
                $('#imgGoodsInput').val(photoPath);
            },
            error:function () {
                console.log('Error')
            }
        })
    });

    $('#imgService').change(function () {
        var input =$("#imgService");
        var files = input[0].files;

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('photoServiceFile', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/services/upload-photo',
            data:data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function (data) {
                photoPath.push(data);
                $('#image-template').append("<span><img style='max-width: 25%;margin: 10px' src="+data+" /><span class='deletePhotoService' style='cursor:pointer;' path='"+data+"' >X</span></span>")
                $('#imgServiceInput').val(photoPath);
            },
            error:function () {
                console.log('Error')
            }
        })
    });


    $('#imgLogo').change(function () {
        var input =$("#imgLogo");
        var files = input[0].files;

        var data = new FormData();
        $.each( files, function( key, value ){
            data.append('logoFile', value )
        });
        $.ajax({
            type:'POST',
            url:'/admin/account/upload-logo',
            data:data,
            cache: false,
            dataType: 'json',
            processData: false,
            contentType: false,
            success:function (data) {

                $('#image-template').children().remove();
                $('#image-template').append("<img style='max-width: 25%;margin: 10px' src="+data+" /><span class='deleteLogo' style='cursor:pointer;' path='"+data+"' >X</span>")
            },
            error:function () {
                console.log('Error')
            }
        })
    });

    $(document).on('click','.deleteLogo',function () {
        var path = $(this).prev().attr('src');
        var self = $(this);
        $.ajax({
            type:'POST',
            url:'/admin/account/delete-logo',
            data:{'path':path},
            success:function (data) {
                if(data){
                    $(self).parent().children().remove();
                    $('#image-template').append("<img style='max-width: 25%;margin: 10px' src='/uploads/default/logo_default.png' />")
                }
            },
            error:function () {
                console.log('error')
            }
        })
    });


    $(document).on('click','.deletePhotoGood',function () {
        var path = $(this).attr('path');
        var self = $(this);
        $.ajax({
            type:'POST',
            url:'/admin/goods/delete-photo-good',
            data:{'path':path},
            success:function (data) {
                if(data){
                    $(self).parent().remove();

                    photoPath.indexOf(path)
                    photoPath.splice(photoPath.indexOf(path), 1)
                    $('#imgGoodsInput').val(photoPath);

                }
            },
            error:function () {
                console.log('error')
            }
        })
    });



    $(document).on('click','.deletePhotoService',function () {
        var path = $(this).attr('path');
        var self = $(this);
        $.ajax({
            type:'POST',
            url:'/admin/services/delete-photo-service',
            data:{'path':path},
            success:function (data) {
                if(data){
                    $(self).parent().remove();
                    photoPath.indexOf(path)
                    photoPath.splice(photoPath.indexOf(path), 1)
                    $('#imgServiceInput').val(photoPath);
                }
            },
            error:function () {
                console.log('error')
            }
        })
    });
    getLenta();
    setInterval(getLenta,60000)
});