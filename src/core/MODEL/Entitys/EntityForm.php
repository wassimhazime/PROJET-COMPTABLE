<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\model\entitys;

/**
 * Description of EntityForm
 *
 * @author Wassim Hazime
 */
class EntityForm extends Entitys{
    
      public $Data;
      public $Field;
      public $Type;
      public $Null;
      public $Key;
      public $Default;
      public $Extra;
    
    
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      function getData() {
          return $this->Data;
      }

      function getField() {
          return $this->Field;
      }

      function getType() {
          return $this->Type;
      }

      function getNull() {
          return $this->Null;
      }

      function getKey() {
          return $this->Key;
      }

      function getDefault() {
          return $this->Default;
      }

      function getExtra() {
          return $this->Extra;
      }

      function setData($Data) {
          $this->Data = $Data;
      }

      function setField($Field) {
          $this->Field = $Field;
      }

      function setType($Type) {
          $this->Type = $Type;
      }

      function setNull($Null) {
          $this->Null = $Null;
      }

      function setKey($Key) {
          $this->Key = $Key;
      }

      function setDefault($Default) {
          $this->Default = $Default;
      }

      function setExtra($Extra) {
          $this->Extra = $Extra;
      }


      
       function is_Key($Key) {
           return  $this->Key == $Key;
      }
      
      function is_FOREIGN_KEY(){
          return $this->is_Key('MUL');
      }
      
      
}
