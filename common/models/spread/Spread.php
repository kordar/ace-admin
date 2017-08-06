<?php

namespace common\models\spread;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%spread}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $cate
 * @property string $spread_link
 * @property string $business
 * @property string $images_url
 * @property string $des
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Business $business0
 */
class Spread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spread}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'spread_link', 'created_at', 'updated_at'], 'required'],
            [['cate', 'status', 'views', 'created_at', 'updated_at'], 'integer'],
            [['des'], 'string'],
            [['title', 'spread_link', 'business', 'images_url'], 'string', 'max' => 255],
            [['business'], 'exist', 'skipOnError' => true, 'targetClass' => Business::className(), 'targetAttribute' => ['business' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '游戏标题',
            'cate' => '分类,1广告2注册',
            'spread_link' => '推广链接',
            'business' => '商家',
            'images_url' => '图片ID',
            'des' => '描述',
            'views' => '访问量',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusiness0()
    {
        return $this->hasOne(Business::className(), ['name' => 'business']);
    }


    public static function setViews($id)
    {
        $cache = Yii::$app->cache;
        $key = 'spread-views';
        if ($cache->exists($key)) {
            $data = $cache->get($key);
            $data[$id] += 1;
            $time = intval($cache->get($key . ':syn'));
            if (time() - $time > 300) {
                foreach ($data as $key => $num) {
                    $model = self::findOne($key);
                    $model->views = $num;
                    $model->save();
                }
                $cache->set($key . ':syn', time() + 300);
            }
        } else {
            $data = [];
            $data[$id] += 1;
        }
        $cache->set($key, $data);
    }


    /**
     * @return array|\yii\db\ActiveRecord[]
     * 试玩列表
     */
    public static function listForGames()
    {
        $cache =  Yii::$app->cache;
        $key = 'spread-hots-data';

        if ($cache->exists($key)) {
            return $cache->get($key);
        }

        $data = self::find()->select([
            'id',
            'title',
            'spread_link AS href',
            'images_url AS img',
            'des', '(views + 1) AS num',
        ])->where([
            'status' => 10
        ])->orderBy('views DESC')->asArray()->all();

        $numArr = ArrayHelper::getColumn($data, 'num');
        $argv = array_sum($numArr) / count($numArr);

        foreach ($data as $key => $val) {
            $data[$key]['star'] = intval(ceil($val['num'] / $argv)) % 5;
        }
        $cache->set('spread-hots-data', $data, 600);

        return $data;
    }
}
