<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsMain */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-main-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'thumbnail',
            'desc:ntext',
            [
                'attribute' => 'content',
                //'format' => 'raw',
                'value' => function($model) {
                    $parser = new \kordar\ace\web\Parser();
                    return $parser->makeHtml($model->content);
                }
            ],
            'status',
            [
                'label'=>'创建日期',
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'label'=>'更新日期',
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
