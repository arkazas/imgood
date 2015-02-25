<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $isActive
 * @property string $isConfirm
 * @property string $registrationDate
 * @property string $lastLogin
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email'], 'required'],
            [['registrationDate', 'lastLogin'], 'safe'],
            [['firstName', 'lastName'], 'string', 'max' => 25],
            [['email'], 'string', 'max' => 40],
            [['isActive', 'isConfirm'], 'string', 'max' => 1],
            ['package_id', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     */
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

    public function getPackages()
    {
        return [
            'All' => 'All',
            0 => 'Not set',
            1 => '1 month free',
            2 => '1 year',
            3 => '1 month',
            4 => 'free',
            5 => 'banned',
        ];
    }
}
