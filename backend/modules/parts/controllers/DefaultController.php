<?php

namespace backend\modules\parts\controllers;

use Yii;
use common\models\Parts;
use backend\modules\parts\search\PartsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartsController implements the CRUD actions for Parts model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Parts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Parts model.
     * @param integer $part_id
     * @param integer $parent_id
     * @return mixed
     */
    public function actionView($part_id, $parent_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($part_id, $parent_id),
        ]);
    }

    /**
     * Creates a new Parts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Parts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'part_id' => $model->part_id, 'parent_id' => $model->parent_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Parts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $part_id
     * @param integer $parent_id
     * @return mixed
     */
    public function actionUpdate($part_id, $parent_id)
    {
        $model = $this->findModel($part_id, $parent_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'part_id' => $model->part_id, 'parent_id' => $model->parent_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Parts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $part_id
     * @param integer $parent_id
     * @return mixed
     */
    public function actionDelete($part_id, $parent_id)
    {
        $this->findModel($part_id, $parent_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Parts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $part_id
     * @param integer $parent_id
     * @return Parts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($part_id, $parent_id)
    {
        if (($model = Parts::findOne(['part_id' => $part_id, 'parent_id' => $parent_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
