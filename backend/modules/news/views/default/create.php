<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsMain */

$this->title = 'Create News Main';
$this->params['breadcrumbs'][] = ['label' => 'News Mains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
