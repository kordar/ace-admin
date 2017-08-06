<?php
namespace frontend\controllers;

use common\models\spread\Spread;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;


/**
 * Games controller
 */
class GamesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'opening', 'incr-views'],
                'rules' => [
                    [
                        'actions' => ['index', 'opening', 'incr-views'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'incr-views' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * 游戏大厅
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'games' => Spread::listForGames(),
        ]);
    }

    public function actionIncrViews()
    {
        $id = \Yii::$app->request->post('id', 0);
        $obj = Spread::findOne($id);
        $obj->views += 1;
        return $obj->save();
    }

    public function actionOpening()
    {
        $str = file_get_contents('http://tg.wuxiagu.com/go.php?uid=tg_112');
        preg_match("/<table[^>]*?>(.*\s*?)<\/table>/is",$str,$match);
        return $this->render('opening',['list'=>$match[0]]);
    }


}
