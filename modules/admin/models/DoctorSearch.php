<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Doctor;

/**
 * DoctorSearch represents the model behind the search form about `app\models\Doctor`.
 */
class DoctorSearch extends Doctor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            [['cover', 'education', 'school', 'title', 'company', 'intro', 'status', 'name'], 'safe'],
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
        $query = Doctor::find();

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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cover', $this->cover])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'name', $this->name]);

        $query->orderBy(['sort' => SORT_DESC]);

        return $dataProvider;
    }
}
