<?php

namespace backend\modules\rbac\models;

use Yii;
use yii\base\Model;

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
class Permission extends Model
{
    public static function permissionList()
    {
        $auth = Yii::$app->authManager;

    }

    public function savePermission()
    {
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($this->name);
        $permission->description = $this->description;
        $permission->ruleName = $this->ruleName ? : null;
        $permission->data = $this->data ? : null;
        return $auth->update($this->name, $permission);
    }

}
