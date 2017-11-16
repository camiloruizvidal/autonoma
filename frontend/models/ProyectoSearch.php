<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `frontend\models\Proyecto`.
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
            [['nombre','id', 'descripcion', 'archivo_proyecto', 'date_create', 'articulo', 'jurado1', 'jurado2'], 'safe'],
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
      $query = Proyecto::find()->select(['a.nombre AS jurado1', 'proyecto.*', 'b.nombre AS jurado2' ])
              ->joinWith([
                'juradoHasProyectos' => function ($query) {
                    $query->joinWith(['idjurado0 a'])
                      ->joinWith('idjurado20 b');
            // var_dump($query);
            // exit();
          }])->with(['juradoHasProyectos']);
          if (Yii::$app->user->can('Jurado')) {
          $query = Proyecto::find()->select(['a.nombre AS jurado1', 'proyecto.*', 'b.nombre AS jurado2' ])
          ->joinWith([
            'juradoHasProyectos' => function ($query) {
                $query->joinWith(['idjurado0 a'])
                  ->joinWith('idjurado20 b');
        // var_dump($query);
        // exit();
      }])->with(['juradoHasProyectos'])->Where(['proyecto.estado' => 1])->orderBy('proyecto.date_create DESC');
          }
        if (Yii::$app->user->can('Estudiante')) {
        $query = Proyecto::find()->select(['a.nombre AS jurado1', 'proyecto.*', 'b.nombre AS jurado2' ])
        ->joinWith([
          'juradoHasProyectos' => function ($query) {
              $query->joinWith(['idjurado0 a'])
                ->joinWith('idjurado20 b');
      // var_dump($query);
      // exit();
    }])->with(['juradoHasProyectos'])
    ->joinWith([
          'iddirectorProyectos' => function ($query) {
            //  $query->andWhere(['id' => Yii::$app->user->id])
                    ;
          },
      ])->with(['iddirectorProyectos'])->Where(['proyecto.id' => Yii::$app->user->id]);
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

          $query->joinWith('id0')->all();

        // grid filtering conditions
        $query->andFilterWhere([
            'idproyecto' => $this->idproyecto,
            'date_create' => $this->date_create,


        ]);

        $query->andFilterWhere(['like', 'proyecto.nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'archivo_proyecto', $this->archivo_proyecto])
            ->andFilterWhere(['like', 'articulo', $this->articulo])
              ->andFilterWhere(['like', 'user.nombre', $this->id])
              ->andFilterWhere(['like', 'jurado.nombre', $this->jurado1])
              ;

        return $dataProvider;
    }
}
