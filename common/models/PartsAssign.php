<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%parts_assign}}".
 *
 * @property integer $item_id
 * @property integer $part_id
 * @property integer $area_id
 */
class PartsAssign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%parts_assign}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'part_id', 'area_id'], 'required'],
            [['item_id', 'part_id', 'area_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'part_id' => 'Part ID',
            'area_id' => 'Area ID',
        ];
    }

    public function deleteByItemAndPart($event)
    {
        $results = PartsAssign::find()->where(['item_id'=>$event->itemID])->andWhere(['IN', 'part_id', $event->part])->all();
        foreach ($results as $result) {
            $result->delete();
        }
    }

    public function getItemsAreas($itemID, $partID)
    {
        return ArrayHelper::getColumn(self::find()->where(['item_id'=>$itemID, 'part_id'=>$partID])->asArray()->all(), 'area_id');
    }

    public function saveAllAssign($post)
    {
        self::deleteAll('item_id = :item_id AND part_id = :part_id', [':item_id' => $post['ItemID'], ':part_id' => $post['ParentID']]);

        if (!empty($post['AreaID'])) {

            $data = [];

            foreach ($post['AreaID'] as $key => $area) {
                list($data[$key]['item_id'], $data[$key]['part_id'], $data[$key]['area_id']) = [$post['ItemID'], $post['ParentID'], $area];
            }

            \Yii::$app->db->createCommand()->batchInsert(self::tableName(), ['item_id', 'part_id', 'area_id'], $data)->execute();//执行批量添加
        }

    }

}
