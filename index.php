<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco
?>

<?php include_once 'includes/header.inc.php';
include_once 'includes/menu.inc.php';

?>
    <?php
    //apenas testando a conexao
    if (!$con->connect() == true) {
        die('Não conectou');
    }
    ?>
    <table style="border: 1px solid red;">
        <thead>
            <tr>
                <th>CPF/CNPJ</th>
                <th>Nome</th>
                <th>Endereco</th>
                <th>Dt.Nascto.</th>
                <th>Descri&ccedil;&atilde;o do T&iacute;tulo</th>
                <th>Dt.Vencto.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $consulta = mysql_query("SELECT id,cpfcnpj,nome,datanasc,endereco,titulo,dataVenc FROM tb_clientes ");
            while ($campo = mysql_fetch_array($consulta)) {    
            ?>
                <tr>
                    <td>  <?php echo $campo['cpfcnpj'];  // mostrando o campo NOME da tabela  ?> </td>
                    
                    <td>
                        <?php echo $campo['nome'];  ?>
                    </td>
                    
                    <td>
                        <?php echo $campo['endereco']; ?>
                    </td>
                    
                    <td>
                    
                        <?php echo date('d/m/Y', strtotime($campo['datanasc'])); ?>
                    </td>
                    <td>
                        <?php echo $campo['titulo']; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y', strtotime($campo['dataVenc']));?>
                        
                    </td>
                    <td>
                        <a href="formulario.php?id=<?php echo $campo['id'];?>">Editar</a>
                    </td>
                    <td>
                        <a href="excluir.php?id=<?php echo $campo['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
<?php 
include_once 'includes/footer.inc.php';
$con->disconnect(); // fecha conexao com o banco 
?>