<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property integer $iddocumento
 * @property string $nombre
 * @property string $archivo
 */
class Documento extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public $file;

    public static function tableName()
    {
        return 'documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'archivo', 'id_documento_tipo'], 'required'],
            [['nombre', 'archivo', 'id_documento_tipo'], 'string', 'max' => 100],
            [['file'], 'file', 'extensions' => 'doc, pdf, docx', 'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddocumento'       => 'Iddocumento',
            'nombre'            => 'Nombre',
            'archivo'           => 'Archivo',
            'file'              => 'Archivo',
            'id_documento_tipo' => 'documentotipo'
        ];
    }

}
