<?php

namespace backend\modules\rbac\controllers;

use backend\modules\rbac\models\Assignment;
use Yii;
use backend\modules\rbac\models\Role;
use backend\modules\rbac\search\RoleSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class AssignmentController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * @param $name
     * @return string
     */
    public function actionIndex($userID)
    {
        $model = new Assignment();

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->setAssignment($userID)) {
                //return $this->redirect(['view', 'name' => $model->name]);
            }
        }

        return $this->render('index', [
            'model' => $model,
            'permissions' => $model->permissions($userID),
            'roles' => $model->roles($userID)
        ]);
    }


}
