<?php

namespace backend\modules\basis\models;

use Yii;

/**
 * This is the model class for table "sidebar_view".
 *
 * @property string $title
 * @property string $href
 * @property integer $parent_id
 * @property string $language
 * @property string $icon
 * @property integer $active
 * @property integer $sort
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $id
 * @property integer $pid
 * @property string $parent_title
 */
class SidebarView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sidebar_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['parent_id', 'active', 'sort', 'status', 'created_at', 'updated_at', 'id', 'pid'], 'integer'],
            [['title', 'language', 'icon', 'parent_title'], 'string', 'max' => 255],
            [['href'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'href' => 'Href',
            'parent_id' => 'higher level, 0 for the top',
            'language' => 'Language',
            'icon' => 'Icon',
            'active' => 'Active',
            'sort' => 'Sort',
            'status' => 'set the sidebar status, the default 1 is active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id' => 'ID',
            'pid' => 'Pid',
            'parent_title' => 'Parent Title',
        ];
    }
}
