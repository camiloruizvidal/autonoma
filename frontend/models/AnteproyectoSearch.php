<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Anteproyecto;

/**
 * AnteproyectoSearch represents the model behind the search form about `frontend\models\Anteproyecto`.
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
        $query = Anteproyecto::find()->orderBy('anteproyecto.date_create DESC');
        if (Yii::$app->user->can('Estudiante')) {
        $query = Anteproyecto::find()->joinWith([
          'revisions' => function ($query) {
              // $query->andWhere()
                    ;
          },
      ])->with(['revisions'])->Where(['anteproyecto.id' => Yii::$app->user->id]);

    };
    if (Yii::$app->user->can('Comite')) {
    $query = Anteproyecto::find()->joinWith([
      'revisions' => function ($query) {
          // $query->andWhere()
                ;
      },
  ])->with(['revisions'])->Where(['anteproyecto.estado' => 1])->orderBy('anteproyecto.date_create DESC');

    }

      //   SELECT
  		//   anteproyecto.idanteproyecto, anteproyecto.nombre, anteproyecto.descripcion, anteproyecto.archivo_anteproyecto , modalidad.nombre
  		// FROM
  		//   anteproyecto
      //   INNER JOIN modalidad ON anteproyecto.idmodalidad = modalidad.idmodalidad
  		// WHERE
  		//  anteproyecto.estado = 1
      //    ORDER BY anteproyecto.date_create DESC

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
            ->andFilterWhere(['like', 'user.username', $this->id]);

        return $dataProvider;
    }
}
