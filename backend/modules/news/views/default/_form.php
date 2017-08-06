<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\kordar\ace\web\AceMarkDownAsset::register($this);




/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\NewsMain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-main-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 12, 'data-provide'=>'markdown', 'data-iconlibrary'=>'fa']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$html = '> list text here《绝地求生》是现在人气最火爆的游戏，很多人气主播在直播时都会玩这个游戏。所以遭遇到“狙击”或者“直播窥屏”，自然也是避免不了的事情。而昨天在Reddit论坛《绝地求生》版块出现的一个关于这件事的帖子，使得玩家们把矛头都指向了游戏开发商Bluehole。';

$js = "var a = '$html'; \$('#TT').html(a).markdown({hiddenButtons:true});";
$this->registerJs($js);
?>