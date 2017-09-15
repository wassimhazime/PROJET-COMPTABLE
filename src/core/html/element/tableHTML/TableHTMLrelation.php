<?php
namespace core\html\element\tableHTML;
use core\html\element\tableHTML\TableHTML;

class TableHTMLrelation extends TableHTML{
    
    function __construct() {
        parent::__construct();
    }

    public function createTableHTMLrelation($data,$suffixe, $link ,$titles) {
         
            $thead = $this->Rthead($data,$suffixe,$titles);
            $tbody = $this->Rtbody($data,$titles,$link);
            return $thead.$tbody ;
        
       
    }

   private function Rthead($data,$suffixe,$titles) {
        $thead = '';
        foreach ($data[0] as $key => $value) {
            $key= str_replace('_'.$suffixe, '', $key);
            $key= str_replace('_', ' ', $key);
         $thead .= $this->th($key);
       }
       foreach ($titles as $title) {
           $thead .=$this->th($title);
       }
       
        
         
        return $this->tr($thead); 
    }
    
    

	

    private function Rtbody($data,$titles, $link = null) {
           $tbody = '';
        foreach ($data as $row) {
            $TD = '';
            foreach ($row as $key => $value) {
                if($value!='&'){
                if ($link == null) {
                    $TD .= $this->td($value, ' class="success" ');
                } else {
                    $href=$row->gethref($key,$link);
                    $TD .= $this->td($this->a($href, $value));
                }}
            }
            $enfant='';
            foreach ($titles as $title) {
             $enfant.=$this->td(
                     '<table class="table table-striped">'
                     .$this->createTableHTML($row->getEnfant($title),$title,'relation')
                     .'</table>');   
            }
            
           $tbody .= $this->tr($TD.$enfant);
            
        }
         return $tbody;
    }
    
    
    
    
}

