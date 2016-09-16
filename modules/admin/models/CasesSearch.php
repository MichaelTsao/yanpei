<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cases;

/**
 * CasesSearch represents the model behind the search form about `app\models\Cases`.
 */
class CasesSearch extends Cases
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['case_id', 'uid', 'doctor_id', 'deaf_side', 'weared', 'weared_side', 'aid_type', 'effect', 'er_ming', 'xuan_yun', 'er_tong', 'fen_mi_wu', 'operation_history', 'zao_yin', 'wai_shang', 'use_medicine', 'left_er_kuo', 'right_er_kuo', 'left_er_dao', 'right_er_dao', 'left_gu_mo', 'right_gu_mo', 'left_ru_tu', 'right_ru_tu'], 'integer'],
            [['deaf_date', 'can_listen', 'hard_case', 'treat_result', 'left_type', 'right_type', 'family_history', 'person_history', 'ill_condition', 'cure_condition', 'toxic', 'medicine', 'allergy', 'kan_hua', 'intelligent', 'mental', 'remark', 'left_ce_ting', 'right_ce_ting', 'ctime'], 'safe'],
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
        $query = Cases::find();

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
            'case_id' => $this->case_id,
            'uid' => $this->uid,
            'doctor_id' => $this->doctor_id,
            'deaf_date' => $this->deaf_date,
            'deaf_side' => $this->deaf_side,
            'weared' => $this->weared,
            'weared_side' => $this->weared_side,
            'aid_type' => $this->aid_type,
            'effect' => $this->effect,
            'er_ming' => $this->er_ming,
            'xuan_yun' => $this->xuan_yun,
            'er_tong' => $this->er_tong,
            'fen_mi_wu' => $this->fen_mi_wu,
            'operation_history' => $this->operation_history,
            'zao_yin' => $this->zao_yin,
            'wai_shang' => $this->wai_shang,
            'use_medicine' => $this->use_medicine,
            'left_er_kuo' => $this->left_er_kuo,
            'right_er_kuo' => $this->right_er_kuo,
            'left_er_dao' => $this->left_er_dao,
            'right_er_dao' => $this->right_er_dao,
            'left_gu_mo' => $this->left_gu_mo,
            'right_gu_mo' => $this->right_gu_mo,
            'left_ru_tu' => $this->left_ru_tu,
            'right_ru_tu' => $this->right_ru_tu,
            'ctime' => $this->ctime,
        ]);

        $query->andFilterWhere(['like', 'can_listen', $this->can_listen])
            ->andFilterWhere(['like', 'hard_case', $this->hard_case])
            ->andFilterWhere(['like', 'treat_result', $this->treat_result])
            ->andFilterWhere(['like', 'left_type', $this->left_type])
            ->andFilterWhere(['like', 'right_type', $this->right_type])
            ->andFilterWhere(['like', 'family_history', $this->family_history])
            ->andFilterWhere(['like', 'person_history', $this->person_history])
            ->andFilterWhere(['like', 'ill_condition', $this->ill_condition])
            ->andFilterWhere(['like', 'cure_condition', $this->cure_condition])
            ->andFilterWhere(['like', 'toxic', $this->toxic])
            ->andFilterWhere(['like', 'medicine', $this->medicine])
            ->andFilterWhere(['like', 'allergy', $this->allergy])
            ->andFilterWhere(['like', 'kan_hua', $this->kan_hua])
            ->andFilterWhere(['like', 'intelligent', $this->intelligent])
            ->andFilterWhere(['like', 'mental', $this->mental])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'left_ce_ting', $this->left_ce_ting])
            ->andFilterWhere(['like', 'right_ce_ting', $this->right_ce_ting]);

        return $dataProvider;
    }
}
