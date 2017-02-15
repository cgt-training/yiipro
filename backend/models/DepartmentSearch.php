<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Department;

/**
 * DepartmentSearch represents the model behind the search form about `app\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * @inheritdoc
     */
    public $searchstring;
    public function rules()
    {
        return [
            [['department_id', 'company_fk_id', 'branch_fk_id'], 'integer'],
            [['department_name', 'department_created', 'department_status'], 'safe'],
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
        $count = (new \yii\db\Query())->from('department')->count();
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
        $query = Department::find();

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
        //     'department_id' => $this->department_id,
        //     'company_fk_id' => $this->company_fk_id,
        //     'branch_fk_id' => $this->branch_fk_id,
        //     'department_created' => $this->department_created,
        // ]);

        // $query->andFilterWhere(['like', 'department_name', $this->department_name])
        //     ->andFilterWhere(['like', 'department_status', $this->department_status]);

        $query->orFilterWhere(['like', 'department_id', $this->searchstring])
            ->orFilterWhere(['like', 'company_fk_id', $this->searchstring])
            ->orFilterWhere(['like', 'branch_fk_id', $this->searchstring])
            ->orFilterWhere(['like', 'department_created', $this->searchstring])
            ->orFilterWhere(['like', 'department_name', $this->searchstring])
            ->orFilterWhere(['like', 'department_status', $this->searchstring]);

        return $dataProvider;
    }
}
