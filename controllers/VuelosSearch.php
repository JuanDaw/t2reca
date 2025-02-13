<?php

namespace app\controllers;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vuelos;

/**
 * VuelosSearch represents the model behind the search form of `app\models\Vuelos`.
 */
class VuelosSearch extends Vuelos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'origen_id', 'destino_id', 'plazas'], 'integer'],
            [['salida', 'llegada'], 'safe'],
            [['precio'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vuelos::find()
            ->where('salida > LOCALTIMESTAMP');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'origen_id' => $this->origen_id,
            'destino_id' => $this->destino_id,
            'salida' => $this->salida,
            'llegada' => $this->llegada,
            'plazas' => $this->plazas,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }
}
