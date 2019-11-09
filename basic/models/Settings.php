<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Settings extends ActiveRecord
{

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //required fields
            [['money_max', 'money_min', 'money_limit', 'mana_max', 'mana_min', 'mana_to_money_coef'], 'required'],
            //fields types
            ['money_max', 'integer'],
            ['money_min', 'integer'],
            ['money_limit', 'double'],
            ['mana_max', 'integer'],
            ['mana_min', 'integer'],
            ['mana_to_money_coef', 'double']
        ];
    }

    /*
    * Set attribute labels
    */
    public function attributeLabels()
    {
        return [
            'money_max' => 'Maximum money prise for person',
            'money_min' => 'Minimum money prise for person',
            'money_limit' => 'Available money for game',
            'mana_max' => 'Maximum mana prise for person',
            'mana_min' => 'Minimum mana prise for person',
            'mana_to_money_coef' => 'Mana to money conversion coeficient'
        ];
    }

    public function changeMoneyStock($val) {
        $this->money_limit = $this->money_limit - $val;
        $this->save();
    }
}