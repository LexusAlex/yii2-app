<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Record;

/**
 * RecordSearch represents the model behind the search form about `backend\models\Record`.
 */
class RecordSearch extends Record
{
    // переопределили ролительский метод
    public function behaviors()
    {
        return [

        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'user_id', 'status'], 'integer'],
            [['title', 'slug', 'preview', 'content', 'created_at', 'updated_at'], 'safe'],
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
        //$query = Record::find();
        $query = Record::find()->with(['category','tagArticles'])->orderBy('id DESC');
        //$query = Record::find()->joinWith(['category','user']);
        //$query = Record::find()->joinWith(['category']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ // постраничная разбивка
                'pageSize' => 10,
            ],
        ]);

        /*$dataProvider->sort->attributes['category'] = [
            // Это те таблицы, с которыми у нас установлена связь
            // в моем случае у них есть префикс tbl_
            'asc' => ['category.title' => SORT_ASC],
            'desc' => ['category.title' => SORT_DESC],
        ];*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        // для строк
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'content', $this->content]);
            //->andFilterWhere(['like', 'category.title', $this->category]);

        return $dataProvider;
    }
}
