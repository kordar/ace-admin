<?php
namespace common\libs\advisory;

use Yii;
use yii\helpers\ArrayHelper;

class Home
{
    /**
     * @return array|mixed
     * 首页栏目
     */
    static public function oneAndTwo()
    {
        $cashKey = 'common:libs:advisory:home:one:two';
        if (Yii::$app->cache->exists($cashKey)) {
            return Yii::$app->cache->get($cashKey);
        }
        return self::getData();
    }


    static public function getData()
    {
        $indexResults = self::assignQuery()->where(['part_id'=>1])->andWhere(['IN', 'area_id', [1, 2]])->all();
        $indexs = ArrayHelper::getColumn($indexResults, 'item_id');
        $data = self::newsQuery()->select(['id', 'title', 'desc', 'publish_at'])->indexBy('id')->where(['IN', 'id', $indexs])->all();

        $cashData1 = ['title'=>'', 'desc'=>'', 'id'=>''];
        $cashData2 = [];

        foreach ($indexResults as $key => $result) {

            $index = $result['item_id'];

            if (empty($data[$index]['publish_at'])) {
                continue;
            }

            switch ($result['area_id']) {
                case 1:
                    $cashData1 = ['id'=>$data[$index]['id'], 'title'=>$data[$index]['title'], 'desc'=>$data[$index]['desc']];
                    break;
                case 2:
                    $cashData2[] = ['id'=>$data[$index]['id'], 'publishDate'=>date('Y-m-d', $data[$index]['publish_at']), 'title'=>$data[$index]['title']];
                    break;
            }
        }

        $cashData = ['new1'=>$cashData1, 'new2'=>$cashData2];

        $cashKey = 'common:libs:advisory:home:one:two';
        Yii::$app->cache->set($cashKey, $cashData, 10);

        return $cashData;
    }

    static public function newsQuery()
    {
        return (new \yii\db\Query())->from('{{%news_main}}');
    }

    static public function assignQuery()
    {
        return (new \yii\db\Query())->from('{{%parts_assign}}');
    }
}