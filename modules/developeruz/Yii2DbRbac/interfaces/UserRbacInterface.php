<?php
namespace app\modules\developeruz\Yii2DbRbac\interfaces;


interface UserRbacInterface {

    public function getId();
    public function getUserName();
    public static function findIdentity($id);
}