<?php

namespace backend\modules\news\models;

use yii\base\Event;

class AssignEvent extends Event
{
    public $itemID;
    public $part = [];
}
