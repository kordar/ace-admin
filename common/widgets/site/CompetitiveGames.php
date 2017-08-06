<?php
namespace common\widgets\site;

class CompetitiveGames extends \yii\bootstrap\Widget
{
    public $alt = '';

    public function run()
    {
        return $this->render('competitive-games');
    }
}