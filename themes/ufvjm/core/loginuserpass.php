<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo SimpleSAML_Module::getModuleURL('themeufvjm/ufvjm.ico'); ?>">

    <title><?php echo "UFVJM - Universidade Federal dos Vales do Jequitinhonha e Mucuri"; ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo SimpleSAML_Module::getModuleURL('themeufvjm/libs/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo SimpleSAML_Module::getModuleURL('themeufvjm/libs/css/signin.css'); ?>" rel="stylesheet">

    <script src="<?php echo SimpleSAML_Module::getModuleURL('themeufvjm/libs/js/bootstrap.min.js'); ?>"> </script>
</head>

<?php
    $authStateId = $_REQUEST['AuthState'];

    // Retrieve the authentication state.
    $state = SimpleSAML_Auth_State::loadState($authStateId, sspmod_core_Auth_UserPassBase::STAGEID);
    //var_dump($state['SPMetadata']);

    if (array_key_exists('SPMetadata', $state)){
        $SPentityID                = $state['SPMetadata']['entityid'];
    //    $SPName                    = $state['SPMetadata']['name']['en'];
    //    $SPDisplayName             = $state['SPMetadata']['UIInfo']['DisplayName']['en'];
    //    $SPDescription             = $state['SPMetadata']['UIInfo']['Description']['en'];
    //    $SPOrganizationName        = $state['SPMetadata']['OrganizationName']['en'];
    //    $SPOrganizationDisplayName = $state['SPMetadata']['OrganizationDisplayName']['en'];
    //    $SPOrganizationURL         = $state['SPMetadata']['OrganizationURL']['en'];

        $SPinfo = $SPentityID;
        if (array_key_exists('en', $state['SPMetadata']['UIInfo']['DisplayName'])) {
            $SPinfo = $state['SPMetadata']['UIInfo']['DisplayName']['en'];
        }
        elseif (array_key_exists('en', $state['SPMetadata']['OrganizationName'])){
            $SPinfo = $state['SPMetadata']['OrganizationName']['en'];
        }
        elseif (array_key_exists('en', $state['SPMetadata']['OrganizationDisplayName'])){
            $SPinfo = $state['SPMetadata']['OrganizationDisplayName']['en'];
        }
        elseif (array_key_exists('en', $state['SPMetadata']['name'])){
            $SPinfo = $state['SPMetadata']['name']['en'];
        }
    }
    else {    $SPinfo = "Provedor de Serviços não especificado";}
?>

<body class="login">
    <div class="container" id="wrap">

        <div class="row" id="topo">
            <div class="col-md-12 page-header">
                <img align="left" alt="logo" src="<?php echo SimpleSAML_Module::getModuleURL('themeufvjm/ufvjm.png') ?>"/>
            </div>
        </div>

        <div id="space"></div>

        <div class="row jumbotron" id="caixa">
            <div class="col-md-5";">
                <h5><b>Foi solicitado a autenticação para o serviço:</b></h5>

                <h6><?php echo "$SPinfo";?></h6> 

                <form class="form-signin" name="loginform" id="loginform" method="post">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Login" required autofocus>
                    <input type="password" name="password" id="user_pass" class="form-control" placeholder="Senha" required>
                    <div class="checkbox">
                        <label>
                            <input name="rememberme" type="checkbox" id="rememberme" value="forever">Lembrar
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

                    <!-- MENSAGEM DE ERRO -->
                    <?php
                    if ($this->data['errorcode'] !== NULL) {
                    ?>
                        <div id="error">
                            <img src="/<?php echo $this->data['baseurlpath']; ?>resources/icons/experience/gtk-dialog-error.48x48.png" style="float: left; margin: 10px " />
 	                    <h4><?php echo "Erro de login"; ?></h4>
	 	            <p><b><h5><?php echo "Nome de usuário ou senha inválidos."; ?></h5></b></p>
                        </div>

                    <?php
                    }


                    if(!empty($this->data['links'])) {
                        echo '<ul class="links" style="margin-top: 2em">';
                        foreach($this->data['links'] AS $l) {
                            echo '<li><a href="' . htmlspecialchars($l['href']) . '">' . htmlspecialchars($this->t($l['text'])) . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>

                    <?php
                    foreach ($this->data['stateparams'] as $name => $value) {
	                echo('<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars($value) . '" />');
                    }
                    ?>
	        </form>
            </div>

            <div class="col-md-7">
                <ul>
                    <h5><b>Serviço de Autenticação Federada</b></h5>
    		    <h5><b>Dicas de Segurança</b></h5>
    		    <p><h5>Feche seu navegador web quando acabar de usar o serviço que requisitou autenticação, principalmente se estiver utilizando um computador compartilhado.</h5></p>
    		    <p><h5>Nunca forneça seu login ou senha através de email ou um formulário fora dos servidores da UFVJM.</h5></p>
		</ul>
            </div>

        </div> <!-- /row -->
    </div> <!-- /container -->

    <div class="container" id="footer">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5 align="middle">UNIVERSIDADE FEDERAL DOS VALES DO JEQUITINHONHA E MUCURI</h5>
                <h5 align="middle">Campus JK, Rodovia MGT 367 - Km 583, nº 5000, Alto da Jacuba CEP 39100-000 • Diamantina/MG</h5>
                <h5 align="middle">Telefones: +55 (38) 3532-1200 e +55 (38) 3532-6000</h5> 

            </div>
        </div> <!-- /row -->
    </div> <!-- /container -->

</body>
</html>
