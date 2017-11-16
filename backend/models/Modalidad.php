<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "modalidad".
 *
 * @property integer $idmodalidad
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Anteproyecto[] $anteproyectos
 */
class Modalidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modalidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required', 'message' => 'Campo Requerido'],
            [['nombre', 'descripcion'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmodalidad' => 'Idmodalidad',
            'nombre' => 'Modalidad',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnteproyectos()
    {
        return $this->hasMany(Anteproyecto::className(), ['idmodalidad' => 'idmodalidad']);
    }
}
