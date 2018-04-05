<?php

use yii\bootstrap\Html;

$this->title = 'Сделки';
?>
<div class="deal-index">

    <h3><?= Html::encode($this->title) ?></h3>




    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Accounts')?></td>



                <td><?=Yii::t('app', 'Status')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>

                <td>Ваша роль</td>

            </tr>
            </thead>
            <tbody>
            <tr class="even">

                <td>
                    1
                </td>

                <td class="deal-49">
                    <a href="/demo-cabinet/chat?id=1">ООО "СибЭнергоПром" &amp;&amp; ООО "БИЗНЕС ПАРТНЕР ПЛЮС"</a>
                </td>
                <td>
                    Обязательства по сделке исполнены                    </td>

                <td>2017-11-23 17:19</td>

                <td>   Покупатель</td>



            </tr>
            <tr class="odd">

                <td>
                    2
                </td>

                <td class="deal-53">
                    <a href="/demo-cabinet/chat?id=1">ООО "АЗИЯ ГРУПП" &amp;&amp; ООО "СибЭнергоПром"</a>
                    <span class="badge badge_red">+1</span></td>
                <td>
                    Успешная сделка                    </td>

                <td>2018-01-30 14:40</td>

                <td>   Продавец</a></td>



            </tr>
            <tr class="even">

                <td>
                    3
                </td>

                <td class="deal-56">
                    <a href="/demo-cabinet/chat?id=1">ООО "АЛДА" &amp;&amp; ООО "СибЭнергоПром"</a>
                    <span class="badge badge_red">+1</span></td>
                <td>
                    Сделка приостановлена                    </td>

                <td>2017-06-30 15:45</td>

                <td>   Продавец</a></td>



            </tr>
            <tr class="odd">

                <td>
                    4
                </td>

                <td class="deal-55">
                    <a href="/demo-cabinet/chat?id=1">ООО "ВОСТОК" &amp;&amp; ООО "СибЭнергоПром"</a>
                    <span class="badge badge_red">+1</span></td>
                <td>
                    Сделка приостановлена                    </td>

                <td>2017-09-30 14:44</td>

                <td>   Продавец</a></td>



            </tr>
            </tbody>
        </table>
    </div>
</div>
