<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\html\element;

/**
 * Description of tempform
 *
 * @author Wassim Hazime
 */
class tempform {
    public function createFormHTML($metaFORM,$formEnfant=null,$index=0) {
        $suffixe='';
        
       $meta=$metaFORM;
        $form=[];
        foreach ($meta as $champ) {
            $Field = $champ->Field; //name champ
            $Key = $champ->Key; // index unique premary MUL ''
            $Extra = $champ->Extra; //auto_increment ''
            $Null = $champ->Null; // yes no
            $Type = $champ->Type; //date varchar int .....
            $Default = $champ->Default; // default value
            $Data = $champ->Data; // data si  $champ->Key MUL (FOREIGN KEY)
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
                        
                        $option = $this->chargeListHtml($Data);
                        
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
}
