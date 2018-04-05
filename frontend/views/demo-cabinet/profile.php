<?php
$this->title='Мой профиль';
?>
<div class="profile-info">
    <h3>Профиль</h3>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="fio">ФИО</label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="fio" name="fio" class="form-control" readonly="" value="Каприн Василий Иванович" placeholder="Отсутствует" type="text">
            <div class="pods fr"></div>
        </div>

    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="profile_date"></label>
        </div>

        <a class="value-col ft change-pass" href="">Сменить пароль </a>



    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="city">Город</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="city" class="form-control ui-autocomplete-input" name="profile_city" value="Новосибирск" readonly="" placeholder="Отсутствует" data-old="Новосибирск" autocomplete="off" type="text">            <div class="pods fr">Город, к которому будет прикреплен ваш профиль</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="city" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="email">Эл. почта</label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="email" name="email" class="form-control" readonly="" value="kaprin76@gmail.com" placeholder="Отсутствует" type="text">
            <div class="pods fr">Контактный адрес электронной почты</div>
        </div>

    </div>



    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="date_reg">Дата регистрации</label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="date_reg" class="form-control" name="date_reg" readonly="" value="24.01.2017 14:40:56" placeholder="Отсутствует" type="text">
            <div class="pods fr"></div>
        </div>
        <div class="action-col">
            <!--            <a href="javascript:void(0)" name="change" data-for="email">Изменить</a>-->
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="profile_date">Статус подписки</label>
        </div>
        <div class="col-sm-7 ft ">
            <input id="profile_date" class="form-control" name="profile_date" readonly="" value="Расширенная" type="text">
            <div class="pods fr"></div>
        </div>
    </div>



</div>
