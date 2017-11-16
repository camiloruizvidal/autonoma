<?php
namespace frontend\models;
use Yii;


class FormSearch extends \yii\db\ActiveRecord{
    public $q;
    public $fechaini;
    public $fechafin;

    public function rules()
    {
        return [
            [['q'], "match", "pattern" => "/^[0-9a-záéíóúñ\s]+$/i", "message" => "Sólo se aceptan letras y números"],
            [['fechaini', 'fechafin'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'q' => "",
            'fechaini' => 'Fecha de inicio',
            'fechafin' => 'Fecha de fin'
        ];
    }
}
