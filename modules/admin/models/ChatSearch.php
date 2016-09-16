<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chat;

/**
 * ChatSearch represents the model behind the search form about `app\models\Chat`.
 */
class ChatSearch extends Chat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chat_id', 'ctime', 'last_time', 'last_msg'], 'safe'],
            [['uid', 'doctor_id'], 'integer'],
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
        $query = Chat::find();

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
            'doctor_id' => $this->doctor_id,
            'ctime' => $this->ctime,
            'last_time' => $this->last_time,
        ]);

        $query->andFilterWhere(['like', 'chat_id', $this->chat_id])
            ->andFilterWhere(['like', 'last_msg', $this->last_msg]);

        $query->orderBy(['last_time' => SORT_DESC]);

        return $dataProvider;
    }
}
