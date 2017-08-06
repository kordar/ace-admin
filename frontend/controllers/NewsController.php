<?php
namespace frontend\controllers;

use common\models\LoginForm;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use common\libs\advisory\Index;
use yii\web\Response;

/**
 * Site controller
 */
class NewsController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionIndex()
    {
        $request = Yii::$app->request;
        $page = $request->get('page', 1);
        $pageSize = $request->get('per-page', 15);

        $pages = new Pagination(['totalCount' =>Index::newsListCounts(), 'pageSize' => $pageSize]);
        return $this->render('index', ['pages' => $pages, 'newsList' => Index::newsList($page, $pageSize)]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionPage($id)
    {
        return $this->render('page', ['pageInfo'=>\common\libs\advisory\Page::pageDetail($id)]);
    }

    public function actionSignup()
    {
        $model = new LoginForm();
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return ['status' => true];
            }
        }

        return ['status' => false];
    }

}
