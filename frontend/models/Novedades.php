<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "novedades".
 *
 * @property integer $idnovedades
 * @property string $descripcion
 * @property string $fecha
 * @property integer $idproyecto
 *
 * @property Proyecto $idproyecto0
 */
class Novedades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'novedades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'fecha', 'idproyecto'], 'required', 'message' => 'Campo Requerido'],
            [['fecha'], 'safe'],
            [['idproyecto'], 'integer'],
            [['descripcion'], 'string', 'max' => 45],
            [['idproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['idproyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnovedades' => 'Idnovedades',
            'descripcion' => 'Descripcion',
            'fecha' => 'Fecha',
            'idproyecto' => 'proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdproyecto0()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'idproyecto']);
    }
}
