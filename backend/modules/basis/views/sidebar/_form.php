<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\basis\models\Sidebar */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-10">{input}<span class="help-block">{error}</span></div>',
            'labelOptions' => ['class'=>'col-sm-2 control-label'],
            'inputOptions' => ['class'=>'form-control'],
        ],
        'options' => ['class' => 'form-horizontal'],
    ]); ?>

    <div class="box-body">

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'href')->dropDownList(\Yii::$app->params['rules']) ?>

    <?= $form->field($model, 'parent_id')->dropDownList($model->dropDownItemsTreeList()) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([0=>'否',1=>'是']) ?>

    <?= $form->field($model, 'sort')->textInput(['default'=>1]) ?>

    </div>

    <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>