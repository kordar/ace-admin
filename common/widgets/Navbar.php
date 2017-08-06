<?php
namespace common\widgets;

class Navbar extends \yii\bootstrap\Widget
{
    public function run()
    {
        return $this->render('nav-bar');
    }
}