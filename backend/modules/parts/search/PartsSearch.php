<?php

namespace backend\modules\parts\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Parts;

/**
 * PartsSearch represents the model behind the search form about `common\models\Parts`.
 */
class PartsSearch extends Parts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['part_id', 'parent_id'], 'integer'],
            [['desc'], 'safe'],
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
        $query = Parts::find();

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
            'part_id' => $this->part_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
