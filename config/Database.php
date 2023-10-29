<?php 

namespace Arifin\PHP\MVC\Config;

class Database{
    public static function getDatabaseConfig(): array {
        return [
            'database'=>[
                'test'=>[
                    'url'=>"pgsql:host=database:3306;dbname=php-pzn-test",
                    'username'=>'root',
                    'password'=>'secret',
                ],
                'prod'=>[
                    'url'=>'pgsql:host=database:3306;dbname=php-pzn',
                    'username'=>'root',
                    'password'=>'secret',
                ],
            ]
        ];
    }

}