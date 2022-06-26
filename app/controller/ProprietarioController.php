<?php
include_once "../conexao/Conexao.php";
include_once "../model/Proprietario.php";
include_once "../dao/ProprietarioDAO.php";

$proprietario = new Proprietario();
$proprietariodao = new ProprietarioDAO();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){

  $proprietario->setNome($d['nome']);
  $proprietario->setEmail($d['email']);
  $proprietario->setTelefone($d['telefone']);
  $proprietario->setDiaRepasse($d['dia_repasse']);

  $proprietariodao->create($proprietario);

    header("Location: ../../proprietario.php");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){

  $proprietario->setNome($d['nome']);
  $proprietario->setEmail($d['email']);
  $proprietario->setTelefone($d['telefone']);
  $proprietario->setDiaRepasse($d['dia_repasse']);
  $proprietario->setId($d['id']);

  $proprietariodao->update($proprietario);

  header("Location: ../../proprietario.php");
}
// se a requisição for deletar
else if(isset($_GET['del'])){

  $proprietario->setId($_GET['del']);

  $proprietario->delete($proprietario);

  header("Location: ../../proprietario.php");
}else{
  header("Location: ../../proprietario.php");
}