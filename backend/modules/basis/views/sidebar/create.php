<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\basis\models\Sidebar */

$this->title = '新建菜单项';
$this->params['breadcrumbs'][] = ['label' => '菜单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['menu'] = 'menu/create';
?>

<div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <!-- /.box -->

</div>
