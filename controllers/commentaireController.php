<?php
require_once(ROOT."models/commentairesModel.php");
require_once(ROOT."models/articleModel.php");

$ajoutCommentaire = function(){
    $save = [];
    $errors = [];
    $id = isset($_POST["article_id"]) ? (int)$_POST["article_id"] : (int)($_GET["id"] ?? 0);
    if(isset($_REQUEST["publier"])){
        if (!isset($_SESSION["user"])) {
            header("Location: ?controller=auth&page=login");
            exit();
        }
        $save = $_POST;
        $errors = validateCommentaire($save);
        if(empty($errors)){
            $save["article_id"] = $id;
            $save["utilisateur_id"] = $_SESSION["user"]["id"];
            $save["date"] = date("Y-m-d");
            ajoutCommentaire($save);
            header("Location: ?controller=articles&page=detailArticle&id=" . $id);
            exit();
        }
    }
        $article = getDetailArticle($id);
        $commentaires = getCommentairesByArticle($id);

    
loadView("articles/detailArticle", compact("article", "id", "commentaires", "errors"), "base");   
};


$pages = [
    "ajoutCommentaire" =>  $ajoutCommentaire ,
];
$page = $_REQUEST["page"] ?? "ajoutCommentaire";

if(array_key_exists($page,$pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}