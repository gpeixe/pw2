<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo formulário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <header class="header has-text-centered my-6">
        <h1 class="title is-1">Exericio PHP - Recebimento de dados</h1>
    </header>
    <main>
        <div class="columns">
            <form class="column is-offset-1 is-3" method="POST">
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control">
                        <input class="input" type="text" name="name" placeholder="Nome">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Idade</label>
                    <div class="control">
                        <input class="input" type="number" placeholder="Idade" name="age">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Seu e-mail" name="email">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Estado civil</label>
                    <div class="control">
                        <div class="select">
                            <select name="state">
                             <option value="0">--</option>
                                <option value="1">Solteiro</option>
                                <option value="1">Casado</option>
                                <option value="2">Viúvo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">O que você gostaria de comer hoje?</label>
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="0"> Peito de frango
                        </label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="1"> Bife de alcatra
                        </label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="2"> Purê de batatas
                        </label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="3"> Arroz
                        </label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="4"> Batata-frita
                        </label>
                        <br>
                        <label class="checkbox">
                            <input type="checkbox" name="foods[]" value="5"> Salada verde
                        </label>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="label">Forma de entrega?</label>
                        <label class="radio">
                            <input type="radio" name="deliveryMode" value="1">
                            Entrega
                        </label>
                        <br>
                        <label class="radio">
                            <input type="radio" name="deliveryMode" value="2">
                            Buscar
                        </label>
                    </div>
                </div>

                <div class="field is-grouped has-text-centered is-center">
                    <div class="control">
                        <button class="button is-dark">Enviar</button>
                    </div>
                    <div class="control">
                        <button type="reset" class="button is-dark is-light">Limpar</button>
                    </div>
                </div>
            </form>
            <div class="column is-4 content">
                <p>Regras do formulário:</p>
                <ul>
                    <li>O nome deve ser enviado e ter de 4 a até 10 caracteres no máximo!</li>
                    <li>A idade deve ser enviado e ser maior ou igual a 18 anos, e menor ou igual a 60 anos.</li>
                    <li>O email deve ser válido</li>
                    <li>O estado civil deve ser enviado e não pode ser "vazio". Só pode aceitar valores 0, 1 e 2.</li>
                    <li>A lista de comida deve receber exatamente 3 itens selecionados. Os valores recebidos devem ser números de 0 a 5.</li>
                    <li>Uma forma de entrega deve ser selecionada. Apenas números 1 e 2 são aceitos.</li>
                </ul>
            </div>
            <div class="column is-5 content">
                <?php 
                    include "./formulario.php";
                    $formService = new FormService();
                    $response = $formService->execute($_POST);
                    if ($response != false) {
                        $errors = $response["errors"];
                        $validParams = $response["validParams"];
                        for ($i = 0; $i < count($errors); $i++) {
                            echo "<br> Erro: " . $errors[$i];
                        }
                        for ($i = 0; $i < count($validParams); $i++) {
                            echo "<br> Válido: " . $validParams[$i];
                        }
                    }   
                ?>
            </div>
        </div>
    </main>
</body>

</html>