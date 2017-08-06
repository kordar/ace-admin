<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = $model->part_id;
$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'part_id' => $model->part_id, 'parent_id' => $model->parent_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'part_id' => $model->part_id, 'parent_id' => $model->parent_id], [
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
            'part_id',
            'desc',
            'parent_id',
        ],
    ]) ?>

</div>
