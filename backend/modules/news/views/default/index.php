<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\search\NewsMainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News Mains';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-main-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create News Main', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Refresh News List', ['refresh-news-list'], ['class' => 'btn btn-info']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            // 'thumbnail',
            // 'desc:ntext',
            // 'content',
            // 'status',
            [
                'label'=>'发布日期',
                'attribute' => 'publish_at',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->publish_at) {
                        return date('Y-m-d H:i:s', $model->publish_at) . " | " . Html::a('取消发布', ['unpublish', 'id'=>$model->id], [
                            'data-method'=>'post',
                            'title'=>'取消发布',
                            'aria-label'=>'取消发布',
                            'data-confirm'=>'确定取消发布?'
                        ]);
                    } else {
                        return "<i>未发布</i> | " . Html::a('发布', ['publish', 'id'=>$model->id], [
                            'data-method'=>'post',
                            'title'=>'发布',
                            'aria-label'=>'发布',
                            'data-confirm'=>'确定发布?'
                        ]);
                    }
                }
            ],
            // 'updated_at',

            [

                'header' => "操作",
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{operate}',
                'buttons' => [
                    'operate' => function ($url, $model, $key) {
                        return Html::a('首页管理', ['/parts/assign/index', 'type'=>1, 'item'=>$model->id], ['target'=>'_blank']);
                    },
                ]

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
