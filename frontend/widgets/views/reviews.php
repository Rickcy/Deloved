<?php
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>
<div class="modal fade" id="Reviews-<?=$acc->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content review-content" style="width:100%;margin: 0 auto">
            <div class="modal-header" style="background-color: #94C43D">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title " style="text-align: center;color: white">Отзывы</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <ol>
                    <?php foreach ($reviews as $review):?>


                                <li>
                                    <?=(new DateTime($review['date_created']))->add(new DateInterval('PT'.$timeZone.'H'))->format('d.m.Y H:i')?> <br/>
                                    <?php if ($review->value == 1):?>
                                        Отзыв положительный
                                    <?php elseif ($review->value == -1):?>
                                    Отзыв отрицательный
                                    <?php elseif ($review->value == 0):?>
                                    Отзыв нейтральный
                                    <?php endif;?>
                                    <br/>
                                    Автор отзыва <a href="/companies/item?id=<?=$review->author_id?>"><?=$review->author->brand_name?></a>

                                    <hr/>

                                    <div><?=$review->content?></div>
                                    <hr/>
                                </li>


                    <?php endforeach;?>
                    </ol>
                </div>

            </div>
        </div>
    </div>
</div>
