<?php
require_once(ROOT."models/authModel.php");
// var_dump($_REQUEST);
// var_dump($_FILES);
// die();
$login = function(){
    $save = [];
    $errors = [];


    if(isset($_REQUEST["envoie"])){
        $save = $_REQUEST;
        // var_dump($save);
        $errors = validateUserConnexion($save);
        if(empty($errors)){
            $email = $save["email"];
            $user = getClientByMail($email);
            if(!$user){
                $errors["email"] = "Aucun utilisateur n'a cet email";
            }else{
                if($save["mot_de_passe"]==$user["mot_de_passe"]){
                    $_SESSION["user"] = $user;
                    // var_dump($_SESSION["user"]);
                    // echo "connexion réussi";
                    if($_SESSION["user"]["role"] == "auteur"){
                        redirectTo("auth","auteurDashboard");
                    }else if($_SESSION["user"]["role"] == "admin"){
                        redirectTo("auth","adminDashboard");
                    }else if($_SESSION["user"]["role"] == "lecteur"){
                        redirectTo("articles","accueil");
                          
                    }
    
                }else{
                    $errors["mot_de_passe"] = "mot de passe ne corresponde pas";
                }
            }

        }
            
        }
        // require_once(ROOT."views/auth/login.php");
    loadView("auth/login",[
        "save" => $save,
        "errors" =>$errors
    ],"auth");
};

$inscrip = function(){
     $save = [];
    $errors = [];
    if(isset($_REQUEST["envoie"])){
        $save = $_POST;
        
        $errors = validateUserInscription($save);
        if($_FILES["photo"]["error"] == 0){
            $typesPhoto = ["image/jpeg" , "image/png","image/jpg"];
            if(!in_array($_FILES["photo"]["type"],$typesPhoto)){
                $errors["photo"] = "Veuillez donnez une image de type png ou jpeg";
            }
            if($_FILES["photo"]["size"] > 2097152){
                $errors["photo"] = "L'image ne doit pas dépasser 2 Mo";
            }
        }
        if(empty($errors)){
            $ext = pathinfo($_FILES["photo"]["name"],PATHINFO_EXTENSION);
            $nomPhoto = uniqid().".". $ext ;
            $destination = ROOT."public/uploads/photos/".$nomPhoto;
            if(move_uploaded_file($_FILES["photo"]["tmp_name"],$destination)){
                $save["photo"] = $nomPhoto;
                // var_dump($save);
                $dataUser = [
                    "nom"          => $save["nom"],
                    "prenom"       => $save["prenom"],
                    "telephone"    => $save["telephone"],
                    "email"        => $save["email"],
                    "mot_de_passe" => $save["mot_de_passe"],
                    "photo"        => $save["photo"],
                    "role"        =>$save["role"],
                ];
                saveUser($dataUser);
                // redirectTo("produits","listeProduit");
            }else{
                $errors["photo"] = "Erreur lors de l'enregistrement de l'image";
            }
        }

    
    }
loadView("auth/inscription",[
    "save" =>$save,
    "errors" => $errors
],"auth");
};

$deconnexion =function(){
    deconnexion();
    redirectTo("auth","login");
};
$adminDashboard =function(){
    loadView("dashboard/adminDashboard",[],"admin");
};
$auteurDashboard =function(){
    loadView("dashboard/auteurDashboard",[],"auteur");
};
$pages = [
    "login" => $login,
    "inscription" => $inscrip,
    "logOut" => $deconnexion,
    "adminDashboard" => $adminDashboard,
    "auteurDashboard" => $auteurDashboard,

];
$page = $_REQUEST["page"] ?? "inscription";

 if(array_key_exists($page,$pages)){
        $pages[$page]();
    }else {
        echo "page introuvable";
        exit();
    }