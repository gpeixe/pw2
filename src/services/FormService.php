<?php 
class FormService {
    private $errors = [];
    private $validParams = [];
    private $params;

    public function execute ($params) {
        $this->params = $params;
        $this->validateName();
        $this->validateAge();
        $this->validateEmail();
        $this->validateState();
        $this->validateFoods();
        $this->validateDeliveryMode();
        $hasErrorsOrValidParams= count($this->errors) != 0 || count($this->validParams) != 0;
        $response = $hasErrorsOrValidParams ? array("errors" => $this->errors, "validParams" => $this->validParams) : false;
        return $response;
    }

    private function verifyIfFieldIsEmptyOrIsNotSet ($field) {
        $isset = isset($this->params["$field"]);
        $empty = empty($this->params["$field"]);
        if (!$isset|| $empty) {
            return true;
        }
        return false;
    }

    private function validateName () {
        $nameIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("name"); 
        if ($nameIsNotEmpty) {
            $name = $this->params["name"];
            $nameLength = strlen($name);
            if ($nameLength >= 4 && $nameLength <= 10) {
                array_push($this->validParams, "O campo nome está ok");
            } else {
                array_push($this->errors, 'O nome deve ser enviado e ter de 4 a até 10 caracteres no máximo!');
            }
        } else {
            array_push($this->errors, 'O campo nome está vazio!');
        }
    }

    private function validateAge () {
        $ageIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("age"); 
        if ( $ageIsNotEmpty) {
            $age = $this->params["age"];
            if ($age >= 18 && $age <= 60) {
                array_push($this->validParams, "O campo idade está ok!");
            } else {
                array_push($this->errors, 'A idade deve ser enviado e ser maior ou igual a 18 anos, e menor ou igual a 60 anos.');
            }
        } else {
            array_push($this->errors, 'O campo idade está vazio!');
        }
    }
    
    private function validateEmail () {
        $emailIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("email"); 
        if ($emailIsNotEmpty) {
            $email = $this->params["email"];
            $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
            if (preg_match($regex, $email)) {
                array_push($this->validParams, "O campo email está ok!");
            } else {
                array_push($this->errors, 'O email deve ser válido!');
            }
        } else {
            array_push($this->errors, 'O campo email está vazio!');
        }
    }

    private function validateState () {
        $stateIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("state"); 
        if ($stateIsNotEmpty) {
            $state = $this->params["state"];
            $stateNumber = intval($state);
            if ($stateNumber == 1 || $stateNumber == 2 || $stateNumber == 3) {
                array_push($this->validParams, "O campo estado cívil está ok");
            } else {
                array_push($this->errors, 'O estado civil deve ser enviado e não pode ser "vazio". Só pode aceitar valores 0, 1 e 2!');
            }
        } else {
            array_push($this->errors, 'O campo estado civil está vazio!');
        }
    }

    private function validateFoods () {
        $foodsIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("foods"); 
        if ($foodsIsNotEmpty) {
            $foods = $this->params["foods"];
            $foodsLength = count($foods);
            if ($foodsLength >= 3) {
                array_push($this->validParams, "O campo comida está ok!");
            } else {
                array_push($this->errors, 'O campo comida deve ter no mínimo 3 elementos');
            }
        } else {
            array_push($this->errors, 'O campo comida está vazio!');
        }
    }

    private function validateDeliveryMode () {
        $deliveryModeIsNotEmpty = !$this->verifyIfFieldIsEmptyOrIsNotSet("deliveryMode"); 
        if ($deliveryModeIsNotEmpty) {
            $deliveryMode = $this->params['deliveryMode'];
            if ($deliveryMode == 1 || $deliveryMode == 2) {
                array_push($this->validParams, "O campo modo de entrega está ok!");
            } else {
                array_push($this->errors, 'O campo modo de entrega tem que ser 1 ou 2.');
            }
        } else {
            array_push($this->errors, 'O campo modo de entrega está vazio!');
        }
    }
}
?>