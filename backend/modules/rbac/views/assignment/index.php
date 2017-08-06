<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\Role */

$this->title = '权限分配';
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="role-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'roles')->checkboxList($roles, [
            'item'=>function($index, $label, $name, $checked, $value) {
                $checkedStr = $checked ? 'checked' : '';
                return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
            }
        ]) ?>


        <?= $form->field($model, 'permissions')->checkboxList($permissions, [
            'item'=>function($index, $label, $name, $checked, $value) {
                $checkedStr = $checked ? 'checked' : '';
                return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
            }
        ]) ?>



        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>