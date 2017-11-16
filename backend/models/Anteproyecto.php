<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "anteproyecto".
 *
 * @property integer $idanteproyecto
 * @property string $nombre
 * @property string $descripcion
 * @property string $archivo_anteproyecto
 * @property integer $idmodalidad
 * @property integer $id
  * @property integer $estado
 *
 * @property Modalidad $idmodalidad0
 * @property User $id0
 * @property Proyecto[] $proyectos
 * @property Revision[] $revisions
 */
class Anteproyecto extends \yii\db\ActiveRecord
{
    public $file;
    public $Modalidad;
    public $Estudiante;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anteproyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'archivo_anteproyecto', 'idmodalidad', 'id', 'date_create'], 'required', 'message' => 'Campo Requerido'],
            [['idmodalidad', 'id', 'estado'], 'integer'],
            [['date_create'], 'safe'],
            [['file'], 'file', 'extensions' => 'doc, txt, docx', 'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}'],
            [['nombre', 'descripcion', 'archivo_anteproyecto'], 'string', 'max' => 45],
            [['idmodalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Modalidad::className(), 'targetAttribute' => ['idmodalidad' => 'idmodalidad']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idanteproyecto' => 'Idanteproyecto',
            'nombre' => 'Titulo',
            'descripcion' => 'Descripcion',
            'archivo_anteproyecto' => 'Archivo Anteproyecto',
            'idmodalidad' => 'Modalidad',
            'id' => 'Estudiante',
            'file' => 'Archivo',
            'date_create' => 'Fecha de Creacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdmodalidad0()
    {
        return $this->hasOne(Modalidad::className(), ['idmodalidad' => 'idmodalidad']);
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
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['idanteproyecto' => 'idanteproyecto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRevisions()
    {
        return $this->hasMany(Revision::className(), ['idanteproyecto' => 'idanteproyecto']);
    }
}
