<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\Role */

$this->title = '版块分配';
$this->params['breadcrumbs'][] = ['label' => '版块管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="role-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= Html::hiddenInput('ItemID', $item); ?>

        <?= Html::hiddenInput('ParentID', $type); ?>

        <?= Html::checkboxList('AreaID', $selected, $list, [
                'item'=>function($index, $label, $name, $checked, $value) {
                    $checkedStr = $checked ? 'checked' : '';
                    return "<label><input name=\"{$name}\" class=\"ace ace-checkbox-2\" type=\"checkbox\" {$checkedStr} value=\"{$value}\"><span class=\"lbl\"> {$label}</span></label>";
                }
            ]);
        ?>

        <div class="form-group">
            <?= Html::submitButton('提交', ['class'=> 'btn btn-success btn-sm']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>