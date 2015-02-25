<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataType;

/**
 * DataTypeSearch represents the model behind the search form about `app\models\DataType`.
 */
class DataTypeSearch extends Model
{
	public $id;
	public $name;
	public $min;
	public $max;
	public $default;

	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['name', 'min', 'max', 'default'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'min' => 'Min',
			'max' => 'Max',
			'default' => 'Default',
		];
	}

	public function search($params)
	{
		$query = DataType::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$this->addCondition($query, 'id');
		$this->addCondition($query, 'name', true);
		$this->addCondition($query, 'min', true);
		$this->addCondition($query, 'max', true);
		$this->addCondition($query, 'default', true);
		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		if (($pos = strrpos($attribute, '.')) !== false) {
			$modelAttribute = substr($attribute, $pos + 1);
		} else {
			$modelAttribute = $attribute;
		}

		$value = $this->$modelAttribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
