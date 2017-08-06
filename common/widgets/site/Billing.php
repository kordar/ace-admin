<?php
namespace common\widgets\site;

class Billing extends \yii\bootstrap\Widget
{
    public $alt = '';

    public function run()
    {
        return $this->render('billing', ['alt'=>$this->alt]);
    }
}