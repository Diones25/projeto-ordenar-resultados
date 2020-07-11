<?php
    try{
        $pdo = new PDO("mysql:dbname=projeto_ordenar;host=localhost", "root", "");

    }catch(PDOException $e){
        echo "A conexão falhou! ".$e->getMessage();
        exit;
    }

    if(isset($_GET['ordem']) && empty($_GET['ordem']) == false){
        $ordem = addslashes($_GET['ordem']);
        $sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
    }
    else{
        $ordem = '';
        $sql = "SELECT * FROM usuarios";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Ordenar</title>
</head>
<body>
    <div class="container">
        <form action="" method="get">
            <span>
                Listar por:
            </span>
            <select name="ordem" onchange="this.form.submit()">
                <option value=""></option>
                <option value="nome" <?php echo ($ordem == "nome")?'selected="selected"':''; ?>>Pelo nome</option>
                <option value="idade" <?php echo ($ordem == "idade")?'selected="selected"':''; ?>>Pela idade</option>
            </select>
        </form>
    </div>
    
    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Idade</th>
            </tr>
        </thead>
        <?php

            

            $sql = $pdo->query($sql);

            if($sql->rowCount() > 0){
                foreach($sql->fetchAll() as $usuario){
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $usuario['nome']?></td>
                                <td><?php echo $usuario['idade']?></td>
                            </tr>
                        </tbody>
                    <?php
                }
            }

        ?>    
    </table>


    <style>
        table{
            border-collapse: collapse;
            width: 500px;
            margin: 0 auto;
        }
        .container{
            max-width: 500px;
            width: 100%;
            margin: 10px auto 40px;
        }
    </style>
</body>
</html>