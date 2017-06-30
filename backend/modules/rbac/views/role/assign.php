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

    <h1><?= Html::tag('span', $model->name, ['class'=>'alert-success']) . Html::encode($this->title) ?></h1>

    <div class="role-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'role')->checkboxList($roles, [
            'item'=>function($index, $label, $name, $checked, $value) {
                $checkedStr = $checked ? 'checked' : '';
                return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
            }
        ]) ?>

        <?= $form->field($model, 'assign')->checkboxList($permissions, [
            'item'=>function($index, $label, $name, $checked, $value) {
                $checkedStr = $checked ? 'checked' : '';
                return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
            }
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>