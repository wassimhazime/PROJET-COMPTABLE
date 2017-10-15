<?php

/*
LCT : langage de< contrôle> des transactions
 LCT : langage de contrôle des transactions
Validation : commit
Annulation : rollback
 */

namespace core\MODEL\Query;

/**
 *
 * @author Wassim Hazime
 */
interface I_QuerySQL_LCT {


    
     //traitement
    public function query() ;
    public function __toString();
    


}
