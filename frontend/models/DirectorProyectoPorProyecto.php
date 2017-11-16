<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "director_proyecto_por_proyecto".
 *
 * @property integer $iddirector_proyecto
 * @property integer $idproyecto
 *
 * @property DirectorProyecto $iddirectorProyecto
 * @property Proyecto $idproyecto0
 */
class DirectorProyectoPorProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $Proyecto;
     public $Director;
     public $Fecha;
     public $cantida_de_proyecto;

    public static function tableName()
    {
        return 'director_proyecto_por_proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iddirector_proyecto', 'idproyecto'], 'required', 'message' => 'Campo Requerido'],
            [['iddirector_proyecto', 'idproyecto'], 'integer'],
            [['fecha'], 'safe'],
            [['iddirector_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => DirectorProyecto::className(), 'targetAttribute' => ['iddirector_proyecto' => 'iddirector_proyecto']],
            [['idproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['idproyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddirector_proyecto' => 'Director de Proyecto',
            'idproyecto' => 'Proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIddirectorProyecto()
    {
        return $this->hasOne(DirectorProyecto::className(), ['iddirector_proyecto' => 'iddirector_proyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdproyecto0()
    {
        return $this->hasOne(Proyecto::className(), ['idproyecto' => 'idproyecto']);
    }
}
