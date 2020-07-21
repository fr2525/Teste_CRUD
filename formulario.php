<?php
require_once 'config/conexao.class.php';
require_once 'config/crud.class.php';

$con = new conexao(); 
$con->connect(); // abre conexao com o banco
@$getId = $_GET['id'];  //pega id para ediçao caso exista

$data = "" ;
$dataP = "" ;
$datanasc = ""; 
$datavenc = "";
$endereco = "";
$titulo = "";

// echo "==================>>> getId = " . $getId;

if (@$getId) { //se existir recupera os dados e tras os campos preenchidos
    $consulta = mysql_query("SELECT cpfcnpj,nome,datanasc,endereco,titulo,datavenc FROM tb_clientes WHERE id = + $getId");
    $campo = mysql_fetch_array($consulta);
    $datanasc = date("d/m/Y",strtotime($campo['datanasc']));
    // Mostra 03/04/1992
    $datavenc = date("d/m/Y",strtotime($campo['datavenc']));
   
}

if (isset($_POST['cadastrar'])) {      // caso nao seja passado o id via GET cadastra 

    $cpfcnpj = $_POST['cpfcnpj'];
    $nome = $_POST['nome'];

    $data = $_POST['datanasc'];
    $dataP = explode('/', $data);
    $datanasc = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

    $endereco = $_POST['endereco'];
    $titulo = $_POST['titulo'];
    
    $data = $_POST['datavenc'];
    $dataP = explode('/', $data);   
    $datavenc =  $dataP[2].'-'.$dataP[1].'-'.$dataP[0];

    $crud = new crud('tb_clientes');      // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->inserir("cpfcnpj,nome,datanasc,endereco,titulo,datavenc", "'$cpfcnpj','$nome','$datanasc','$endereco','$titulo','$datavenc'"); // utiliza a funçao INSERIR da classe crud
    header("Location: index.php"); 
}

if (isset($_POST['editar'])) { // caso  seja passado o id via GET edita 
    $cpfcnpj = $_POST['cpfcnpj'];
    $nome = $_POST['nome'];

    $data = $_POST['datanasc'];
    $dataP = explode('/', $data);
    $datanasc = $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
    
    $endereco = $_POST['endereco'];
    $titulo = $_POST['titulo'];

    $data = $_POST['datavenc'];
    $dataP = explode('/', $data);   
    $datavenc =  $dataP[2].'-'.$dataP[1].'-'.$dataP[0];
    
    $crud = new crud('tb_clientes'); // instancia classe com as operaçoes crud, passando o nome da tabela como parametro
    $crud->atualizar("cpfcnpj='$cpfcnpj',nome='$nome',datanasc='$datanasc',titulo='$titulo',datavenc='$datavenc'", "id='$getId'"); // utiliza a funçao ATUALIZAR da classe crud
    header("Location: index.php"); // redireciona para a listagem
}

?>
<?php include_once 'includes/header.inc.php';
include_once 'includes/menu.inc.php';

?>
<div class="row container">
    <p>&nbsp;</p>

    <form action="" method="post">
        <!--   formulario carrega a si mesmo com o action vazio  -->

        <label>CPF/CNPJ:</label>
        <input type="text" name="cpfcnpj" value="<?php echo @$campo['cpfcnpj']; ?>" required autofocus maxlength="20" />
        <br />
        <br />
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo @$campo['nome']; ?>" required maxlength="50" />
        <br />
        <br />

        <label>Endere&ccedil;o:</label>
        <input type="text" name="endereco" value="<?php echo @$campo['endereco']; ?>" maxlength="100" />
        <br />
        <br />
        <label>Dta. Nascto:</label>   
             <input type="text" name="datanasc" value="<?php echo $datanasc; ?>"  maxlength="10"  />
        <br />
        <br />
        <label>Descri&ccedil;&atilde;o do T&iacute;tulo:</label>
        <input type="text" name="titulo" value="<?php echo @$campo['titulo'];  ?>" maxlength="50"/>
        <br />
        <br />
        <label>Dta. Vencto:</label>
        <input type="text" name="datavenc" value="<?php echo $datavenc;  ?>" maxlength="10" />
        <br />
        <br />
        <?php
        if (!@$getId) {   // se nao passar o id via GET nao está editando, mostra o botao de cadastro
        ?>
            <input type="submit" name="cadastrar" value="Cadastrar" />
        <?php } else { // se  passar o id via GET  está editando, mostra o botao de ediçao 
        ?>
            <input type="submit" name="editar" value="Salvar" />
        <?php } ?>
    </form>
</div>
<?php
include_once 'includes/footer.inc.php';
$con->disconnect(); 
?>