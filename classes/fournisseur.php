<?php
class Fournisseur extends Personne
{
  private $_codeComptable;

  function __construct($_nom, $_prenom, $_mail, $_adresse, $_cp, $_ville, $_dateNaissance, $_id, $_codeComptable)
  {
    $this->_nom = $_nom;
    $this->_prenom = $_prenom;
    $this->_mail = $_mail;
    $this->_adresse = $_adresse;
    $this->_cp = $_cp;
    $this->_ville = $_ville;
    $this->_dateNaissance = $_dateNaissance;
    $this->_id = $_id;
    $this->_codeComptable = $_codeComptable;
  }
    
    public function modifierInfo()
    {
    }
  }
