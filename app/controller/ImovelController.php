<?php
include_once "../conexao/Conexao.php";
include_once "../model/Imovel.php";
include_once "../dao/ImovelDAO.php";

//instancia as classes
$imovel = new Imovel();
$imoveldao = new ImovelDAO();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

  $imovel->setEndereco($d['endereco']);
  $imovel->setProprietariosId($d['proprietarios_id']);

  $imoveldao->create($imovel);

  header("Location: ../../imovel.php");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

  $imovel->setEndereco($d['endereco']);
  $imovel->setProprietariosId($d['proprietarios_id']);
  $imovel->setId($d['id']);

  $imoveldao->update($imovel);

  header("Location: ../../imovel.php");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

  $imovel->setId($_GET['del']);

  $imoveldao->delete($imovel);

  header("Location: ../../imovel.php");
}else{
  header("Location: ../../imovel.php");
}