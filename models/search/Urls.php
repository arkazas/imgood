<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Urls as UrlsModel;

/**
 * Urls represents the model behind the search form about `app\models\Urls`.
 */
class Urls extends UrlsModel
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['url_name', 'parent_url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UrlsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'url_name', $this->url_name])
            ->andFilterWhere(['like', 'parent_url', $this->parent_url]);

        return $dataProvider;
    }
}
