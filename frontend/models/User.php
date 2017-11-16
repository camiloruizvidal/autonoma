<?php

namespace frontend\models;

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
  public $Estudiante;
  public $Apellido;
  public $Proyecto;
  public $Anteproyecto;
  public $Estado;
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
            [['created_at', 'updated_at', 'cont'], 'safe'],
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
            'id' => 'Rol',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'codigo_estudiantil' => 'Identificación',
            'facultad' => 'Facultad',
            'username' => 'Nombre de usuario',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Estado',
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
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }
}
