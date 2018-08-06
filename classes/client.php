<?php
class Client extends Personne
{
  private $_dateCreationCompte;
  private $_motDePasse;

  function __construct($_nom, $_prenom, $_mail, $_adresse, $_cp, $_ville, $_dateNaissance, $_id, $_dateCreationCompte, $_motDePasse)
  {
    $this->_nom = $_nom;
    $this->_prenom = $_prenom;
    $this->_mail = $_mail;
    $this->_adresse = $_adresse;
    $this->_cp = $_cp;
    $this->_ville = $_ville;
    $this->_dateNaissance = $_dateNaissance;
    $this->_id = $_id;
    $this->_dateCreationCompte = $_dateCreationCompte;
    $this->_motDePasse = $_motDePasse;
  }

  public function modifierInfo()
  {
  }
}
