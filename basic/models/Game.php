<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\RealPrise;
use app\models\Settings;
use yii\db\ActiveRecord;

class Game extends ActiveRecord
{

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['uid', 'prise_type', 'prise_value', 'status'], 'required'],
            
            ['uid', 'integer'],
            ['prise_type', 'string'],
            ['prise_value', 'integer'],
            ['prise_id', 'integer'],
            ['status', 'string']
        ];
    }

    /**
     * Saves game data from session
     */
    public function save_from_session()
    {
        $game_data = Yii::$app->session->get('game');
        $this->uid = Yii::$app->user->getId();
        $this->prise_type = $game_data['type'];
        $this->prise_value = $game_data['value'];
        $this->prise_id = $game_data['id'];

        //change the stock
        if ($this->prise_type == 'real') {
            $prise = RealPrise::findOne($this->prise_id);
            $prise->changeStock();
            $this->status = 'NEW';
        }
        elseif (($this->prise_type == 'money')) {
            $settings = Settings::findOne(1);
            $settings->changeMoneyStock($this->prise_value);
            $this->status = 'NEW';
        }
        else {
            $current_mana = Yii::$app->session->get('user.mana');
            Yii::$app->session->set('user.mana', $current_mana + $this->prise_value);
            
            $this->status = 'DONE';
        }

        $this->save();
    }
}