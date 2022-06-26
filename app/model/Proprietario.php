<?php

class Proprietario{

    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $dia_repasse;


  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }


  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }


  public function getEmail()
  {
    return $this->email;
  }


  public function setEmail($email)
  {
    $this->email = $email;
  }


  public function getTelefone()
  {
    return $this->telefone;
  }


  public function setTelefone($telefone)
  {
    $this->telefone = $telefone;
  }


  public function getDiaRepasse()
  {
    return $this->dia_repasse;
  }

  public function setDiaRepasse($dia_repasse)
  {
    $this->dia_repasse = $dia_repasse;
  }
    

    
}

