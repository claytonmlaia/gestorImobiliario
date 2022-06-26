<?php
include_once "../conexao/Conexao.php";
include_once "../model/Cliente.php";
include_once "../dao/ClienteDAO.php";

//instancia as classes
$cliente = new Cliente();
$clientedao = new ClienteDAO();

//pega todos os dados passado por POST

$d = filter_input_array(INPUT_POST);

//se a operação for gravar entra nessa condição
if(isset($_POST['cadastrar'])){
    $cliente->setNome($d['nome']);
    $cliente->setEmail($d['email']);
    $cliente->setTelefone($d['telefone']);
    $clientedao->create($cliente);
    header("Location: ../../clientes.php");
} 
// se a requisição for editar
else if(isset($_POST['editar'])){
    $cliente->setNome($d['nome']);
    $cliente->setEmail($d['email']);
    $cliente->setTelefone($d['telefone']);
    $cliente->setId($d['id']);
    $clientedao->update($cliente);
    header("Location: ../../clientes.php");
}
// se a requisição for deletar
else if(isset($_GET['del'])){
    $cliente->setId($_GET['del']);
    $clientedao->delete($cliente);
    header("Location: ../../clientes.php");
}else{
    header("Location: ../../clientes.php");
}