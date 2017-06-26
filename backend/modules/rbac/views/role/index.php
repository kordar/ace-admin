<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\rbac\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            // 'type',
            'description:ntext',
            'rule_name',
            'data',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{assign} {update} {delete}',
                'buttons' => [
                    'assign' => function($url, $model, $key) {
                        return Html::a('分配权限', ['assign', 'name' => $model['name']]);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::a('更新', ['update', 'name' => $model['name']]);
                    },
                    'delete' => function($url, $model, $key) {
                        return Html::a('删除', ['delete', 'name' => $model['name']], [
                            'data' => [
                                'confirm' => '确定删除该角色?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
</div>
