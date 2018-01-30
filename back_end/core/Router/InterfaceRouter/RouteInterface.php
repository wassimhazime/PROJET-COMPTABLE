<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author wassime
 */
namespace core\Router\InterfaceRouter;

interface RouteInterface
{

    
    
  
   
    function __construct($callable, $name, $params);
    
    function getCallable();
    

    function getName();
    

    function getParams();
    

    
    
    function getParam(string $index);
    
    function setCallable($callable);
    

    function setName($name);
    

    function setParams($params);
}
