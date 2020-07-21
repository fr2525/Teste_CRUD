<?php
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';

    $con = new conexao();  
    $con->connect(); 

    $crud = new crud('tb_clientes'); 
    $id = $_GET['id']; //pega id para exclusao caso exista
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

    $con->disconnect(); 

    header("Location: index.php"); 
?>