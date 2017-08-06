<?php

namespace backend\modules\news\controllers;

use Yii;
use backend\modules\news\models\NewsMain;
use backend\modules\news\search\NewsMainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsMainController implements the CRUD actions for NewsMain model.
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
                    'publish' => ['POST'],
                    'unpublish' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NewsMain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsMainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsMain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new NewsMain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsMain();

        //dump(Yii::$app->request->post());die;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing NewsMain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing NewsMain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = new NewsMain();

        $model->on('NEWS_DEL', [new \common\models\PartsAssign(), 'deleteByItemAndPart']);

        $model->delByID($id);

        return $this->redirect(['index']);
    }

    public function actionPublish($id)
    {
        $model = $this->findModel($id);
        $model->publish_at = time();
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionUnpublish($id)
    {
        $model = $this->findModel($id);
        $model->publish_at = null;
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionRefreshNewsList()
    {
        \common\libs\advisory\Index::refreshNewsList();
        return $this->redirect(['index']);
    }

    /**
     * Finds the NewsMain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsMain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsMain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
