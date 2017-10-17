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

    public function getEntitysSchema(): EntitysSchema {
        return $this->entitysSchema;
    }

    public function getEntitysTable(): array {
        return $this->entitysTable;
    }

    public function getMode(): int {
        return $this->mode;
    }

    public static function parse(array $data, EntitysSchema $schema, int $mode = self::MODE_SELECT_ALL):self {
        if (self::isAssoc($data) and isset($data)) {
            return (new self($schema, ((new EntitysTable())->set($data)), $mode));
        }
    }

    public function __construct(EntitysSchema $entitysSchema, array $entitysTables, int $mode) {



        foreach ($entitysTables as $entitysTable) {
            if ($entitysTable instanceof EntitysTable) {
                
            } else {

                throw new \TypeError("type array entre ERROR ==> entitysTables");
            }
        }
        $this->mode = $mode;

        $this->entitysSchema = $entitysSchema;
        $this->entitysTable = $entitysTables;
    }

    public static function isAssoc(array $arr): bool {
        if (array() === $arr)
            return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
