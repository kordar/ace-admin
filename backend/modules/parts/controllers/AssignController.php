<?php

namespace backend\modules\parts\controllers;

use common\models\Parts;
use common\models\PartsAssign;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * PartsController implements the CRUD actions for Parts model.
 */
class AssignController extends Controller
{

    /**
     * Lists all Parts models.
     * @return mixed
     */
    public function actionIndex($type, $item)
    {
        $list = Parts::find()->where(['parent_id' => $type])->asArray()->all();
        $model = new PartsAssign();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->saveAllAssign($post);
            Yii::$app->session->setFlash('success', '设置成功');
        }

        return $this->render('index', [
            'list' => ArrayHelper::map($list, 'part_id', 'desc'),
            'selected' => $model->getItemsAreas($item, $type),
            'type' => $type, 'item' => $item
        ]);
    }


}
