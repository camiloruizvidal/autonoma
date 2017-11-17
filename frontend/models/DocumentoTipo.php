<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "documento_tipo".
 *
 * @property integer $id_documento_tipo
 * @property string $descripcion
 *
 * @property Documento[] $documentos
 */
class DocumentoTipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documento_tipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_documento_tipo' => 'Id Documento Tipo',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentos()
    {
        return $this->hasMany(Documento::className(), ['id_documento_tipo' => 'id_documento_tipo']);
    }
}
