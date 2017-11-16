<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `backend\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproyecto'], 'integer'],
            [['nombre','id', 'descripcion', 'archivo_proyecto', 'date_create'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Proyecto::find();

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

          $query->joinWith('id0');
        // grid filtering conditions
        $query->andFilterWhere([
            'idproyecto' => $this->idproyecto,
            'date_create' => $this->date_create,

        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'archivo_proyecto', $this->archivo_proyecto])
              ->andFilterWhere(['like', 'user.username', $this->id]);;

        return $dataProvider;
    }
}
