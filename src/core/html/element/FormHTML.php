<?php

namespace core\html\element;

use core\html\element\AbstractHTML;
use core\INTENT\Intent;

class FormHTML extends AbstractHTML {

    protected $input = [];
    protected $TypeClomunSQL_to_TypeInputHTML = [
 'varchar(20)' =>   'tel',
 'varchar(150)' => 'email',
 'varchar(200)' => 'text',
 'varchar(201)' => 'text',
 'varchar(250)' => 'file',
 'text' =>       'textarea',
 'date' =>        'date',
 'tinyint(1)' => 'checkBox',
 'int(12)' => 'number',
 'int(11)' => 'select',
 'int(10)' => 'hidden'
        
];

    function __construct(Intent $intent) {
        parent::__construct($intent);

        $COLUMNS_META = ($intent->getEntitysSchema()->getCOLUMNS_META());
        foreach ($COLUMNS_META as $COLUMN_META) {
            $COLUMN_META['Type'] = ($this->conevert_TypeClomunSQL_to_TypeInputHTML($COLUMN_META['Type']));
            $this->input[$COLUMN_META["Field"]] = $COLUMN_META;

            if ($COLUMN_META["Key"] == "MUL") {
                $DataFOREIGN_KEY = $intent->getEntitysDataTable_FOREIGN_KEYs($COLUMN_META["Field"]);
                $this->input[$COLUMN_META["Field"]]["DataFOREIGN_KEY"] = $DataFOREIGN_KEY;
            }
        }
        
        
       
        foreach ($intent->getEntitysDataTable_CHILDRENs() as $name_CHILDREN =>$data) {
          $this->input[]= 
                ["Field"=> $name_CHILDREN,
                "Type"=> "multiSelect",
                "Null"=> "NO",
                "Key"=> "",
                "Default"=> "",
                "Extra"=> "",
                "DataCHILDRENS"=> $data];
        }
      
                  
    }

    private function conevert_TypeClomunSQL_to_TypeInputHTML(string $Type): string {
        return $this->TypeClomunSQL_to_TypeInputHTML[$Type];
        
    }



    public function builder($att) {
        $INPUT = [];
        foreach ($this->input as $input) {
            $labelHTML = $this->labelHTML($input);
            switch ($input['Type']) {
                case "textarea": $inputHTML = $this->textareaHTML($input);
                    break;
                case "select": $inputHTML = $this->selectHTML($input);
                    break;
                case "multiSelect": $inputHTML = $this->multiSelectHTML($input);
                    break;
                default: $inputHTML = $this->inputHTML($input);
                    break;
            }
            $INPUT[] = $this->divHTML([$labelHTML, $inputHTML]);
        }

        $builder = implode("\n", $INPUT);

        return $builder;
    }

}
