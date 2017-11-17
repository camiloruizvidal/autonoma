<?php

namespace frontend\models;

use Yii;

class Documento extends \yii\db\ActiveRecord
{

    public $file;

    public static function tableName()
    {
        return 'documento';
    }

    public function rules()
    {
        return [
            [['nombre', 'archivo', 'id_documento_tipo'], 'required', 'message' => 'Campo Requerido'],
            [['nombre', 'archivo', 'id_documento_tipo'], 'string', 'max' => 100],
            [['file'], 'file', 'extensions' => 'doc, pdf, docx', 'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'iddocumento'       => 'Iddocumento',
            'nombre'            => 'Nombre',
            'id_documento_tipo' => 'Tipo de documento',
            'archivo'           => 'Archivo',
            'file'              => 'Archivo',
        ];
    }

}
