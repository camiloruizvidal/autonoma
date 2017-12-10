<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "revision".
 *
 * @property integer $idrevision
 * @property string $descripcion
 * @property string $correccion
 * @property string $archivo
 * @property string $estado
 * @property integer $idanteproyecto
 *
 * @property Anteproyecto $idanteproyecto0
 */
class Revision extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'revision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['correccion', 'archivo', 'estado', 'idanteproyecto'], 'required', 'message' => 'Campo Requerido'],
            [['estado'], 'string'],
            [['date_create'], 'safe'],
            [['file'], 'file'],
            [['idanteproyecto', 'num_revisiones'], 'integer'],
            [['descripcion', 'correccion', 'archivo'], 'string', 'max' => 200],
            [['idanteproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Anteproyecto::className(), 'targetAttribute' => ['idanteproyecto' => 'idanteproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comite'      => 'id_comite',
            'idrevision'     => 'Idrevision',
            'descripcion'    => 'Descripcion',
            'correccion'     => 'Correccion',
            'archivo'        => 'Archivo',
            'estado'         => 'Estado',
            'num_revisiones' => 'Nº de revisiones',
            'idanteproyecto' => 'Anteproyecto',
            'date_create'    => 'Fecha de Concepto',
            'file'           => 'Archivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdanteproyecto0()
    {
        return $this->hasOne(Anteproyecto::className(), ['idanteproyecto' => 'idanteproyecto']);
    }

}
