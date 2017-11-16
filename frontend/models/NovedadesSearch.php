<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Novedades;

/**
 * NovedadesSearch represents the model behind the search form about `frontend\models\Novedades`.
 */
class NovedadesSearch extends Novedades
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnovedades', 'idproyecto'], 'integer'],
            [['descripcion', 'fecha'], 'safe'],
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
        $query = Novedades::find();
        if (Yii::$app->user->can('Estudiante')) {
        $query = Novedades::find()->joinWith([
          'idproyecto0' => function ($query) {
              $query->andWhere(['id' => Yii::$app->user->id])
                    ;
          },
      ])->with(['idproyecto0']);
      // var_dump($query);
      // exit();
    }

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
            'idnovedades' => $this->idnovedades,
            'fecha' => $this->fecha,
            'idproyecto' => $this->idproyecto,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
