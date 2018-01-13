<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Revisonp;

/**
 * RevisionpSearch represents the model behind the search form about `frontend\models\Revisonp`.
 */
class RevisionpSearch extends Revisonp
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrevisonp', 'idproyecto', 'num_revisiones'], 'integer'],
            [['descripcion', 'correccion', 'archivo', 'estado'], 'safe'],
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
        $query = Revisonp::find();
        if (Yii::$app->user->can('Estudiante'))
        {
            $query = Revisonp::find()->where(['secretario_aprobado' => 'si'])->joinWith(['idproyecto0' => function ($query)
                        {
                            $query->andWhere(['id' => Yii::$app->user->id]);
                        },])->with(['idproyecto0']);
                }
                //echo '<pre>';var_dump($query);exit();
                // add conditions that should always apply here
                $dataProvider = new ActiveDataProvider(['query' => $query,]);

                $this->load($params);

                if (!$this->validate())
                {
                    // uncomment the following line if you do not want to return any records when validation fails
                    // $query->where('0=1');
                    return $dataProvider;
                }

                // grid filtering conditions
                $query->andFilterWhere([
                    'idrevisonp'     => $this->idrevisonp,
                    'idproyecto'     => $this->idproyecto,
                    'num_revisiones' => $this->num_revisiones,
                ]);

                $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
                        ->andFilterWhere(['like', 'correccion', $this->correccion])
                        ->andFilterWhere(['like', 'archivo', $this->archivo])
                        ->andFilterWhere(['like', 'estado', $this->estado]);

                return $dataProvider;
            }

        }
        