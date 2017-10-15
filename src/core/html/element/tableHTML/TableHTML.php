<?php
namespace core\html\element\tableHTML;
use core\html\element\AbstractHTML;

class TableHTML extends AbstractHTML{
    
    function __construct() {
        parent::__construct();
    }

    public function createTableHTML($data,$suffixe, $link = null) {
        echo 'class TableHTML  =>createTableHTML';
        var_dump($data);
        
        
         if (isset($data) && !empty($data)) {
            $thead = $this->thead($data,$suffixe);
            $tbody = $this->tbody($data, $link);
            return $thead . $tbody;
        }
       
    }

    protected function thead($data,$suffixe) {
        $thead = '';
        foreach ($data[0] as $key => $value) {
            $key= str_replace('_'.$suffixe, '', $key);
            $key= str_replace('_', ' ', $key);
            if($value!='&'){ $thead .= $this->th($key);}
        }
        return $this->tr($thead); 
    }
    protected function tbody($data, $link = null) {
        $tbody = '';
        foreach ($data as $row) {
            $TD = '';
            foreach ($row as $key => $value) {
                if($value!='&'){
                        if ($link == null) {
                            $TD .= $this->td($value, ' class="success" ');
                        }elseif ($link == 'relation') {
                            $TD .= $this->td($value, ' class="info" ');
                        } else {
                            //$href=$row->gethref($key,$link);
                           // $TD .= $this->td($this->a($href, $value));
                            $TD .= $this->td($value);
                        }
                
                }
            }


            $tbody .= $this->tr($TD);
        }

        return $tbody;
    }
    
    protected function tr($content){
     return "<tr>{$content}</tr>";}
protected function th($content,$att=''){
        return "<th$att>{$content}</th>";}
protected function td($content,$att=''){
        return "<td$att>{$content}</td>";}
    
}

