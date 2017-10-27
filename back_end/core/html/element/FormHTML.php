<?php

namespace core\html\element;

use core\html\element\AbstractHTML;
use core\INTENT\Intent;
use core\html\Config;

class FormHTML extends AbstractHTML {

    protected $input = [];

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



        foreach ($intent->getEntitysDataTable_CHILDRENs() as $name_CHILDREN => $data) {
            $this->input[] = ["Field" => $name_CHILDREN,
                "Type" => "multiSelect",
                "Null" => "NO",
                "Key" => "",
                "Default" => "",
                "Extra" => "",
                "DataCHILDRENS" => $data];
        }
    }

    private function conevert_TypeClomunSQL_to_TypeInputHTML(string $Type): string {
        $configjson = (Config::getConevert_TypeClomunSQL_to_TypeInputHTML());
        if (isset($configjson[$Type])) {
            return $configjson[$Type];
        } else {
            return "text";
        }
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
