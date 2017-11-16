<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Anteproyecto;

/**
 * AnteproyectoSearch represents the model behind the search form about `backend\models\Anteproyecto`.
 */
class AnteproyectoSearch extends Anteproyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idanteproyecto'], 'integer'],
            [['nombre', 'id', 'descripcion', 'date_create' ,'idmodalidad', 'archivo_anteproyecto'], 'safe'],
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
        $query = Anteproyecto::find();

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

        $query->joinWith('idmodalidad0'); // gridview searching  cap 11
          $query->joinWith('id0');
        // grid filtering conditions
        $query->andFilterWhere([
            'idanteproyecto' => $this->idanteproyecto,
            

        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'archivo_anteproyecto', $this->archivo_anteproyecto])
            ->andFilterWhere(['like', 'modalidad.nombre', $this->idmodalidad])
            ->andFilterWhere(['like', 'user.username', $this->id]);;

        return $dataProvider;
    }
}
