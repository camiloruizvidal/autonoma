<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $codigo_estudiantil
 * @property string $facultad
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Anteproyecto[] $anteproyectos
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'codigo_estudiantil', 'facultad', 'username', 'auth_key', 'password_hash', 'email', 'status', 'created_at', 'updated_at'], 'required', 'message' => 'Campo Requerido'],
            [['facultad'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'apellido', 'codigo_estudiantil', 'status'], 'string', 'max' => 100],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'codigo_estudiantil' => 'Codigo Estudiantil',
            'facultad' => 'Facultad',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnteproyectos()
    {
        return $this->hasMany(Anteproyecto::className(), ['id' => 'id']);
    }
}
