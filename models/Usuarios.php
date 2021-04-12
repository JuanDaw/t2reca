<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 *
 * @property Reservas[] $reservas
 * @property Vuelos[] $vuelos
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface 
// para poder loguearse se tienen que implemetar la interfaz IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'password'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
            [['password'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reservas::class, ['usuario_id' => 'id'])
            ->inverseOf('usuario');
    }

    /**
     * Gets query for [[Vuelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVuelos()
    {
        return $this->hasMany(Vuelos::class, ['id' => 'vuelo_id'])
            ->viaTable('reservas', ['usuario_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // vacio porque no tenemos accesstoken
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // al no tener authkey no se puede hacer el logueado automatico
    }

    public function validateAuthKey($authKey)
    {
        // vacio porque no tenemos authkey
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
        // el componente de aplicacion security se encarga de validar contraseñas pasandole la 
        // contraseña introducida y la contraseña cifrada 
    }
}
