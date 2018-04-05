


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
                $(".badge_red_main").remove();
                $(".badge_red").remove();
                if(lenta['accounts']){
                    $('#account >a').append('<span class="badge badge_red_main" >+'+lenta['accounts'].length+'</span>')
                    lenta['accounts'].forEach(function (item) {
                        $('.account-'+item['new_account_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['goods']){
                    $('#goods >a').append('<span class="badge badge_red_main" >+'+lenta['goods'].length+'</span>');
                    lenta['goods'].forEach(function (item) {
                        $('.good-'+item['new_good_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });

                }
                if(lenta['services']){
                    $('#services >a').append('<span class="badge badge_red_main" >+'+lenta['services'].length+'</span>')
                    lenta['services'].forEach(function (item) {
                        $('.service-'+item['new_service_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['suggestions']){
                    $('#suggestions >a').append('<span class="badge badge_red_main" >+'+lenta['suggestions'].length+'</span>')
                }
                if(lenta['tickets']){
                    $('#support >a').append('<span class="badge badge_red_main" >+'+lenta['tickets'].length+'</span>')
                    lenta['tickets'].forEach(function (item) {
                        $('.ticket-'+item['new_ticket_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });

                }
                if(lenta['tickets_posts']){
                    $('#support >a').append('<span class="badge badge_red" >+'+lenta['tickets_posts'].length+'</span>')
                    $('#technical_support >a').append('<span class="badge badge_red" >+'+lenta['tickets_posts'].length+'</span>')
                    lenta['tickets_posts'].forEach(function (item) {
                        $('.ticket-'+item['ticket_id']).append('<span class="badge badge_red" >+1</span>')
                    });
                }
                if(lenta['consults']){
                    $('#advice >a').append('<span class="badge badge_red_main" >+'+lenta['consults'].length+'</span>')
                    lenta['consults'].forEach(function (item) {
                        $('.consult-'+item['new_consult_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['reviews']){
                    $('#reviews >a').append('<span class="badge badge_red_main" >+'+lenta['reviews'].length+'</span>')
                    lenta['reviews'].forEach(function (item) {
                        $('.review-'+item['new_review_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['consults_posts']){
                    $('#advice >a').append('<span class="badge badge_red" >+'+lenta['consults_posts'].length+'</span>')
                    lenta['consults_posts'].forEach(function (item) {
                        $('.consult-'+item['consult_id']).append('<span class="badge badge_red" >+1</span>')
                    });
                }
                if(lenta['deals']){
                    $('#deals >a').append('<span class="badge badge_red_main" >+'+lenta['deals'].length+'</span>')
                    lenta['deals'].forEach(function (item) {
                        $('.deal-'+item['new_deal_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['tasks']){
                    $('#tasks >a').append('<span class="badge badge_red_main" >+'+lenta['tasks'].length+'</span>')
                    lenta['tasks'].forEach(function (item) {
                        $('.task-'+item['task_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }

                if(lenta['deals_posts']){
                    $('#deals >a').append('<span class="badge badge_red" >+'+lenta['deals_posts'].length+'</span>')
                    lenta['deals_posts'].forEach(function (item) {
                        $('.deal-'+item['deal_id']).append('<span class="badge badge_red" >+1</span>')
                    });
                }
                if(lenta['disputes']){
                    $('#disputes >a').append('<span class="badge badge_red_main" >+'+lenta['disputes'].length+'</span>')
                    lenta['disputes'].forEach(function (item) {
                        $('.dispute-'+item['new_dispute_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['disputes_posts']){
                    $('#disputes >a').append('<span class="badge badge_red" >+'+lenta['disputes_posts'].length+'</span>')
                    lenta['disputes_posts'].forEach(function (item) {
                        $('.dispute-'+item['dispute_id']).append('<span class="badge badge_red" >+1</span>')
                    });
                }
                if(lenta['claims']){
                    $('#claims >a').append('<span class="badge badge_red_main" >+'+lenta['claims'].length+'</span>')
                    lenta['claims'].forEach(function (item) {
                        $('.claim-'+item['new_claim_id']).append('<span class="badge badge_red_main" >+1</span>')
                    });
                }
                if(lenta['claims_posts']){
                    $('#claims >a').append('<span class="badge badge_red" >+'+lenta['claims_posts'].length+'</span>')
                    lenta['claims_posts'].forEach(function (item) {
                        $('.claim-'+item['claim_id']).append('<span class="badge badge_red" >+1</span>')
                    });
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
    setInterval(getLenta,60000);

    $('#begin-mail').click(function () {
        showMessage('success','Рассылка началась');
        $.ajax({
            type:'post',
            url:'/admin/mail/mail'

        })
    }
)

    $("#statuses").change(function () {
        var val = $(this).val();
        if(val == 0){
           $(".display-block").removeClass("display-block");
        }
        else {
            $("[status='"+val+"']").parent().removeClass("display-block");
            $(".status").not("[status='"+val+"']").parent().addClass("display-block");
        }


    });

    $("#sides").change(function () {
        var val = $(this).val();
        if(val == 0){
            $(".display-block").removeClass("display-block");
        }
        else{
            $("[side='"+val+"']").parent().removeClass("display-block");
            $(".side").not("[side='"+val+"']").parent().addClass("display-block");
        }


    });

});