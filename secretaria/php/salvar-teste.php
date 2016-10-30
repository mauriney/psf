<?php


$db= Conexao::getInstance();


$usuario_nome 						= strip_tags(@$_POST['nome']);
$usuario_sexo							= strip_tags(@$_POST['sexo']);
$usuario_data_nascimento	= strip_tags(@$_POST['data_nascimento']);
$usuario_email						= strip_tags(@$_POST['email']);
$usuario_celular					= strip_tags(@$_POST['celular']);
$usuario_telefone					= strip_tags(@$_POST['telefone']);
$usuario_cep							= strip_tags(@$_POST['cep']);
$usuario_rua							= strip_tags(@$_POST['rua']);
$usuario_numero						= strip_tags(@$_POST['numero']);
$usuario_bairro						= strip_tags(@$_POST['bairro']);
$usuario_complemento			= strip_tags(@$_POST['complemento']);
$usuario_comunidade				= strip_tags(@$_POST['comunidade']);
$usuario_login						= strip_tags(@$_POST['login']);
$usuario_senha						= strip_tags(@$_POST['senha']);
$usuario_confirmar_senha	= strip_tags(@$_POST['confirmar_senha']);



try {
	//VERIFICA SE O NOME DO USUÁRIO JÁ FOI INFORMADO
	$id_nome = pesquisar("id", "usuario", "nome", "=", $usuario_nome, "");
  if (is_numeric($id_nome) && $id_nome != @$_POST['id']) {
    $error = true;
    $mensagem .= "<span>O nome do usuário informado já existe no sistema.</span>";
    $msg['tipo'] = "nome";
	}
  //VERIFICA SE O LOGIN DO USUÁRIO JÁ FOI INFORMADO
  $id_login = pesquisar("id", "usuario", "login", "=", $usuario_login, "");
  if (is_numeric($id_login) && $id_login != @$_POST['id']) {
      $error = true;
      $mensagem .= "<span>O login do usuário informado já existe no sistema.</span>";
      $msg['tipo'] = "login";
  }	

  if ($error == false) {
  	$db->beginTransaction();

  	if (isset($_POST['id']) && @$_POST['id'] != ''){//CASO USUÁRIO JÁ ESTEJA CADASTRADO
  		$stmt = $db->prepare("UPDATE usuario set nome = ?, sexo_id = ?, data_nascimento = ?, email = ?, celular = ?, telefone = ?, cep = ?, rua = ?, numero = ?, bairro = ?, complemento = ?, comunidade_id = ?, login = ?, senha = ?, confirmar_senha = ?");
  		$stmt->bindValue(1, utf8_encode($usuario_nome));
  		$stmt->bindValue(2, utf8_encode($usuario_sexo));
  		$stmt->bindValue(3, date_format(DateTime::createFromFormat("d/m/y", $usuario_data_nascimento), "Y-m-d"));
  		$stmt->bindValue(4, $usuario_email);
  		$stmt->bindValue(5, $usuario_celular);
  		$stmt->bindValue(6, $usuario_telefone);
  		$stmt->bindValue(7, $usuario_cep);
  		$stmt->bindValue(8, utf8_encode($usuario_rua));
  		$stmt->bindValue(9, $usuario_numero);
  		$stmt->bindValue(10, utf8_encode($usuario_bairro));
  		$stmt->bindValue(11, utf8_encode($usuario_complemento));
  		$stmt->bindValue(12, utf8_encode($usuario_comunidade));
  		$stmt->bindValue(13, $usuario_login);
  		$stmt->bindValue(14, $usuario_senha);
  		$stmt->bindValue(15, $usuario_confirmar_senha);
  		$stmt->bindValue(16, $_POST['id']);

  		$stmt->execute();
  		//RETORNAR O ID DO USUARIO
  		$usuario_id = $_POST['id'];

  		//ALTERANDO SENHA CASO A SENHA TENHA SIDO TROCADA
  		if ($usuario_senha != "" && sha1($usuario_senha) != pesquisar("senha", "usuario", "id", "=", $usuario_id, "")) {
  			$stmt1 = $bd->prepare("UPDATE usuario set senha = ? WHERE id = ?");
  			$stmt1->bindValue(1, sha1($usuario_senha));
  			$stmt1->bindValue(2, $usuario_id);
  			$stmt1->execute();
  		}
  	}


    $db->commit();

    //MENSAGEM DE SUCESSO
    $msg['id'] = $usuario_id;
    $msg['msg'] = 'success';
    $msg['retorno'] = 'Usuário atualizado com sucesso.';
    echo json_encode($msg);
    exit(); 

	  } else { //CASO O USUARIO NÃO ESTEJA CADASTRADO
	  	$stmt = $db->prepare("INSERT INTO usuario (nome, sexo_id, data_nascimento, email, celular, telefone, cep, rua, numero, bairro, complemento, comunidade_id, login, senha, confirmar_senha)
														VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bindValue(1, utf8_encode($usuario_nome));
			$stmt->bindValue(2, utf8_encode($usuario_sexo));
			$stmt->bindValue(3, date_format(DateTime::createFromFormat("d/m/y", $usuario_data_nascimento), "Y-m-d"));
			$stmt->bindValue(4, $usuario_email);
			$stmt->bindValue(5, $usuario_celular);
			$stmt->bindValue(6, $usuario_telefone);
			$stmt->bindValue(7, $usuario_cep);
			$stmt->bindValue(8, utf8_encode($usuario_rua));
			$stmt->bindValue(9, $usuario_numero);
			$stmt->bindValue(10, utf8_encode($usuario_bairro));
			$stmt->bindValue(11, utf8_encode($usuario_complemento));
			$stmt->bindValue(12, utf8_encode($usuario_comunidade));
			$stmt->bindValue(13, $usuario_login);
			$stmt->bindValue(14, $usuario_senha);
			$stmt->bindValue(15, $usuario_confirmar_senha);

			$stmt->execute();
			//RETORNAR O ID DO USUARIO
			$usuario_id = $db->lastInsertId();



	    $db->commit();

	    //MENSAGEM DE SUCESSO
	    $msg['id'] = $usuario_id;
	    $msg['msg'] = 'success';
	    $msg['retorno'] = 'Usuário cadastrado com sucesso.';
	    echo json_encode($msg);
	    exit();
	  }
  
} catch (PDOException $e) {
    $db->rollback();
    $msg['msg'] = 'error';
    $msg['retorno'] = "Erro ao tentar salvar os dados do usuário: " . $e;
    echo json_encode($msg);
    exit();
}
?>
