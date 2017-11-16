<?php
namespace frontend\models;

use yii\base\Model;
use frontend\models\AuthAssignment;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nombre;
    public $apellido;
    public $codigo_estudiantil;
    public $facultad;
    public $username;
    public $email;
    public $password;
    public $permissions;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['nombre', 'trim'],
            [['nombre', 'apellido', 'facultad' ], 'required', 'message' => 'Campo requerido'],
            [['nombre', 'apellido'], 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Mínimo 3 y máximo 50 caracteres'],
            [['nombre', 'apellido'], 'match', 'pattern' => "/^[a-z\s]+$/i", 'message' => 'Sólo se aceptan letras'],
            [['codigo_estudiantil'], 'integer'],
            [['facultad'], 'safe'],
            //['username', 'trim'],
            ['username', 'required',  'message' => 'Campo requerido'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este Nombre de usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            //['email', 'trim'],
            ['email', 'required',  'message' => 'Campo requerido'],
            ['email', 'email',  'message' => 'Email invalido'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este Email ya existe.'],

            ['password', 'required', 'message' => 'Campo requerido'],
            ['password', 'string', 'min' => 6, 'message' => 'minimo 6 caracteres'],
        ];
    }
    public function attributeLabels()
    {
        return [
          'codigo_estudiantil' => 'Identificacion',
          'facultad' => 'Programa',
          'username' => 'Nombre de Usuario',
          'password' => 'Contraseña',
          'permissions' => 'Rol'
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
          $user = new User();
          $user->nombre = $this->nombre;
          $user->apellido = $this->apellido;
          $user->codigo_estudiantil = $this->codigo_estudiantil;
          $user->facultad = $this->facultad;
          $user->username = $this->username;
          $user->email = $this->email;
          $user->setPassword($this->password);
          $user->generateAuthKey();
          $user->updated_at = date('Y-m-j');
          $user->save();


          // agregamos los permisos al usuario
          $permissionList = $_POST['SignupForm']['permissions'];
          foreach ($permissionList as $value)
          {
              $newPermission = new AuthAssignment;
              $newPermission->user_id = $user->id;
              $newPermission->item_name = $value;
              $newPermission->save();
          }
          return $user;
        }
        return null;

    }
}
