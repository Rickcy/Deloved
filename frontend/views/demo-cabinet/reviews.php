<?php
$this->title = 'Отзывы';
?>
<div class="review-index">
    <h3>Отзывы</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#my" data-toggle="tab" aria-expanded="true">Мои</a></li>
        <li class=""><a href="#about" data-toggle="tab" aria-expanded="false">Обо мне</a></li>
    </ul>
    <div class="tab-content" style="margin-top: 15px">
        <div class="tab-pane" id="my">

            <div class="table-responsive">
                <table border="0" class="table table-striped  table-hover">
                    <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                    <tr>


                        <th>   Предприятие</th>


                        <th>   Автор</th>
                        <th>   Оценка</th>
                        <th>   Опубликованно</th>
                        <th>   Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="even">
                        <td class="review-5"><a href="">Отзыв о ООО "СибЭнергоПром"</a></td>
                        <td>ООО "АЛДА"</td>
                        <td><span class="glyphicon glyphicon-plus-sign"></span></td>
                        <td>Нет</td>
                        <td>2018-01-30 13:40:28</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane active" id="about">
            <div class="table-responsive">
                <table border="0" class="table table-striped  table-hover">
                    <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                    <tr>
                        <th>   Предприятие</th>
                        <th>   Автор</th>
                        <th>   Оценка</th>
                        <th>   Опубликованно</th>
                        <th>   Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="even">
                        <td class="review-6"><a href="">Отзыв о ООО "АЛДА"</a></td>
                        <td>ООО "СибЭнергоПром"</td>
                        <td><span class="glyphicon glyphicon-plus-sign"></span></td>
                        <td>Да</td>
                        <td>2018-01-30 13:40:47</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
