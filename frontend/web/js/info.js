$(function () {

    $('#checkAgentInfo').submit(function () {
       var data =  Number($('#company-data').val());
            if (!data){
                return false;
            }
            $('#checkAgentInfo >div > .btn').attr('disabled','disabled');
        $.ajax({
            type:'post',
            data:{'innOrOgrn':data},
            url:'/admin/information/get-info',
            success:function (data) {
                if(data){
                    $('#template-company').children().remove();
                   $('#template-company').append(data);
                    $('#checkAgentInfo > div > .btn').removeAttr('disabled');

                }
            },
            error:function () {
                // showMessage('danger','Error')
                $('#checkAgentInfo > div > .btn').removeAttr('disabled')
            }
        });
        return false;
    })

    $(document).on('click','#create-deal',function () {
       var email = $('#email-create-deal').val();
       var name = $('#name-company-create-deal').text();
       if(!email || !name){
           return false;
       }
       $.ajax({
           type:'post',
           data:{'email':email,'name':name},
           url:'/admin/deal/send-create-mess',
           success:function (data) {
               if(data){
                   showMessage('success','Предложение о сделке отправленно')
               }
               else {
                   showMessage('danger','Не получилось отправить предложение')
               }

           },
           error:function () {
               showMessage('danger','Не получилось отправить предложение')
           }

       })
    });

    $(document).on('click','.check-inn',function () {
        var inn = $(this).attr('check-inn');
        if(inn.length == 10){
            $('#company-data').val(inn);
            $('#checkAgentInfo').submit();
        }
        else if(inn.length == 12){
            $.ajax({
                type:'post',
                data:{inn:inn,'_csrf-frontend':yii.getCsrfToken()},
                url:'/admin/information/get-aff',
                success:function (data) {
                    $('#modal-attr').children().remove();
                    $('#modal-attr').append(data);
                    $('#modal-aff').modal('show');
                },
                error:function () {
                    showMessage('danger','Error')
                }
            })
        }

    });

    $(document).on('click','.check-name',function () {
        var inn = $(this).attr('check-name');

            $.ajax({
                type:'post',
                data:{inn:inn,'_csrf-frontend':yii.getCsrfToken()},
                url:'/admin/information/get-aff',
                success:function (data) {
                    $('#modal-attr').children().remove();
                    $('#modal-attr').append(data);
                    $('#modal-aff').modal('show');
                },
                error:function () {
                    showMessage('danger','Error')
                }
            })


    });



    $(document).on('click','.look-deal',function () {
        var deal_id = $(this).attr('deal-id');
        $.ajax({
            type:'post',
            url:'/admin/information/get-sud-deal?id='+deal_id,
            success:function (data) {
                $('#modal-attr').children().remove();
                $('#modal-attr').append(data);
                $('#modal-arbitration').modal('show');
            },
            error:function () {
                showMessage('danger','Error')
            }
        })
    })


});