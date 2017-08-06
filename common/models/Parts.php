<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%parts}}".
 *
 * @property integer $part_id
 * @property string $desc
 * @property integer $parent_id
 */
class Parts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%parts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_id', 'desc', 'parent_id'], 'required'],
            [['part_id', 'parent_id'], 'integer'],
            [['desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'part_id' => '区域ID',
            'desc' => '描述',
            'parent_id' => '所属区域',
        ];
    }

    public function getParents()
    {
        return ArrayHelper::merge([0=>'无'], ArrayHelper::map(self::find()->where('parent_id=0')->asArray()->all(), 'part_id', 'desc'));
    }
}
