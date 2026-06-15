<?php

function routes(){
    return  [
        "auth" => ROOT."controllers/authController.php",
        "articles" => ROOT."controllers/articleController.php",
        "categories" => ROOT."controllers/categorieController.php",
        "commentaires" =>ROOT."controllers/commentaireController.php",
        "signalArticles" => ROOT."controllers/signalementArtController.php",
        "signalCommentaires" => ROOT."controllers/signalCommentController.php",

    ];
}
function gestionController(){
    $routes = routes();
    $controller = $_REQUEST["controller"] ?? "articles";
    $page = $_REQUEST["page"] ?? null;
    $user = $_SESSION["user"]["role"] ?? null;
    if(!array_key_exists($controller, $routes)){
        echo "controleur introuvable";
        return;
    }

    if(!$user){
        $pagesPubliques = [
            "articles" => ["accueil","detailArticle"],
            "auth" => ["login", "inscription"]
        ];

        if(array_key_exists($controller, $pagesPubliques) && in_array($page, $pagesPubliques[$controller])){
            require_once($routes[$controller]);
            return;
        } else {
            require_once($routes["articles"]);
            return;
        }
    }
         
   if($user == "admin"){
       require_once($routes[$controller]);
       return;
   }
     $pageUser =[];
    if($user == "lecteur"){
        $pageUser = [
            "articles" =>["accueil","detailArticle",],
            "auth" => ["logOut"],
            "commentaires" => ["ajoutCommentaire"],
            "signalArticles" => ["ajoutSignalArticle"],
            "signalCommentaires" => ["ajoutSignalCommentaires"],
        ] ;
        }
        if($user == "auteur"){
             $pageUser = [
            "articles" =>["accueil","detailArticle","ajoutArticle","articleAuteur" , "detailArticle"],
            "auth" => ["logOut","auteurDashboard"],
            "commentaires" => ["ajoutCommentaire"],
            "signalArticles" => ["ajoutSignalArticle"],
            "signalCommentaires" => ["ajoutSignalCommentaires"],
        ] ;
};
if(array_key_exists($controller,$pageUser) && (in_array($page,$pageUser[$controller])) ){
            require_once($routes[$controller]);
            return;
        }else{
            echo "Accés interdit";
            return;
        }
   
   
  
}