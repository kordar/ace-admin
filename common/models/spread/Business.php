<?php

namespace common\models\spread;

use Yii;

/**
 * This is the model class for table "{{%business}}".
 *
 * @property string $name
 * @property string $link
 * @property string $des
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Spread[] $spreads
 */
class Business extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%business}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['des'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '商家名称',
            'link' => 'url',
            'des' => '描述',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpreads()
    {
        return $this->hasMany(Spread::className(), ['business' => 'name']);
    }
}
