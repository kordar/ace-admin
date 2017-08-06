<?php

use frontend\assets\DiscussAsset;
use yii\bootstrap\Html;
use \yii\bootstrap\ActiveForm;

DiscussAsset::register($this);

?>

<div class="panel panel-default bg-element">
    <div class="panel-heading no-padding-left">
        <h3 class="panel-title">评论</h3>
    </div>
    <div class="panel-body no-padding no-margin">

        <div class="discuss-publish">
            <div class="discuss-publish-header">
                <div class="col-sm-4 no-padding no-margin">
                    <span class="discuss-publish-header-title"><span class="text-danger">464654</span>人参与</span>
                </div>

                <div class="col-sm-8 no-padding no-margin text-right">

                <?php

                    if (Yii::$app->user->isGuest) {

                        $model = new \common\models\LoginForm();

                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'enableAjaxValidation' => true,
                            'validationUrl' => ['signup'],
                            'options' => [
                                'class' => 'form-inline no-padding-right',
                            ]
                        ]);

                        echo $form->field($model, 'username', [
                            'template' => "<span class=\"input-group-addon\"><span class='glyphicon glyphicon-user'></span></span>{input}\n{error}",
                            'options' => ['class' => 'input-group input-group-sm']
                        ])->textInput();

                        echo $form->field($model, 'password', [
                            'template' => "<span class=\"input-group-addon\"><span class='glyphicon glyphicon-lock'></span></span>{input}",
                            'options' => ['class' => 'input-group input-group-sm']
                        ])->textInput();

                        echo Html::button('登录', ['id' => 'login-btn', 'class' => 'btn btn-default btn-sm', 'name' => 'login-button', 'data-action' => \yii\helpers\Url::to(['signup'])]);
                        echo Html::a('注册', ['site/signup'], ['class' => 'btn btn-default btn-sm', 'name' => 'login-button']);

                        ActiveForm::end();

                    } else {
                        echo '<span class="discuss-publish-header-title pull-right"><i>会员 </i><i class="text-danger">' . Yii::$app->user->identity->username . '</i>&nbsp;&nbsp;</span>';
                    }

                ?>

                </div>


            </div>
            <div class="discuss-publish-body">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <button type="button" class="btn btn-warning pull-right">提交</button>
            </div>
        </div>

    </div>
</div>

<?php

$js = <<<JS

    $('#login-btn').click(function () {
        var url = $(this).attr('data-action');
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: $(this).parents('form').serialize(),
            success: function(Data) {
                if(Data.status) {
                    alert('登录成功');
                    window.location.reload();
                } else {
                    alert('登录失败');
                }
            },
            error: function() {
                alert('网络错误！');
            }
        });
        return false;
       });


JS;

$this->registerJs($js);

?>