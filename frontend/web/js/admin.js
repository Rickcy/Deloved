


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
            if (lenta.length!==null){
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
            }
        },
        error:function () {
            showMessage('danger','Error')
        }
    })
}

$(function () {
    $('#imgGoodsInput').change(function () {
        var input =$("#imgGoodsInput");
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
                $('#image-template').append('<img src="'+data+'" />')
            },
            error:function () {
                console.log('Error')
            }
        })
    });

    setInterval(getLenta(),60000)
});