<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <style>
        body {
            background-color:#f2f2f2;
            font-size:17px;
        }
    </style>
</head>

<body>
        <div class="position-absolute top-50 start-50 translate-middle text-left">
        <div class="card">
        <div class="card-body">
                        <form action="processa_login.php" method="POST">
                        <div class="mb-3">
        
                            <label>E-mail</label>
                            <input type="email" id="email" name="email" 
                            class="form-control">
                        </div>
    
                        <div class="mb-3">
                                    <label>Senha</label>
                                        <input type="password" id="senha" 
                                        name="senha" class="form-control">
                        </div>
                <button type="submit" class="btn btn-primary">Entrar</button><br>
                <center><a href="./recup_senha.php" class="senha">Esqueceu a senha?
                </a><br></center>

        </form>
        <?php
                if (isset($_GET['erro'])) 
                { 
                if ($_GET['erro'] == "dadosinvalidos") { 
                echo "<p style='color:#ff0000;font-weight:bold;'>
                Usuário e/ou senha inválidos.</p>"; 
            }
        }
          ?>  
    </div>
    </div>
    </div>
    
    <script src="../js/bootstrap.js"></script>
</body>
</html>