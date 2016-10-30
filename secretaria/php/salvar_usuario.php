<?php
include_once("../../conf/config.php");



	$nome							= $_POST['nome'];
	$sexo_id 					= $_POST['sexo_id'];
	$data_nascimento  = $_POST['data_nascimento'];
	$email						= $_POST['email'];
	$celular					= $_POST['celular'];
	$telefone					= $_POST['telefone'];
	$cep							= $_POST['cep'];
	


	$sql = 'INSERT INTO usuario (nome, sexo_id, data_nascimento, email, celular, telefone, cep) 
					VALUES (:nome, :sexo_id, :data_nascimento, :email, :celular, :telefone, :cep)';

	
		$create = $db->prepare($sql);
		$create->bindValue(':nome', utf8_encode($nome), PDO::PARAM_STR);
		$create->bindValue(':sexo_id', $sexo_id, PDO::PARAM_STR);
		$create->bindValue(':data_nascimento', date_format(DateTime:: createFromFormat("d/m/Y", $data_nascimento), "Y-m-d"), PDO::PARAM_STR);
		$create->bindValue(':email', $email, PDO::PARAM_STR);
		$create->bindValue(':celular', $celular, PDO::PARAM_STR);
		$create->bindValue(':telefone', $telefone, PDO::PARAM_STR);
		$create->bindValue(':cep', $cep, PDO::PARAM_STR);

		$create->execute();


    $db->commit();

?>