<?php

namespace freelancerppe\Domain;

class Projet
{
  private $id_projet;
  private $prix;
  private $etape;
  private $description;
  private $id_societe;
  private $id_cdc;
     // date et heure
  
  /* GETTERS */
  
  function getId_projet() {
      return $this->id_projet;
  }

  function getPrix() {
      return $this->prix;
  }

  function getEtape() {
      return $this->etape;
  }

  function getDescription() {
      return $this->description;
  }

  function getId_societe() {
      return $this->id_societe;
  }

  function getId_cdc() {
      return $this->id_cdc;
  }


  /* SETTERS */
  
  function setId_projet($id_projet) {
      $this->id_projet = $id_projet;
  }

  function setPrix($prix) {
      $this->prix = $prix;
  }

  function setEtape($etape) {
      $this->etape = $etape;
  }

  function setDescription($description) {
      $this->description = $description;
  }

  function setId_societe($id_societe) {
      $this->id_societe = $id_societe;
  }

  function setId_cdc($id_cdc) {
      $this->id_cdc = $id_cdc;
  }


}
