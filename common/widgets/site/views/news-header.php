<?php
use yii\bootstrap\Html;

?>

<div class="bg-element">

    <h2 style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
        <?= Html::a($list['new1']['title'], ['news/page', 'id'=>$list['new1']['id']], ['class'=>'text-danger', 'target'=>'_blank'])?>
    </h2>

    <p class="news-header-p" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?= $list['new1']['desc'];?></p>

    <hr style="border-bottom: 2px solid #e67e22;">

    <ul class="news-header-ul">
        <?php foreach ($list['new2'] as $res):?>
            <li><a href="#"><?= $res['title']?></a><span class="pull-right"><?= $res['publishDate']?></span></li>
        <?php endforeach;?>
    </ul>

</div>
