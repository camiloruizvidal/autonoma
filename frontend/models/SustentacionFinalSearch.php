<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SustentacionFinal;

/**
 * SustentacionFinalSearch represents the model behind the search form about `frontend\models\SustentacionFinal`.
 */
class SustentacionFinalSearch extends SustentacionFinal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsustentacion_final'], 'integer'],
            [['fecha', 'idproyecto', 'lugar'], 'safe'],
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
        $query = SustentacionFinal::find();
        if (Yii::$app->user->can('Estudiante')) {
          $query = SustentacionFinal::find()->joinWith([
            'idproyecto0' => function ($query) {
                $query->andWhere(['id' => Yii::$app->user->id]);
            },
        ])->with(['idproyecto0']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('idproyecto0');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idsustentacion_final' => $this->idsustentacion_final,
            'fecha' => $this->fecha,
            'lugar' => $this->lugar,

        ]);
          $query->andFilterWhere(['like', 'proyecto.nombre', $this->idproyecto]);

        return $dataProvider;
    }
}
