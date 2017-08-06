<?php
namespace common\widgets;

use common\models\LoginForm;

class SignIn extends \yii\bootstrap\Widget
{
    public function run()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {}
        return $this->render('signin', ['model' => $model]);
    }
}