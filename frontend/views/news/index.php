<?php

/* @var $this yii\web\View */

$this->title = 'News';
?>
<div class="site-index">

    <?php $this->beginBlock('jumbotron')?>

    <div class="row">
        <div class="col-sm-12">
            <?= \common\widgets\site\Banner::widget();?>
        </div>
    </div>

    <?php $this->endBlock(); ?>



    <div class="row">

        <div class="col-sm-9">
            <?= \common\widgets\advisory\NewsList::widget(['pages'=>$pages, 'newsList'=>$newsList])?>
        </div>

        <div class="col-sm-3 no-padding-left">


            <?= \common\widgets\ad\NormalBar::widget(['href'=>'#', 'src'=>'ad-sidebar.jpg', 'alt'=>'test'])?>

            <?= \common\widgets\rank\NumbersRank::widget()?>

            <?= \common\widgets\rank\NormalRank::widget()?>
            
        </div>

    </div>





    <div class="body-content"></div>

</div>