<?php

namespace backend\modules\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%news_main}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $auth
 * @property string $from
 * @property string $thumbnail
 * @property string $desc
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $publish_at
 */
class NewsMain extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVING = 20;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_main}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['desc', 'content', 'auth', 'from'], 'string'],
            [['status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVING],
            [['title', 'thumbnail'], 'string', 'max' => 255],
            [['publish_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'auth' => '作者',
            'from' => '来源',
            'thumbnail' => '图片地址',
            'desc' => '描述',
            'content' => '内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'publish_at' => '发布时间',
        ];
    }

    public function delByID($id)
    {
        self::findOne($id)->delete();
        $assignEvent = new AssignEvent();
        $assignEvent->itemID = $id;
        $assignEvent->part = [1];
        $this->trigger('NEWS_DEL', $assignEvent);
    }

}
