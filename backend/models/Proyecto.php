<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $idproyecto
 * @property string $nombre
 * @property string $descripcion
 * @property string $archivo_proyecto
 * @property string $date_create
 * @property integer $id
 *
 * @property DirectorProyectoPorProyecto[] $directorProyectoPorProyectos
 * @property DirectorProyecto[] $iddirectorProyectos
 * @property JuradoHasProyecto[] $juradoHasProyectos
 * @property Novedades[] $novedades
 * @property User $id0
 * @property Revisonp[] $revisonps
 * @property SustentacionFinal[] $sustentacionFinals
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     public $Estudiante;
     public $file;
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'archivo_proyecto', 'id'], 'required', 'message' => 'Campo Requerido'],
            [['date_create'], 'safe'],
            [['id'], 'integer'],
            [['file'], 'file', 'extensions' => 'doc, txt', 'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}'],
            [['nombre', 'descripcion', 'archivo_proyecto'], 'string', 'max' => 45],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto' => 'Idproyecto',
            'nombre' => 'Titulo',
            'descripcion' => 'Descripcion',
            'archivo_proyecto' => 'Archivo Proyecto',
            'date_create' => 'Fecha de Creacion',
            'file' => 'archivo',
            'id' => 'Estudiante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirectorProyectoPorProyectos()
    {
        return $this->hasMany(DirectorProyectoPorProyecto::className(), ['idproyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIddirectorProyectos()
    {
        return $this->hasMany(DirectorProyecto::className(), ['iddirector_proyecto' => 'iddirector_proyecto'])->viaTable('director_proyecto_por_proyecto', ['idproyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJuradoHasProyectos()
    {
        return $this->hasMany(JuradoHasProyecto::className(), ['idproyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNovedades()
    {
        return $this->hasMany(Novedades::className(), ['idproyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRevisonps()
    {
        return $this->hasMany(Revisonp::className(), ['idproyecto' => 'idproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSustentacionFinals()
    {
        return $this->hasMany(SustentacionFinal::className(), ['idproyecto' => 'idproyecto']);
    }
}
