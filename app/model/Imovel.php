<?php

class Imovel {
    
    private $id;
    private $endereco;
    private $proprietarios_id;



  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getEndereco()
  {
    return $this->endereco;
  }

  public function setEndereco($endereco)
  {
    $this->endereco = $endereco;
  }

  public function getProprietariosId()
  {
    return $this->proprietarios_id;
  }


  public function setProprietariosId($proprietarios_id)
  {
    $this->proprietarios_id = $proprietarios_id;
  }


    
}

