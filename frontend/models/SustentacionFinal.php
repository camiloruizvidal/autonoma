<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sustentacion_final".
 *
 * @property integer $idsustentacion_final
 * @property string $fecha
 * @property integer $idproyecto
 *
 * @property Proyecto $idproyecto0
 */
class SustentacionFinal extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sustentacion_final';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'idproyecto', 'lugar'], 'required', 'message' => 'Campo Requerido'],
            [['fecha', 'lugar'], 'safe'],
            [['idproyecto'], 'integer'],
            [['estados'], 'varchar'],
            [['idproyecto'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['idproyecto' => 'idproyecto']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsustentacion_final' => 'Idsustentacion Final',
            'fecha'                => 'Fecha',
            'idproyecto'           => 'Proyecto',
            'estados'              => 'estados'
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
