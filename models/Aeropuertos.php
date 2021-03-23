<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aeropuertos".
 *
 * @property int $id
 * @property string $codigo
 * @property string|null $denominacion
 *
 * @property Vuelos[] $vuelosOrigen
 * @property Vuelos[] $vuelosDestino
 */
class Aeropuertos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aeropuertos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'required'],
            [['codigo'], 'string', 'length' => 3],
            [['codigo'], 'match', 'pattern' => '/^[A-Z]{3}$/'],
            [['codigo'], 'unique'],
            [['denominacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Codigo',
            'denominacion' => 'Denominacion',
        ];
    }

    /**
     * Gets query for [[Vuelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVuelosOrigen()
    {
        return $this->hasMany(Vuelos::class, ['origen_id' => 'id'])
            ->inverseOf('origen');
    }

    /**
     * Gets query for [[Vuelos0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVuelosDestino()
    {
        return $this->hasMany(Vuelos::class, ['destino_id' => 'id'])
            ->inverseOf('destino');
    }
}
