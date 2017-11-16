<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $idevento
 * @property string $titulo
 * @property string $descripcion
 * @property string $fecha
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo'], 'required', 'message' => 'Campo Requerido'],
            [['fecha'], 'safe'],
            [['titulo', 'descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idevento' => 'Idevento',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
        ];
    }
}
