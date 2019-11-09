<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use app\models\RealPrise;
use app\models\Game;
use app\models\Settings;
use yii\filters\AccessControl;

class GameController extends Controller
{

    public $prise_types = ['money', 'mana', 'real'];

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'results'],
                'rules' => [
                    [
                        'actions' => ['results'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->getId() == 100;
                        }
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ]
        ];
    }

    /**
     * Generate new random game results
     */
    public function generate_game($money_limits, $mana_limits, $money_stock) {
        $id = null;
        $name = null;
        $type_key = mt_rand(0, sizeof($this->prise_types) - 1);
        
        $type = $this->prise_types[$type_key];
        
        if ($type == 'money') {
            $value = mt_rand($money_limits[0], $money_limits[1]);
            //we can't give this prise
            if ($money_stock < $value) {
                $this->generate_game($money_limits, $mana_limits, $money_stock);
            }
        }
        elseif ($type == 'mana') {
            $value = mt_rand($mana_limits[0], $mana_limits[1]);
        }
        else {
            $value = 1;
            $query = RealPrise::find()
                ->where(['>', 'quantity', 0])
                ->orderBy(new Expression('random()'))
                ->limit(1)->all();
            //we don't have prises
            if (!isset($query[0])) {
                //we can't give this prise
                $this->generate_game($money_limits, $mana_limits, $money_stock);
            }
            $name = $query[0]->name;
            $id = $query[0]->id;
        }
        return ['type' => $type, 'value' => $value, 'id' => $id, 'name' => $name];

    }
    
    /**
     * Action for running the game
     * 
     * @return Response|string
     */
    public function actionIndex()
    {
        //get settings for game limits
        $settings = Settings::findOne(1);

        $game = null;
        
        switch (Yii::$app->request->post('send')) {
            case 'save':
                //saving the last game
                Yii::$app->session->setFlash('newgameSave');
                //get the last game data from session
                $game_data = Yii::$app->session->get('game');
                $game = new Game();
                //save the game with session data
                $game->save_from_session();
                        
            break;
            case 'tomana':
                //saving the last game
                Yii::$app->session->setFlash('newgameSave');
                //get the last game data from session
                $game_data = Yii::$app->session->get('game');
                $coef = $settings->mana_to_money_coef;

                //convert money to mana
                $game_data['type'] = 'mana';
                $game_data['value'] = $game_data['value'] * $coef;
                Yii::$app->session->set('game', $game_data);

                $game = new Game();
                //save the game with session data
                $game->save_from_session();
            break;
            case 'play':
                //new game started
                Yii::$app->session->setFlash('newgameDone');
                //get game results
                $game = $this->generate_game(
                    [$settings->money_min, $settings->money_max],
                    [$settings->mana_min, $settings->mana_max], $settings->money_limit
                );
                //save current game in session
                Yii::$app->session->set('game', $game);
                
            break;
        }
        
        return $this->render('index', [
            'game' => $game
        ]);
    }

    /**
     * Action for viewing results of saved games
     * 
     * @return Response|string
     */
    public function actionResults()
    {
        $model = new Game();
        $query = Game::find();

        $games = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('results', [
            'games' => $games,
            'model' => $model
        ]);

    }

    /**
     * Action for viewing results of saved games
     */
    public function sendMoneyPrise($game)
    {



    }

    

}