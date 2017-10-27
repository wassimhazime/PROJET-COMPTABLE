<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\html;
use core\ConfigPath;

/**
 * Description of Config
 *
 * @author Wassim Hazime
 */
class Config extends ConfigPath{
  
    public static function getPath() {
        return parent::getPath(). "html" . D_S;
    }

    public static function getConevert_TypeClomunSQL_to_TypeInputHTML(string $path = null): array {
        if ($path == null) {
            $path = self::getPath();
        }
        try {
            $Conevert_Type = file_get_contents($path . "Conevert_TypeClomunSQL_to_TypeInputHTML.json");
         return json_decode($Conevert_Type, true);
        } catch (Exception $e) {

            
            Notify::send_Notify(' ERORR CONFIG html JSON  Conevert_TypeClomunSQL_to_TypeInputHTML <br>' . $e->getMessage());
        return $TypeClomunSQL_to_TypeInputHTML = [
        'varchar(20)' => 'tel',
        'varchar(150)' => 'email',
        'varchar(200)' => 'text',
        'varchar(201)' => 'text',
        'varchar(250)' => 'file',
        'text' => 'textarea',
        'date' => 'date',
        'tinyint(1)' => 'checkBox',
        'int(12)' => 'number',
        'int(11)' => 'select',
        'int(10)' => 'hidden'
    ];
        }
    }

}
