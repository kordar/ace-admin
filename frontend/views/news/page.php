<?php

use frontend\assets\PageAsset;

PageAsset::register($this);
/* @var $this yii\web\View */

$this->title = $pageInfo['title'];
$this->params['breadcrumbs'][] = ['label'=>'游戏咨询', 'url'=>'#'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="row">

        <div class="col-sm-9 bg-element page-detail">

            <?= \common\widgets\advisory\PageDetail::widget(['pageInfo'=>$pageInfo])?>

            <?= \common\widgets\ad\NormalBar::widget(['href'=>'#', 'src'=>'ad-top.jpg', 'alt'=>'test'])?>

            <?= \common\widgets\rostrum\Discuss::widget()?>

        </div>

        <div class="col-sm-3">

            <?= \common\widgets\ad\NormalBar::widget(['href'=>'#', 'src'=>'ad-sidebar.jpg', 'alt'=>'test'])?>

            <?= \common\widgets\rank\NumbersRank::widget()?>

            <?= \common\widgets\ad\NormalBar::widget(['href'=>'#', 'src'=>'ad-sidebar-small.jpg', 'alt'=>'test'])?>

            <?= \common\widgets\rank\NormalRank::widget()?>

        </div>


    </div>



</div>

