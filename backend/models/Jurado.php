<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jurado".
 *
 * @property integer $idjurado
 * @property string $nombre
 *
 * @property JuradoHasProyecto[] $juradoHasProyectos
 * @property Proyecto[] $idanteproyectos
 */
class Jurado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurado';
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
            'idjurado' => 'Idjurado',
            'nombre' => 'Nombre de jurado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJuradoHasProyectos()
    {
        return $this->hasMany(JuradoHasProyecto::className(), ['idjurado' => 'idjurado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdanteproyectos()
    {
        return $this->hasMany(Proyecto::className(), ['idanteproyecto' => 'idanteproyecto'])->viaTable('jurado_has_proyecto', ['idjurado' => 'idjurado']);
    }
}
