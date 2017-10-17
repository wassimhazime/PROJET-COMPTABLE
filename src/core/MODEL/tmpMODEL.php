<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\MODEL;

/**
 * Description of tmpMODEL
 *
 * @author Wassim Hazime
 */
class tmpMODEL {
    
    
    
        public function getTableSQL_Orphelin($colunne = null,$TABLEpere=null,$TABLEenfant=null) {
      if ($colunne == null) {$colunne = $this->getSelectColunneImportant(null,$TABLEenfant);}  
      $sql = $this->statement->independent($colunne, $TABLEpere, $TABLEenfant);
        $data = $this->execute($sql);
          //si les champs de la table et vide  
        if ($data == null) {
            $sql = $this->statement->selectSchema($TABLEenfant);
            $data = $this->execute($sql);
            $EntitysTable = new EntitysTable();
            $table = array();
            foreach ($data as $value) {
                $EntitysTable->{$value->COLUMN_NAME} = '';
            }
           return array($EntitysTable);
        }

          return $data;
    }
  
     public function setData($data,$relation=null) {
        unset($data['ajout_data']);

        $dataRelation = null;
       
        if ($relation != null) {
            if (is_array($relation)) {
                foreach ($relation as $RD) {
                    if (isset($data[$RD])) {
                        $nomTableRelation[$RD] = 'r_' . $this->statement->getNom() . '_' . $RD;
                        $dataRelation[$RD] = $data[$RD];
                        $RL[]=$RD;
                        unset($data[$RD]);
                    }
                }
            } else {
                $nomTableRelation = 'r_' . $this->statement->getNom() . '_' . $relation; //exemple d_facture_bl
                $dataRelation = $data[$relation];
                unset($data[$relation]);
            }
        }
        $id = 'id' ;

        if ($data[$id] == '') {
           
            $idPere = $this->execute($this->statement->insert($data), false);
            
            if ($dataRelation != null) {
                if (is_array($RL)) {
                    
                    foreach ($RL as $RD) {
                        
                        foreach ($dataRelation[$RD] as $enfant) {
                            $item=null;
                            $item[$id . '_detail'] = $idPere;
                            $item['id_' . $RD . '_detail'] = $enfant;
                            
                            $this->execute($this->statement->insert($item, $nomTableRelation[$RD]), false);
                        }
                    }
                } else {
                    foreach ($dataRelation as $enfant) {
                        $item[$id . '_detail'] = $idPere;
                        $item['id_' . $relation . '_detail'] = $enfant;
                        $this->execute($this->statement->insert($item, $nomTableRelation), false);
                    }
                }
            }
        } else {
            
             $this->execute($this->statement->update($data), false);
        }

       
    }
     public function getData($condition,$link,$select) { // error
        
       
     if ($condition[0] == "" or $condition == ""  )
         {return null;}

    
         return $this->statement->select($this->schema, $condition);
           
    }
   
}
