<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "revisonp".
 *
 * @property integer $idrevisonp
 * @property string $descripcion
 * @property string $correcion
 * @property string $archivo
 * @property string $estado
 * @property integer $idproyecto
 *
 * @property Proyecto $idproyecto0
 */
class Revisonp extends \yii\db\ActiveRecord
{
  public $file1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revisonp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['correcion', 'archivo', 'estado', 'idproyecto'], 'required', 'message' => 'Campo Requerido'],
            [['estado'], 'string'],
            [[ 'file1'], 'file'],
            [['idproyecto', 'num_revisiones'], 'integer'],
            [['descripcion', 'correccion', 'archivo'], 'string', 'max' => 45],
            [['idproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['idproyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrevisonp' => 'Idrevisonp',
            'descripcion' => 'Descripcion',
            'correccion' => 'Correccion',
            'archivo' => 'Archivo',
            'estado' => 'Estado',
            'idproyecto' => 'Proyecto',
            'file1' => 'Archivo',
            'num_revisiones' => 'Nº revisiones'
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
