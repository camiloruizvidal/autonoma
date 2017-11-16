<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "director_proyecto".
 *
 * @property integer $iddirector_proyecto
 * @property string $nombre
 *
 * @property Proyecto[] $proyectos
 */
class DirectorProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'director_proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required', 'message' => 'Campo Requerido'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddirector_proyecto' => 'Iddirector Proyecto',
            'nombre' => 'Director de grado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['iddirector_proyecto' => 'iddirector_proyecto']);
    }
}
