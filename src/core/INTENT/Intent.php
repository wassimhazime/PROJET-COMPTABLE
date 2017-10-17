<?php

namespace core\INTENT;

use core\MODEL\Entitys\EntitysSchema;
use core\MODEL\Entitys\EntitysTable;

class Intent {
    const MODE_SELECT_MASTER = 1;
    const MODE_SELECT_ALL = 2;

    private $entitysSchema;
    private $entitysTable;
    private $mode;

    function getEntitysSchema(): EntitysSchema {
        return $this->entitysSchema;
    }

    function getEntitysTable(): array {
        return $this->entitysTable;
    }
    function getMode():int {
        return $this->mode;
    }

        function __construct(EntitysSchema $entitysSchema, array $entitysTables,int $mode) {



        foreach ($entitysTables as $entitysTable) {
            if ($entitysTable instanceof EntitysTable) {
                
            } else {

                throw new \TypeError("type array entre ERROR ==> entitysTables");
            }
        }
        $this->mode=$mode;

        $this->entitysSchema = $entitysSchema;
        $this->entitysTable = $entitysTables;
    }

}
