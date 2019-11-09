<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\RealPrise;
use yii\filters\AccessControl;

class RealPriseController extends Controller
{

    /**
     * {@inheritdoc}
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
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->getId() == 100;
                        }
                    ]
                ],
            ]
        ];
    }

    /**
     * Action for controlling real prises
     * 
     * @return Response|string
     */
    public function actionIndex()
    {

        $model = new RealPrise();
        //if new prise was submitted
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            Yii::$app->session->setFlash('newpriseSubmitted');

            $model->save();

            return $this->refresh();
        }
        //get existing prises
        $query = RealPrise::find();
        
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $prises = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'prises' => $prises,
            'pagination' => $pagination,
            'model' => $model
        ]);
    }
}