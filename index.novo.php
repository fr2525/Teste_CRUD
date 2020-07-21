<?php
session_start();

require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conexao
$con->connect(); // abre conexao com o banco
?>
<!DOCTYPE html>

<?php include_once 'includes/header.inc.php';
include_once 'includes/menu.inc.php';
?>

<table style="border: 1px solid red;">
    <thead>
        <tr>
            <th>
                CPF/CNPJ
            </th>
            <th>
                Nome
            </th>
            <th>
                Dt.Nascto.
            </th>

            <th>
                T&iacute;tulo
            </th>
            <th>
                Dt.Vencto.
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $consulta = mysql_query("SELECT id,cpfcnpj,nome, dataNasc , titulo, dataVenc FROM tb_clientes ORDER BY nome"); // query que busca todos os dados da tabela PRODUTO
        while ($campo = mysql_fetch_array($consulta)) {    // laço de repetiçao que vai trazer todos os resultados da consulta
        ?>
            <tr>
                <td>
                    <?php echo $campo['cpfcnpj'];  // mostrando o campo NOME da tabela 
                    ?>
                </td>
                <td>
                    <?php echo $campo['nome'];  // mostrando o campo NOME da tabela 
                    ?>
                </td>
                <td>
                    <?php echo $campo['dataNasc'];  // mostrando o campo NOME da tabela 
                    ?>
                </td>

                <td>
                    <?php echo $campo['titulo'];  // mostrando o campo NOME da tabela 
                    ?>
                </td>
                <td>
                    <?php echo $campo['dataVenc']; // mostrando o campo DESCRICAO da tabela 
                    ?>
                </td>
                <td>
                <td><a href='formulario.php?id=<?php echo $campo['id']; ?>'><i class='material-icons'>edit</i></td>";
                <td><a href='excluir.php?id=<?php echo $campo['id']; ?>'><i class='material-icons'>delete</i></td>";
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once('includes/footer.inc.php')
?>