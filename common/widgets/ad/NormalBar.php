<?php
namespace common\widgets\ad;

use yii\bootstrap\Widget;

class NormalBar extends Widget
{
    public $href;
    public $src;
    public $alt;

    public function run()
    {
        return $this->render('normal-bar', ['href'=>$this->href, 'src'=>$this->src, 'alt'=>$this->alt]);
    }

}