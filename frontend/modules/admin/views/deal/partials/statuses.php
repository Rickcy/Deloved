<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 29.09.17
 * Time: 1:02
 */

use common\models\Deal;

?>
<?php foreach($deal->getNextAllowedStatuses($deal->status) as $key => $val):?>
    <li><a id="status-<?=$key?>" href="javascript:void(0)"
           onclick="return setStatus(<?=$val?>);"><?=Deal::getNameStatus($val)?></a>
    </li>
<?php endforeach?>
