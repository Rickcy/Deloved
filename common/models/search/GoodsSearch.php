<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `common\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'availability', 'rating_count', 'rating_good', 'condition_id', 'payment_methods_id', 'delivery_methods_id', 'account_id', 'category_type_id', 'category_id', 'date_created', 'show_main', 'photo_id', 'measure_id', 'currency_id'], 'integer'],
            [['name', 'model', 'description'], 'safe'],
            [['price'], 'number'],
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
        $query = Goods::find();

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
            'price' => $this->price,
            'availability' => $this->availability,
            'rating_count' => $this->rating_count,
            'rating_good' => $this->rating_good,
            'condition_id' => $this->condition_id,
            'payment_methods_id' => $this->payment_methods_id,
            'delivery_methods_id' => $this->delivery_methods_id,
            'account_id' => $this->account_id,
            'category_type_id' => $this->category_type_id,
            'category_id' => $this->category_id,
            'date_created' => $this->date_created,
            'show_main' => $this->show_main,
            'photo_id' => $this->photo_id,
            'measure_id' => $this->measure_id,
            'currency_id' => $this->currency_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
