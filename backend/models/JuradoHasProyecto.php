<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jurado_has_proyecto".
 *
 * @property integer $idjurado
 * @property integer $idproyecto
 * @property integer $idjurado2
 *
 * @property Jurado $idjurado0
 * @property Jurado $idjurado20
 * @property Proyecto $idproyecto0
 */
class JuradoHasProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurado_has_proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjurado', 'idproyecto', 'idjurado2'], 'required', 'message' => 'Campo Requerido'],
            [['idjurado', 'idproyecto', 'idjurado2'], 'integer'],
            [['idjurado'], 'exist', 'skipOnError' => true, 'targetClass' => Jurado::className(), 'targetAttribute' => ['idjurado' => 'idjurado']],
            [['idjurado2'], 'exist', 'skipOnError' => true, 'targetClass' => Jurado::className(), 'targetAttribute' => ['idjurado2' => 'idjurado']],
            [['idproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['idproyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjurado' => 'Jurado',
            'idproyecto' => 'Proyecto',
            'idjurado2' => 'Jurado 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdjurado0()
    {
        return $this->hasOne(Jurado::className(), ['idjurado' => 'idjurado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdjurado20()
    {
        return $this->hasOne(Jurado::className(), ['idjurado' => 'idjurado2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdproyecto0()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'idproyecto']);
    }
}
