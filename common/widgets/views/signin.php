<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="col-sm-2 img-rounded head-form" id="head-form">
    <br>

    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
        'class' => 'bs-example bs-example-form', 'role' => 'form'
    ]]); ?>

    <?= $form->field($model, 'username', [
        'template'=>'<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div>'
    ])->textInput() ?>

    <?= $form->field($model, 'password',[
        'template'=>'<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div>'
    ])->passwordInput() ?>

    <?= $form->field($model, 'verifyCode', ['template'=>'{input}'])->widget(Captcha::className(), [
        'template'=>'<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-plus-sign"></span></span>{input}<span class="input-group-addon" style="padding: 0;margin: 0;">{image}</span></div>'
    ]) ?>



    <div style="color:#999;margin:1em 0">
        If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
    </div>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>