<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'gender', 'age', 'id_type', 'relation', 'status'], 'integer'],
            [['phone', 'password', 'name', 'icon', 'id_number', 'email', 'address', 'profession', 'relative_name',
                'relative_contact', 'ctime', 'remark'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'uid' => $this->uid,
            'gender' => $this->gender,
            'age' => $this->age,
            'id_type' => $this->id_type,
            'relation' => $this->relation,
            'status' => $this->status,
            'ctime' => $this->ctime,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'id_number', $this->id_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'profession', $this->profession])
            ->andFilterWhere(['like', 'relative_name', $this->relative_name])
            ->andFilterWhere(['like', 'relative_contact', $this->relative_contact]);

        return $dataProvider;
    }
}
