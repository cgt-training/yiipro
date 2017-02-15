<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Branch;

/**
 * BranchSearch represents the model behind the search form about `app\models\Branch`.
 */
class BranchSearch extends Branch
{
    /**
     * @inheritdoc
     */
    public $searchstring;
    public function rules()
    {
        return [
            [['branch_id'], 'integer'],
            [['branch_name', 'branch_created', 'branch_status', 'company_fk_id'], 'safe'],
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
        $count = (new \yii\db\Query())->from('branch')->count();
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
        $query = Branch::find();

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
        $query->joinWith('companyFk');

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'branch_id' => $this->branch_id,
        //    // 'company_fk_id' => $this->company_fk_id,
        //     'branch_created' => $this->branch_created,
        // ]);

        // $query->andFilterWhere(['like', 'branch_name', $this->branch_name])
        //     ->andFilterWhere(['like', 'branch_status', $this->branch_status])
        //     ->andFilterWhere(['like', 'company.company_name', $this->company_fk_id]);

        $query->orFilterWhere(['like', 'branch_id', $this->searchstring])
            ->orFilterWhere(['like', 'branch_created', $this->searchstring])
            ->orFilterWhere(['like', 'branch_name', $this->searchstring])
            ->orFilterWhere(['like', 'branch_status', $this->searchstring])
            ->orFilterWhere(['like', 'company.company_name', $this->searchstring]);
         
         return $dataProvider;
    }
}
