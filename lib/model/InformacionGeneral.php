<?php

/**
 * Subclass for representing a row from the 'informacio_general' table.
 *
 * 
 *
 * @package lib.model
 */ 
class InformacionGeneral extends BaseInformacionGeneral
{
  /**
  * Devuelve si un programa es de pregrado
  * @param string : El nivel academico del programa
  * @return boolean true cuando es pregrado
  */
  public function isPregrado()
  {
    if($this->ing_nivel_academico != "Tecnologico" && $this->ing_nivel_academico != "Profesional")
    {
      return false;
    }
    return true;
  }
  
}
