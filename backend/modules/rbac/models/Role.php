<?php

namespace backend\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('ace');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description', 'rule_name', 'data'], 'string'],
            [['description', 'rule_name', 'data'], 'filter', 'filter'=>function($value){
                return empty($value) ? null : trim($value);
            }],
        ];
    }

    public function setNull($attr, $param)
    {
        dump($param);die;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '角色名称',
            'type' => '类型',
            'description' => '角色描述',
            'rule_name' => '角色规则',
            'data' => '数据',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }


    public function createRole()
    {
        if ($this->validate()) {
            $auth = Yii::$app->authManager;
            $objRole = $auth->createRole($this->name);
            $objRole->description = $this->description;
            $objRole->ruleName = $this->rule_name;
            $objRole->data = $this->data;
            return $auth->add($objRole);
        }
        return false;
    }

}
