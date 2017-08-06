<?php
namespace common\widgets\rank;

use yii\bootstrap\Widget;

class NumbersRank extends Widget
{
    public $rankList;

    public function run()
    {
        return $this->render('numbers-rank', ['list'=>$this->rankList]);
    }

}