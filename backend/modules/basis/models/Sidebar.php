<?php

namespace backend\modules\basis\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sidebar".
 *
 * @property integer $id
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
 */
class Sidebar extends \common\models\ace\Sidebar
{

    public function parentsDownList()
    {
        $subQuery = (new Query())->select('parent_id')->distinct()->from('sidebar');
        $data = SideBar::find()->select(['id','title'])
                    ->where(['id'=>$subQuery])
                    ->asArray()->all();
        return ArrayHelper::merge([0=>'无(顶级菜单)'], ArrayHelper::map($data, 'id', 'title'));
    }

    public function dropDownItemsList()
    {
        $data = SideBar::find()->select(['id','title'])->asArray()->all();
        return ArrayHelper::merge([0=>'无'], ArrayHelper::map($data, 'id', 'title'));
    }

    public function dropDownItemsTreeList()
    {
        $data = SideBar::find()->orderBy('parent_id ASC')->asArray()->all();
        $obj = new \yiip\lte\libs\tree\MenuTreeList();
        return $obj->treeList($data);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '菜单名',
            'href' => '链接',
            'parent_id' => '上级菜单',
            'language' => '语言',
            'sort' => '排序',
            'icon' => '图标',
            'active' => '默认活动',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

}
