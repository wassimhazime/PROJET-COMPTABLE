<?php

namespace core\model\entitys;

use core\routeur\Session;

class EntitysTable extends Entitys {

    private $DataJOIN = array();

    

//add item enfant

    public function setDataJOIN($key, $enfant) {
        $this->DataJOIN[$key] = $enfant;
    }

    public function getDataJOIN($key) {
        return $this->DataJOIN[$key];
    }

    public function getValueSyntaxeSql($key) {

        $value = $this->$key;
        return "'" . str_replace(' ', '+', $value) . "'";
    }

    public function gethref($key, $link) {

        return Session::get('url') . $key . '=' . $this->getValueSyntaxeSql($key) . '';
    }

}
