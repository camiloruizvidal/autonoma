<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "conocimiento".
 *
 * @property integer $idconocimiento
 * @property string $nombre
 * @property string $descripcion
 * @property string $telefono
  * @property string $correo
 */
class Conocimiento extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conocimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'telefono', 'correo', 'descripcion' ], 'required', 'message' => 'Campo Requerido'],
            [['nombre', 'descripcion', 'correo'], 'string', 'max' => 200],
            [['correo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idconocimiento' => 'Idconocimiento',
            'nombre' => 'Titulo',
            'descripcion' => 'Descripcion',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
        ];
    }
}
