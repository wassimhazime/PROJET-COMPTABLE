<?php

//– LDD, LMD & LCT
//LDD : langage de< définition> des données
//Colonnes
//Tables
//Contraintes
//Tables et contraintes
//LMD : langage de <manipulation> des données
//Insertion :insert
//Mise à jour :update
//Suppression :delete
//LCT : langage de< contrôle> des transactions
//Validation :commit
//Annulation :rollback

namespace core\model\table\sql;

/**
 * Description of QuerySQL
 *
 * @author Wassim Hazime
 */
class QuerySQL implements InterfaceQuerySQL_LDD, InterfaceQuerySQL_LMD, InterfaceQuerySQL_LCT {

    private $select = ["*"];
    private $table = [];
    private $conditions = ["1"];
    private $join = [];
    private $action = "";
    private $value;

    /// select query
    //
    //select|where(["id","nom"],"age")
    //from("client_table")|from("client_table","client")
    
    public function select() {
        $this->action = "select";
        if (func_get_args() != null or ! empty(func_get_args())) {
            $this->select = [];

            foreach (func_get_args() as $args) {

                
                    if (is_array($args)) {
                        foreach ($args as $arg) {

                            $this->select[] = $arg;
                        }
                    } else {
                        

                        $this->select[] = $args;
                    }
                
            }
        }
        return $this;
    }

    public function from(string $table, string $alias = '') {
        if ($alias=='') {
            $this->table[] = $table;
        } else {
            $this->table[] = "$table AS $alias";
        }
        return $this;
    }

    public function where() {
        if (func_get_args() != null or ! empty(func_get_args())) {
            foreach (func_get_args() as $args) {

                if ($args != null and $args[0] !== '') {

                    if ($this->conditions == ["1"]) {
                        $this->conditions = [];
                    }

                    if (is_array($args)) {
                        foreach ($args as $arg) {

                            $this->conditions[] = $arg;
                        }
                    } else {

                        $this->conditions[] = $args;
                    }
                }
            }
        }

        return $this;
    }

    public function join(string $tablejoin, string $type = "INNER",bool $relation = false) {



        if ($relation) {
            $TABLEpere = $this->table[0];
            $TABLEenfant = $tablejoin;
            $RD = 'd_' . $TABLEpere . '_' . $TABLEenfant;


            //LEFT JOIN d_facture_bl     ON id_facture              =id_facture_detail
            $this->join[] = "  $type JOIN $RD     ON id_" . $TABLEpere . "=id_" . $TABLEpere . "_detail    "
                    // LEFT      JOIN  bl             on id_bl                        =id_bl_detail
                    . " $type JOIN $TABLEenfant         ON id_" . $TABLEenfant . "=id_" . $TABLEenfant . "_detail     ";
        } else {
            //INNER JOIN raison_sociale ON id_raison_sociale = raison_sociale_facture

            $this->join[] = " $type JOIN $tablejoin ON"
                    . " id_" . $tablejoin . "  = " . $tablejoin . "_" . $this->table[0];
        }


        return $this;
    }

    public function independent(string $master) {
        $TABLE = $this->table[0];

        $RD = 'd_' . $master . '_' . $TABLE;
        //LEFT JOIN d_facture_bl ON id_bl_detail =id_bl
        $this->join[] = "LEFT JOIN  $RD ON id_" . $TABLE . "_detail =id_" . $TABLE;
        // WHERE id_bl_detail IS NULL
        $this->where("id_" . $TABLE . "_detail IS NULL");
        return $this;
    }

    ///delete
    public function delete() {
        $this->action = "delete";
        $this->where(func_get_args()[0]);

        return $this;
    }

    //insert

    public function insertInto(string $table) {
        $this->action = "insert";
        $this->table=[];

        $this->table[] = $table;
        return $this;
    }

    public function value(array $data) {

        $this->value = " (`" . implode("`, `", array_keys($data)) . "`)" .
                " VALUES ('" . implode("', '", $data) . "') ";
        return $this;
    }

    //update

    public function update(string $table) {
        $this->action = "update";
           $this->table=[];
        $this->table[] = $table;
        return $this;
    }

    public function set(array $data) {
        $id = 'id_' . $this->table[0];
        $l = "";
        foreach ($data as $x => $x_value) {
            if ($x != $id) {
                if ($l == "") {
                    $l = '  `' . $x . '`' . '=' . '\'' . $x_value . '\'  ';
                } else {
                    $l .= " , " . '`' . $x . '`' . '=' . '\'' . $x_value . '\'  ';
                }
            }
        }
        $this->value = $l;
        return $this;
    }

    //traitement

    public function query() {
        $table = implode(', ', $this->table);
        $join = implode('  ', $this->join);
        $where = ' WHERE ' . implode(' AND ', $this->conditions);




        switch ($this->action) {
            case "select":
                $action = ' SELECT ' . implode(', ', $this->select) . "  FROM  ";
               
                return $action . $table . $join . $where;

                break;
            case "insert":

                $action = ' INSERT INTO ';
                return $action . $table . $this->value;
                break;

            case "delete":
                $action = 'DELETE FROM ';
                return $action . $table . $where;

                break;

            case "update":
                $action = 'UPDATE  ';
                $set = " SET " . $this->value;
                return $action . $table . $set . $where;

                break;

            default:
                $action = ' SELECT ' . implode(', ', $this->select) . "  FROM  ";
                return $action . $table . $join . $where;
                break;
        }


        return "";
    }

    public function __toString() {
        return $this->query();
    }

}
