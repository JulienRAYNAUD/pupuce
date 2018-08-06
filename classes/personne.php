<?php
abstract class Personne
{
  protected $_nom;
  protected $_prenom;
  protected $_mail;
  protected $_adresse;
  protected $_cp;
  protected $_ville;
  protected $_dateNaissance;
  protected $_id;

  public abstract function modifierInfo()

  public function __get($attr)
  {
    return $this->$attr;
  }

  public function __set($val, $attr)
  {
    return $this->$attr = $val;
  }
}
