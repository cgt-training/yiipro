<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public $searchstring;
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['role', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
        $query = User::find();

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
        //     'id' => $this->id,
        //     'status' => $this->status,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);

        $query->orFilterWhere(['like', 'role', $this->searchstring])
            ->orFilterWhere(['like', 'username', $this->searchstring])
            ->orFilterWhere(['like', 'auth_key', $this->searchstring])
            ->orFilterWhere(['like', 'password_hash', $this->searchstring])
            ->orFilterWhere(['like', 'password_reset_token', $this->searchstring])
            ->orFilterWhere(['like', 'email', $this->searchstring])
            ->orFilterWhere(['like', 'id', $this->searchstring])
            ->orFilterWhere(['like', 'status', $this->searchstring])
            ->orFilterWhere(['like', 'created_at', $this->searchstring])
            ->orFilterWhere(['like', 'updated_at', $this->searchstring]);

        return $dataProvider;
    }
}
