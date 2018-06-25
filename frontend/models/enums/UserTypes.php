<?php
namespace frontend\models\enums;

class UserTypes {

    const SUPER_ADMIN = 1;
    const USER = 2;


    public static $headers = [
        self::SUPER_ADMIN => 'Super Admin',
        self::USER => 'User',
    ];

}