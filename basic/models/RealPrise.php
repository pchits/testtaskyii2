<?php

namespace app\models;

// use yii\base\Model;
use yii\db\ActiveRecord;

class RealPrise extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name and quantity are both required
            [['name', 'quantity'], 'required'],
            // quantity must be an integer
            ['quantity', 'integer']
        ];
    }

    /*
    * Set attribute labels
    */
    public function attributeLabels()
    {
        return [
            'name' => 'Prise name',
            'quantity' => 'Available quantity'
        ];
    }

    /*
    * Change the stock of prises
    */
    public function changeStock($val = 1)
    {
        $this->quantity = $this->quantity - $val;
        $this->save();
        
    }
}