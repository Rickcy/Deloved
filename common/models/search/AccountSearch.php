<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Account;

/**
 * AccountSearch represents the model behind the search form about `common\models\Account`.
 */
class AccountSearch extends Account
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'org_form_id', 'date_reg', 'city_id', 'public_status', 'verify_status', 'rating', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'phone2', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords'], 'safe'],
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
        $query = Account::find();

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
            'org_form_id' => $this->org_form_id,
            'date_reg' => $this->date_reg,
            'city_id' => $this->city_id,
            'public_status' => $this->public_status,
            'verify_status' => $this->verify_status,
            'rating' => $this->rating,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'brand_name', $this->brand_name])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'legal_address', $this->legal_address])
            ->andFilterWhere(['like', 'phone1', $this->phone1])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'web_address', $this->web_address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'work_time', $this->work_time])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'keywords', $this->keywords]);

        return $dataProvider;
    }
}
