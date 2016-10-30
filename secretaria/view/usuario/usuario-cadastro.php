<?php
include("../../../conf/config.php");
?>



<!DOCTYPE html>
<html>
<head>
	<title>Cadastro :: Usuário</title>
	<!-- Topo para Menu Iniciar e Voltar -->
<link rel="stylesheet" href="../../../css/bootstrap.min.css" type="text/css">
<link href='../../../fonts/apigoogle01.css' rel='stylesheet' type='text/css'>
<link href='../../../fonts/apigoogle02.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../../font-awesome/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="../../../css/animate.min.css" type="text/css">
<link rel="stylesheet" href="../../../css/creative.css" type="text/css">

</head>
<body>


<a class="navbar-brand page-scroll" href="../../../index.html">Inicio</a>
<a class="navbar-brand page-scroll" href="javascript:window.history.go(-1)">Voltar</a>   


<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="section-heading text-center">Cadastro de Usuário</h1>
                <hr class="primary">
                <form id="" name="" action="../../php/salvar_usuario.php" method="post">
                	<fieldset>
                		<legend>Dados Pessoais</legend>
                		<div class="row">
											<div class="col-md-6">
											    <label>Nome</label>
											    <div class="form-group input-group">
											        <span class="input-group-addon"><i class="fa fa-user"></i></span>
											        <input class="form-control" type="text" name="nome" placeholder="Nome">
											    </div>
											</div>
											<div class="col-md-2">
	                      <label>Sexo</label>
	                      <div class="form-group input-group">
	                      <select id="sexo" name="sexo_id" placeholder="Sexo" class="form-control">
	                          <option value="">Escolha o sexo</option>
	                          <?php
	                          $result = $db->prepare ("SELECT id, nome FROM sexo ORDER BY nome ASC");
	                          $result->execute();
	                          while ($sexo = $result->fetch(PDO::FETCH_ASSOC)) {
	                              ?>
	                              <option value="<?= $sexo['id'];?>"><?= utf8_encode($sexo['nome'])?></option>
	                              <?php
	                          }
	                          ?>
	                      </select>
	                    </div>
		                  </div>
											<div class="col-md-2">
		                      <label>Nascimento</label>
		                      <div class="form-group input-group">
		                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                          <input class="form-control" type="text" name="data_nascimento" placeholder="Nascimento">
		                      </div>
		                  </div>
	                  </div>
                	</fieldset>
                	</br>
                  <fieldset>
                      <legend>Dados de Contato</legend>                        
                          <div class="row">
                              <div class="col-md-4">
                                  <label>E-mail</label>
                                  <div class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                      <input class="form-control" type="text" name="email" placeholder="Email"> 
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <label>Celular</label>
                                  <div class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                      <input class="form-control" type="text" name="celular" placeholder="Celular">
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <label>Telefone</label>
                                  <div class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                                      <input class="form-control" type="text" name="telefone" placeholder="Telefone">
                                  </div>
                              </div>
                          </div>
                  </fieldset>
									</br>
                  <fieldset>
                      <legend>Dados de Endereço</legend>
                      <div class="row">
                          <div class="col-md-2">
                              <label>CEP</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                  <input class="form-control" type="text" name="cep" placeholder="CEP">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <label>Rua</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                  <input class="form-control" type="text" name="rua" placeholder="Rua">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <label>Número</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                  <input class="form-control" type="text" name="numero" placeholder="Número">
                              </div>
                          </div>
                          <div class="col-md-2">
                              <label>Bairro</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                  <input class="form-control" type="text" name="bairro" placeholder="Bairro">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Complemento</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
                                  <input class="form-control" type="text" name="complemento" placeholder="Complemento">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <label>Comunidade</label>
                              <div class="form-group input-group">
                              <span class="input-group-addon"><i class=" fa fa-list-alt"></i></span>
                              <select id="comunidade" name="comunidade_id" placeholder="Comunidade" class="form-control">
                                  <option value="">Escolha a comunidade</option>
                                  <?php
                                  $result = $db->prepare ("SELECT id, nome FROM comunidade ORDER BY nome ASC");
                                  $result->execute();
                                  while ($comunidade = $result->fetch(PDO::FETCH_ASSOC)) {
                                      ?>
                                      <option value="<?= $comunidade['id'];?>"><?= utf8_encode($comunidade['nome'])?></option>
                                      <?php
                                  }
                                  ?>
                              </select>
                              </div>
                          </div>
                      </div>
                  </fieldset>
									</br>
                  <fieldset>
                      <legend>Dados de Acesso ao Sistema</legend>
                      <div class="row">
                          <div class="col-md-4">
                              <label>Login</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input class="form-control" type="text" name="login" placeholder="Login">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Senha</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                  <input class="form-control" type="password" name="senha" placeholder="Senha">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <label>Confirmar Senha</label>
                              <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                  <input class="form-control" type="password" name="confirmar_senha" placeholder="Confirmar Senha">
                              </div>
                          </div>
                      </div>
                  </fieldset>
							      </br>
							      <div align="center">
							      <button type="subimit" class="btn btn-primary btn-lg">
							          <i class="fa fa-cloud-upload"></i>
							          Cadastrar
							      </button>
							      </div>
                </form>
            </div>
        </div>
        <div><!-- Informações do calendário paroquial--></div>
    </div>
</section>

</body>
</html>