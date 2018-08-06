<?php
class Employe extends Personne
{
  private $_numSecu;
  private $_fonction = 'Employé';
  private $_salaire = 1300;
  private $_superieur;

  function __construct($_nom, $_prenom, $_mail, $_adresse, $_cp, $_ville, $_dateNaissance, $_id, $_numSecu, $_fonction, $_salaire, $_superieur)
  {
    $this->_nom = $_nom;
    $this->_prenom = $_prenom;
    $this->_mail = $_mail;
    $this->_adresse = $_adresse;
    $this->_cp = $_cp;
    $this->_ville = $_ville;
    $this->_dateNaissance = $_dateNaissance;
    $this->_id = $_id;
    $this->_numSecu = $_numSecu;
    $this->_fonction = $_fonction;
    $this->_salaire = $_salaire;
    $this->_superieur = $_superieur;
  }
  
  public function modifierInfo()
  {
  }
}
