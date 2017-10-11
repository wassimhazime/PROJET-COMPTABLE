<?php
namespace core\html\element;

use core\html\element\AbstractHTML;


class  FormHTML  extends AbstractHTML{
    
            
    function __construct( ) {
        parent::__construct();
}

    public function createFormHTML($metaFORM,$formEnfant=null,$index=0) {
        $suffixe='';
        
       $meta=$metaFORM['meta'];
        $form=[];
        foreach ($meta as $champ) {
            $Field = $champ->Field; //name champ
            $Key = $champ->Key; // index unique premary MUL ''
            $Extra = $champ->Extra; //auto_increment ''
            $Null = $champ->Null; // yes no
            $Type = $champ->Type; //date varchar int .....
            $Default = $champ->Default; // default value
            $metaHTML = array(
                'balise' => ' ', // nom de balise
                'name' => ' ', // attr name 
                'form_group' => ' form-group  ', // form group input + label
                'hidden' => ' ',
                'warning' => ' ',
                'etoile' => ' ', // pour indique que champs important
                'description' => ' ', // text ajouter sur labil
                'classInput' => ' form-control formValue ', // ajouter class css 
                'Type' => ' ', //input type
                'value' => ' ', // valure default
                'inputf' => ' '// si balise fermer
            );

            $metaHTML['name'] = $Field;
            if ($Extra == "auto_increment") {
                $metaHTML['hidden'] = "hidden";
                $suffixe=str_replace('id', '', $Field);
            } else {
                $metaHTML['hidden'] = "visible";
            }
            if ($Null == "NO") {
                $metaHTML['warning'] = "";
                $metaHTML['etoile'] = '<font size=3 >   <span class="glyphicon glyphicon-pencil"></span></font>';
            } else {
                $metaHTML['warning'] = "";
                $metaHTML['etoile'] = "";
            }
            switch ($Type) {
                case 'varchar(20)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'tel';
                    break;
                case 'varchar(150)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'email';
                    break;
                case 'varchar(200)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'text';
                    break;
                case 'varchar(201)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'text';
                    break;
                case 'varchar(250)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'file';
                    break;
                case 'text' :$metaHTML['balise'] = 'textarea';
                    $metaHTML['Type'] = 'text';
                    $metaHTML['inputf'] = "</" . $metaHTML['balise'] . ">";
                    break;
                case 'date' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'date';
                    break;
                case 'tinyint(1)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'checkbox';
                    $metaHTML['value'] = ' value= "1" checked ';
                    break;
                case 'int(12)' :$metaHTML['balise'] = 'input';
                    $metaHTML['Type'] = 'number';
                    break;
                case 'int(11)' :if ($Key != "MUL") {
                        $metaHTML['balise'] = 'input';
                        $metaHTML['Type'] = 'number';
                        break;
                    } else {
                        $metaHTML['balise'] = 'select ';
                        
                       //$filde =str_replace($suffixe, '', $metaHTML['name']);
                   
                       
                        
                        $filde = $metaHTML['name'];
                        
                        $option = $this->chargeListHtml($metaFORM[$filde],$filde);
                        
                        $metaHTML['inputf'] = $option . "</" . $metaHTML['balise'] . ">";
                        break;
                    }
            }


            if ($Default != '' && $metaHTML['Type'] != 'checkbox') {
                $metaHTML['value'] = 'value=" ' . $Default . ' "';
            }



           $form[]= $this->createElementParMeta($metaHTML,$suffixe);
           
           
        }
        
        
       if(is_array($formEnfant)){
           
           foreach ($formEnfant as $Fenfant) {
              array_splice( $form, $Fenfant['index'], 0, $Fenfant['data'] ); 
           }
       } else {
         array_splice( $form, $index, 0, $formEnfant );  
       }
        
        
        return implode(" ", $form);
    }

    private function createElementParMeta($meta,$suffixe) {
     
     $label =str_replace($suffixe, '', $meta['name']);
     
        $form = '<div ' . $meta['hidden'] . ' form-group ' . $meta['warning'] . ' ' . $meta['form_group'] . '>'
                . ' <label   for="' . $meta['name'] . '">'
                . $meta['description'] . ' ' . $label . '  ' . $meta['etoile']
                . '</label>'
                . '  <' . $meta['balise'] . ''
                . ' class="  ' . $meta['classInput'] . ' "'
                . ' id="' . $meta['name'] . ' "'
                . '  name="' . $meta['name'] . '" '
                . ' placeholder="' .$label . '" '
                . 'type="' . $meta['Type'] . '" '
                . $meta['value']
                . ' > '
                . $meta['inputf']
                . '</div> ';
        
        




        return $form;
    }

    

}

