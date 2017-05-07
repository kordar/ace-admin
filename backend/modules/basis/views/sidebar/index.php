<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\basis\search\SidebarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单管理';
$this->params['breadcrumbs'][] = $this->title;
$this->params['menu'] = 'menu';
?>
<div class="sidebar-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建菜单项', ['/menu/create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'title',
                'format'=>'raw',
                'value'=>function($model) {
                    return Html::tag('span', Html::tag(
                            'i', '', ['class'=>"menu-icon fa {$model['icon']}"]
                        ) . ' ' . $model->title);
                },
            ],

            [
                'attribute'=>'href',
                'format'=>'raw',
                'value'=>function($model) {
                    if ($model['href'] == '#') $url = '#';
                    else $url = ['/' . $model['href']];
                    return Html::a($model['href'], $url);
                },
            ],

            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function($model) use($dropDownItemsList) {
                    $val = $dropDownItemsList[$model['parent_id']];
                    $cls = 'text-success';
                    if ($model->active == 1) {
                        $cls = 'text-danger';
                        $val .= "（活动）";
                    }
                    return Html::tag('i', $val, ['class'=>$cls]);
                },
                'filter' => $searchModel->parentsDownList()
            ],

            // 'language',

            // 'active',
            // 'sort',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                'header' => "操作",
                'class' => 'yii\grid\ActionColumn',
                'template'=> '{view} {update} {delete}',
                'headerOptions' => ['width' => '140'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '', ['class'=>"glyphicon fa fa-eye"]), ['/menu/view', 'id'=>$model->id], ['class' => "btn btn-xs btn-success", 'title'=>'查看']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '', ['class'=>"glyphicon fa fa-pencil"]), ['/menu/update', 'id'=>$model->id], ['class' => "btn btn-xs btn-warning", 'title'=>'更新']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '', ['class'=>"glyphicon fa fa-trash"]), ['/menu/delete', 'id'=>$model->id], ['class' => "btn btn-xs btn-warning", 'title'=>'删除', 'data-confirm'=>"您确定要删除此项吗？", 'data-method'=>"post"]);
                    }
                ]
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
