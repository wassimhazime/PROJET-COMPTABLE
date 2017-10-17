<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL\Outils;

use core\MODEL\base_donnee\RUN;
use core\MODEL\entitys\EntityForm;
use core\MODEL\entitys\EntitysSchema;

class Form extends RUN {

    public static function getForm(EntitysSchema $schem): array {

        $DESCRIBE = ((new self())->query("DESCRIBE  " . $schem->getPARENT()));

        foreach ($DESCRIBE as $input) {
            if ($input->is_FOREIGN_KEY()) {
                $field = $input->getField();
                $input->setData(Autocomplete::getAutocomplete($field));
            }
        }
       
        return $DESCRIBE;
    }

    function __construct() {
        parent::__construct(new EntityForm());
    }

}
