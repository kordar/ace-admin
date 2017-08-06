<?php
namespace common\widgets\site;

use common\libs\advisory\Home;

class NewsHeader extends \yii\bootstrap\Widget
{
    public function run()
    {
        return $this->render('news-header', [
            'list' => Home::oneAndTwo()
        ]);
    }
}