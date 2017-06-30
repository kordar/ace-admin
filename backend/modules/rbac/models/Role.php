<?php

namespace backend\modules\rbac\models;

use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

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

    public $assign = [];
    public $role = [];


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
            [['role', 'assign'], 'safe'],
            [['role', 'assign'], 'filter', 'filter'=>function($value){
                return empty($value) ? [] : $value;
            }],
        ];
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
            'assign' => '权限',
            'role' => '角色'
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

    public function setChildren()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->name);

        if (empty($role)) {
            return false;
        }

        if ($this->validate()) {

            $items = ArrayHelper::merge($this->role, $this->assign);

            $trans = Yii::$app->ace->beginTransaction();

            try {
                $auth->removeChildren($role);
                foreach ($items as $child) {
                    $obj = empty($auth->getRole($child)) ? $auth->getPermission($child) : $auth->getRole($child);
                    $auth->addChild($role, $obj);
                }
                $trans->commit();
            } catch (Exception $e) {
                $trans->rollBack();
                return false;
            }
            return true;
        }

        return false;


    }


    public function getPermissions($name)
    {
        $auth = Yii::$app->authManager;
        $this->assign = array_keys($auth->getPermissionsByRole($name));
        $permissions = $auth->getPermissions();
        return ArrayHelper::map($permissions, 'name', 'description');
    }

    public function getRoles($name)
    {
        $auth = Yii::$app->authManager;
        $this->role = array_keys($auth->getChildRoles($name));
        $roles = ArrayHelper::map($auth->getRoles(), 'name', 'description');
        ArrayHelper::remove($roles, $name);
        return $roles;
    }

}
