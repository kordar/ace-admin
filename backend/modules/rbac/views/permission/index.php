<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rbac\models\PermissionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '权限列表';
$this->params['breadcrumbs'][] = '权限管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permission-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建权限', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute'=>'type',
                'format'=>'raw',
                'value'=>function($model) {
                    return Html::tag('i', $model['type'] == 2 ? '权限' : '', ['class'=>'alert-success']);
                },
            ],
            'description:ntext',
            'rule_name',
            'data',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
