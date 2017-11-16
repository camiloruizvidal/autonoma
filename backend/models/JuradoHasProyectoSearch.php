<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JuradoHasProyecto;

/**
 * JuradoHasProyectoSearch represents the model behind the search form about `backend\models\JuradoHasProyecto`.
 */
class JuradoHasProyectoSearch extends JuradoHasProyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjurado', 'idproyecto', 'idjurado2'], 'safe'],
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
        $query = JuradoHasProyecto::find();

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
          $query->joinWith('idproyecto0'); // gridview searching  cap 11
          $query->joinWith('idjurado0'); // gridview searching  cap 11
          $query->joinWith([
    'idjurado20' => function ($query) {
        /* @var $query \yii\db\ActiveQuery */

        $query->from(Jurado::tableName() . ' u2');
        // or $query->from(['u2' => User::tableName()]);
    },
]);

        // grid filtering conditions
        $query->andFilterWhere([

        ]);

        $query->andFilterWhere(['like', 'proyecto.nombre', $this->idproyecto])
          ->andFilterWhere(['like', 'jurado.nombre', $this->idjurado])
          ->andFilterWhere(['like', 'u2.nombre', $this->idjurado2]);

        return $dataProvider;
    }
}
