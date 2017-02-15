<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public $searchstring;
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['company_name', 'company_email', 'company_address', 'company_profile', 'company_created', 'company_status'], 'safe'],
            [['searchstring'], 'safe'],
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

    public function count(){
        $count = (new \yii\db\Query())->from('company')->count();
        return $count;
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
        $query = Company::find();

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
        // $query->andFilterWhere([
        //     'company_id' => $this->company_id,
        //     'company_created' => $this->company_created,
        // ]);

        $query->orFilterWhere(['like', 'company_name', $this->searchstring])
            ->orFilterWhere(['like', 'company_email', $this->searchstring])
            ->orFilterWhere(['like', 'company_address', $this->searchstring])
            ->orFilterWhere(['like', 'company_profile', $this->searchstring])
            ->orFilterWhere(['like', 'company_status', $this->searchstring])
            ->orFilterWhere(['like', 'company_id', $this->searchstring])
            ->orFilterWhere(['like', 'company_created', $this->searchstring]);

        return $dataProvider;
    }
}
