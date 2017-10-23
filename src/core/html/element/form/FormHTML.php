<?php

namespace core\html\element\form;

use core\html\element\AbstractHTML;
use core\INTENT\Intent;

class FormHTML extends AbstractHTML {

    protected $input = [];

    function __construct(Intent $intent) {

        $COLUMNS_META = ($intent->getEntitysSchema()->getCOLUMNS_META());
        foreach ($COLUMNS_META as $COLUMN_META) {
            $COLUMN_META['Type'] = ($this->conevert_TypeClomunSQL_to_TypeInputHTML($COLUMN_META['Type']));
            $this->input[$COLUMN_META["Field"]] = $COLUMN_META;

            if ($COLUMN_META["Key"] == "MUL") {
                $DataFOREIGN_KEY = $intent->getEntitysDataTable_FOREIGN_KEYs($COLUMN_META["Field"]);
                $this->input[$COLUMN_META["Field"]]["DataFOREIGN_KEY"] = $DataFOREIGN_KEY;
            }
        }
        // $this->input["CHILDRENS"] = $intent->getEntitysDataTable_CHILDRENs();
    }

    private function conevert_TypeClomunSQL_to_TypeInputHTML(string $Type): string {
        switch ($Type) {
            case 'varchar(20)' : return 'tel';
            case 'varchar(150)' : return 'email';
            case 'varchar(200)' : return 'text';
            case 'varchar(201)' : return 'text';
            case 'varchar(250)' : return 'file';
            case 'text' : return 'textarea';
            case 'date' : return 'date';
            case 'tinyint(1)' : return 'checkBox';
            case 'int(12)' : return 'number';
            case 'int(11)' : return 'KEY';
            default : return 'text';
        }
    }

    public function input($att = ""): string {
        $INPUT = [];
        foreach ($this->input as $input) {

            $labelHTML = '<label ' . $att . '             for="' . $input['Field'] . '">' . str_replace("_", " ", $input['Field']) . '</label>' . "\n";
            if ($input['Type'] == "textarea") {
                $inputHTML = ' <textarea                             ' . $att . '   name="' . $input['Field'] . '"  placeholder="' . str_replace("_", " ", $input['Field']) . '" value="' . $input['Default'] . '"> </textarea>';
            } 
            
            elseif ($input['Type'] == "KEY") {
                if ($input['Field'] == "id") {
                    $inputHTML = ' <input type="hidden"  ' . $att . '   name="' . $input['Field'] . '"  placeholder="' . str_replace("_", " ", $input['Field']) . '" value="' . $input['Default'] . '">';
                } else {
                    $inputHTML = ' <select  ' . $att . '   name="' . $input['Field'] . '" >';

                    foreach ($input['DataFOREIGN_KEY'] as $op) {
                        $Item="| ";
                        foreach ($op as $item) {
                         $Item.=  $item ." | "; 
                        }

                        $inputHTML .= '  <option value="' . $op->id . '">' . $Item . '</option>';
                    }
                    $inputHTML .= '</select>';
                }
            }
            
            else {
                $inputHTML = ' <input type="' . $input['Type'] . '"  ' . $att . '   name="' . $input['Field'] . '"  placeholder="' . str_replace("_", " ", $input['Field']) . '" value="' . $input['Default'] . '">';
            }

            $INPUT[] = "<div>" . $labelHTML . $inputHTML . "</div>";
        }


        return implode("\n\n", $INPUT);
    }

    public function builder() {
        ////////////Les décorateurs
        var_dump($this->input);

        echo "<form> \n";
        echo ($this->input());
        echo '</form>';
        die();


        $lable = lable::parse($intent, $att); //<=== $icon=Icon("name","size 3");
        $input = input::parse($intent, $att);
        return div::parse([$input], $att); ///Les décorateurs
    }

}
