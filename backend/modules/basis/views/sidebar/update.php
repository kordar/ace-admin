<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\basis\models\Sidebar */

$this->title = 'Update Sidebar: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sidebars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sidebar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
