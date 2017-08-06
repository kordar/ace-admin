<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Parts */

$this->title = 'Update Parts: ' . $model->part_id;
$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->part_id, 'url' => ['view', 'part_id' => $model->part_id, 'parent_id' => $model->parent_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
