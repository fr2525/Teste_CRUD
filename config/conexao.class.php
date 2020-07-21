<?php

class conexao
{

    private $db_host = 'localhost'; // servidor
    private $db_user = 'root'; // usuario do banco
    private $db_pass = ''; // senha do usuario do banco
    private $db_name = 'db_financeiro'; // nome do banco

    private $con = false;
    private $query = true;

    public function connect() // estabelece conexao
    {
        if (!$this->con) {
            $myconn = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            if ($myconn) {
                $seldb = mysql_select_db($this->db_name, $myconn);
                if ($seldb) {
                    $this->con = true;
                    // Conectou e Selecionou o banco;
                    return true;
                }
                else {
                    if( mysql_errno() == 1049); {  // Erro 1049 - Banco não existe 
                     
                        if(!$this->query = mysql_query("CREATE DATABASE if not exists db_financeiro 
                                                        default character set utf8 collate utf8_general_ci;")) die ("<center>Erro na Criação do banco de dados " . '<br>Linha: ' . __LINE__ . "<br>" . mysql_error() );
                    }
                    mysql_select_db($this->db_name, $myconn);
                    if(!$this->query = mysql_query("CREATE table if not exists tb_clientes (
                                                                    id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                                    cpfcnpj int UNSIGNED UNIQUE NOT NULL,
                                                                    nome VARCHAR(50) NOT NULL,
                                                                    datanasc date NOT NULL,
                                                                    endereco varchar(250),
                                                                    titulo varchar(250) NOT NULL,
                                                                    datavenc date NOT NULL,
                                                                    dataUpdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)
                                                                    default character set utf8 collate utf8_general_ci;" ) )
                        {die ("<center>Erro na Criação da tabela tb_clientes " . '<br>Linha: ' . __LINE__ . "<br>" . mysql_error() );}
                    print "<script>location='index.php';</script>";      
                }
            }        
            else 
                {   die ("<center>Erro na conexão do banco de dados " . '<br>Linha: ' . __LINE__ . "<br>" . mysql_error() );
                }
            
            return true;
        } 
        else {
                return true;
        }
    }

    public function disconnect() // fecha conexao
    {
        if ($this->con) {
            if (mysql_close()) {
                $this->con = false;
                return true;
            } else {
                return false;
            }
        }
    }
}
