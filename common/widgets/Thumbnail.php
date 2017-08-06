<?php
namespace common\widgets;

use Yii;

class Thumbnail extends \yii\bootstrap\Widget
{

    /**
     * @var array
     * [
        [
            'img' => '', 'href' => '', 'title' => '', 'des' => '', 'num' => '', 'laterTimestamp' => (int)
        ]
     * ]
     */
    public $items = [];

    public function run()
    {
        return $this->render('thumbnail', ['items'=>$this->items]);
    }
}
