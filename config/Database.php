<?php 

namespace Arifin\PHP\MVC\Config;

class Database{
    public static function getDatabaseConfig(): array {
        return [
            'database'=>[
                'test'=>[
                    'url'=>"pgsql:host=database;port=5432;dbname=php-pzn",
                    'username'=>'postgres',
                    'password'=>'secret',
                ],
                'prod'=>[
                    'url'=>"pgsql:host=database;port=5432;dbname=php-pzn",
                    'username'=>'postgres',
                    'password'=>'secret',
                ],
            ]
        ];
    }

}