<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends Model
{
    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $registrationDate;
    public $lastLogin;
    public $package_id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['email', 'email'],
            [['firstName', 'lastName', 'registrationDate', 'package_id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'isActive' => 'Is Active',
            'isConfirm' => 'Is Confirm',
            'registrationDate' => 'Registration Date',
            'package_id' => 'Package',
            'lastLogin' => 'Last Login',
        ];
    }

    public function search($params)
    {
        $query = Users::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'firstName', true);
        $this->addCondition($query, 'lastName', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'registrationDate');
        $this->addCondition($query, 'package_id');

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
