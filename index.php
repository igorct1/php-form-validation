<?php 
$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroRepeteSenha = "";

// Verificar se o request method é = post
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar se está vazio o post nome
    if(empty($_POST['nome'])) {
      $erroNome = "Por favor digite um nome valido";
    } else {
      //Pegar o valor vindo do post e limpar
      $nome = limpaPost($_POST['nome']);
      //Verificar se tem somente letras, espaços e apóstrofos
      if(!preg_match("/^[a-zA-Z-' ]*$/", $nome) || ($nome == "")) {
       $erroNome = "Apenas aceitamos letras e espaços em branco!";
      }

    }
    // Email
    if(empty($_POST['email'])) {
      $erroEmail = "Por favor digite um email valido";
    } else {
      $email = limpaPost($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroNome = "Seu email é invalido";
      }
    }
    
    //Senha
    if(empty($_POST['senha'])) {
      $erroSenha = "Por favor digite uma senha";
    } else {
      $senha = limpaPost($_POST['senha']);
      if(strlen($senha) < 6) {
        $erroSenha = "Senha precisa ter no minimo 6 digitos";
      }
    }
    //Repete senha
    if(empty($_POST['repete_senha'])) {
      $erroRepeteSenha = "Por favor digite uma senha";
    } else {
      $repete_senha = limpaPost($_POST['repete_senha']);
      if($repete_senha !== $senha) {
        $erroRepeteSenha = "A repetição da senha está incorreta";
      }
    }
    //Se não tiver nenhum erro enviar para obrigado!
    if(($erroNome=="") && 
    ($erroEmail=="") && 
    ($erroSenha=="") && 
    ($erroRepeteSenha=="")){
      header('Location: obrigado.php');
    } 
  }

  //função para segurança básica.
  function limpaPost($valor) {
    $valor = trim($valor);
    $valor = stripslashes($valor);
    $valor = htmlspecialchars($valor);
    return $valor;
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>AULA PHP</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input
        <?php 
        if(!empty($erroNome)) {
          echo "class='invalido'";
        }
        if(isset($_POST['nome'])) {
          echo "value='".$_POST['nome']."'";
        }
        ?> 
        type="text" 
        name="nome" 
        placeholder="Digite seu nome" >
        <br><span class="erro">
          <?php echo $erroNome; ?>
        </span>
 
        <!-- EMAIL -->
        <label> E-mail </label>
        <input
        <?php 
        if(!empty($erroEmail)) {
          echo "class='invalido'";
        }
        if(isset($_POST['email'])) {
          echo "value='".$_POST['email']."'";
        }
        ?> 
        type="email"
        name="email" 
        placeholder="email@provedor.com" >
        <br><span class="erro">
        <?php echo $erroEmail; ?>
        </span>

        <!-- SENHA -->
        <label> Senha </label>
        <input 
        <?php 
        if(!empty($erroSenha)) {
          echo "class='invalido'";
        }
        if(isset($_POST['senha'])) {
          echo "value='".$_POST['senha']."'";
        }
        ?> 
        type="password" 
        name="senha" 
        placeholder="Digite uma senha" >
        <br><span class="erro"><?php echo $erroSenha; ?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password"
        <?php 
        if(!empty($erroRepeteSenha)) {
          echo "class='invalido'";
        }
        if(isset($_POST['repete_senha'])) {
          echo "value='".$_POST['repete_senha']."'";
        }
        ?> 
          name="repete_senha" 
          placeholder="Repita a senha" >
        <br><span class="erro">
        <?php echo $erroRepeteSenha; ?>
        </span>
        <button type="submit"> Enviar Formulário </button>
      </form>
    </main>
</body>
</html>