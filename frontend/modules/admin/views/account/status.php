<?php
?>
<span class='status <?=$statusClass?:''?> <?=$status?($statusEnabled ?: 'enabled'):($statusDisabled ?: 'disabled')?>'>
<span class='glyphicon <?=$status?($iconTrue ?: 'glyphicon-ok') : ($iconFalse ?: 'glyphicon-ban-circle')?>'></span>
</span>
