<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nombres;
    public $apellidos;
    public $cedula;
    public $telefono;
    public $pregunta;
    public $respuesta;
    public $genero;
    public $email;
    public $password;
    public $confirmpassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message' => 'Este campo es obligatorio.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El nombre de usuario ya está tomado.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['nombres', 'trim'],
            ['nombres', 'required', 'message' => 'Este campo es obligatorio.'],
            ['nombres', 'string', 'min' => 2, 'max' => 100],

            ['apellidos', 'trim'],
            ['apellidos', 'required', 'message' => 'Este campo es obligatorio.'],
            ['apellidos', 'string', 'min' => 2, 'max' => 100],

            ['cedula', 'trim'],
            ['cedula', 'required', 'message' => 'Este campo es obligatorio.'],
            ['cedula', 'unique', 'targetClass' => '\common\models\User', 'message' => 'La cédula ya existe.'],
            ['cedula', 'string', 'min' => 10, 'max' => 10],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Este campo es obligatorio.'],
            ['email', 'email', 'message' => 'Ingrese un correo válido.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El correo ingresado ya existe.'],

            ['password', 'required', 'message' => 'Este campo es obligatorio.'],
            ['password', 'string', 'min' => 6, 'message' => 'Debe ingresar mínimo 6 caracteres.'],

            ['confirmpassword', 'required', 'message' => 'Este campo es obligatorio.'],

            ['pregunta', 'string', 'min' => 1, 'max' => 255],
            ['pregunta', 'required', 'message' => 'Este campo es obligatorio.'],

            ['respuesta', 'string', 'min' => 2, 'max' => 255],
            ['respuesta', 'required', 'message' => 'Este campo es obligatorio.'],

            ['genero', 'string', 'min' => 1, 'max' => 255],
            ['genero', 'required', 'message' => 'Este campo es obligatorio.'],


            ['telefono', 'string', 'min' => 9, 'max' => 10],
            ['telefono', 'required', 'message' => 'Este campo es obligatorio.'],
            

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'email' => 'Correo',
            'nombres' => 'Nombres Completos',
            'apellidos' => 'Apellidos',
            'cedula' => 'Cédula',
            'password' => 'Contraseña',
        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->email;
        $user->nombres = $this->nombres;
        $user->apellidos = $this->apellidos;
        $user->cedula = $this->cedula;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //var_dump($user);
        if ($user->save()) {
            return $user;
        }else{
            return null;
        }
        //return $user->save() ? $user : null;
    }
}
