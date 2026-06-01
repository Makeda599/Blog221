<?php
function validate(array $data,array $rules) {
    $errors = [];
    foreach ($rules as $key => $rule ){

    $value = $data[$key] ?? null;
    
    foreach($rule as $uneRegle){
        if($uneRegle == "obligatoire" && empty($value)){
            $errors[$key] ="Le champ ".$key." est obligatoire";
            break;
        }
        if($uneRegle == "email" ){
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$key] = "Le format de l'email est invalide";
                }
        };
            if (strpos($uneRegle, "regex:") === 0) {
                $pattern = str_replace("regex:", "", $uneRegle);
                if (!preg_match($pattern, $value)) {
                    $errors[$key] = "Le format du champ " . $key . " est invalide";
                }
            }
    }
  
    }
    return $errors;
}
