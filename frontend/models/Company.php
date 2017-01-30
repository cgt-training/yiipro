<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $company_id
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_profile
 * @property string $company_created
 * @property string $company_status
 *
 * @property Branch[] $branches
 * @property Department[] $departments
 */
class Company extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'company_email', 'company_address', 'company_profile', 'company_status'], 'required'],
            [['company_created', 'logo'], 'safe'],
            [['company_status'], 'string'],
            [['file'], 'file'],
           // [['file'], 'file', 'extensions'=>'jpg, gif, png'],
            [['company_name', 'company_email'], 'string', 'max' => 100],
            [['company_address', 'logo'], 'string', 'max' => 255],
            [['company_profile'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_profile' => 'Company Profile',
            'file' => 'Logo',
            'company_created' => 'Company Created',
            'company_status' => 'Company Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branch::className(), ['company_fk_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['company_fk_id' => 'company_id']);
    }
}
