<php 
function verifyIfFieldIsEmpty ($field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        return true;
    }
    return false;
} 

$errors = [];
$validParams = [];

if (!verifyIfFieldIsEmpty("name") ) {
    $name = $_POST["name"];
    $nameLength = count($name);
    if ($nameLength >= 4 && $nameLength <= 10) {
        array_push($validParams, "O campo nome está ok");
    } else {
        array_push($errors, 'O nome deve ser enviado e ter de 4 a até 10 caracteres no máximo!');
    }
} else {
    array_push($errors, 'O campo nome está vazio!');
}

if (!verifyIfFieldIsEmpty("age")) {
    $age = $_POST["age"];
    if ($age >= 18 && $age <= 60) {
        array_push($validParams, "O campo idade está ok!");
    } else {
        array_push($errors, 'A idade deve ser enviado e ser maior ou igual a 18 anos, e menor ou igual a 60 anos.');
    }
} else {
    array_push($errors, 'O campo idade está vazio!');
}

if (!verifyIfFieldIsEmpty("email")) {
    $email = $_POST["email"];
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if (preg_match($regex, $email)) {
        array_push($validParams, "O campo email está ok!"]);
    } else {
        array_push($errors, 'O email deve ser válido!');
    }
} else {
    array_push($errors, 'O campo email está vazio!');
}

if (!verifyIfFieldIsEmpty("state")) {
    $state = $_POST["state"];
    if ($state == 0 || $state == 1 || $state == 2) {
        array_push($validParams, "O campo estado cívil está ok");
    } else {
        array_push($errors, 'O estado civil deve ser enviado e não pode ser "vazio". Só pode aceitar valores 0, 1 e 2!');
    }
} else {
    array_push($errors, 'O campo estado civil está vazio!');
}

if (!verifyIfFieldIsEmpty("name")) {
    $foods = $_POST["foods"];
    $foodsLength = count($name);
    if ($foodsLength >= 3) {
        array_push($validParams, "O campo nome está ok!");
    } else {
        array_push($errors, 'O campo comida deve ter no mínimo 3 elementos');
    }
} else {
    array_push($errors, 'O campo comida está vazio!');
}

foreach ($validParams as &$param) {
   echo "<br><span class="valid">$param</span></br>";
}

foreach ($errors as &$error) {
   echo "<br><span class="error">$error</span></br>";
}

?>