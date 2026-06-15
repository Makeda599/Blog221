<?php
require_once(ROOT."models/signalementArticlesModel.php");
require_once(ROOT."models/articleModel.php");

$ajout = function(){
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $article = getDetailArticle($id);
        $save = [];
        $errors = [];
        if(isset($_REQUEST['envoyer_signalement'])){
            $save = $_POST;
            if (isset($_POST['motif_select']) && $_POST['motif_select'] !== 'Autre') {
                $save['motif'] = $_POST['motif_select'];
            }
            $errors =  validateSignalArticle($save);
            if(empty($errors)){
            $save["date_signalement"] = date("Y-m-d");
            $save["article_id"] = $id;
            $save["statut"] = "en_attente";
            // dd($save);
            ajoutSignalArticle($save);
            redirectTo("articles","detailArticle&id=$id");
            }
        }
    }
    loadView("signalementArticle/signalArticle",compact("article","errors","save"),"base");
};
$allSignalArticles = function(){
    $signalements  = getAllSignalements();
    // $detailsSignal =  getDetailSignalement();
    loadView("signalementArticle/allSignalement",compact("signalements"),"admin");
};

$archiverArticle = function(){
      $signalements  = getAllSignalements();
    //   var_dump($signalements);
    // $detailsSignal =  getDetailSignalement();
       if(isset($_GET["id"]) && isset($_GET["signalement_id"])){
        $id_article = $_GET["id"];
        $id_signalement = $_GET["signalement_id"];
            archiverArticle($id_article);
            
        traiteSignalementArticle((int)$id_signalement);
        redirectTo("signalArticles", "allSignalArticle");
    }
    
    $signalements = getAllSignalements();
    loadView("signalementArticle/allSignalement", compact("signalements"), "admin");
};

$refuserSignalement = function(){
    if(isset($_GET["signalement_id"]) && isset($_GET["id"])){
        $id_signalement = $_GET["signalement_id"];
        $id_article = $_GET["id"];
        publierArticle($id_article);
        RejeterSignalementArticle((int)$id_signalement);
        redirectTo("signalArticles", "allSignalArticle");
    }
    
    $signalements = getAllSignalements();
    loadView("signalementArticle/allSignalement", compact("signalements"), "admin");
};

$pages = [
    "ajoutSignalArticle" =>  $ajout ,
    "allSignalArticle" => $allSignalArticles,
    "archiverArticle" =>$archiverArticle,
    "refuserSignalement" => $refuserSignalement,
];
$page = $_REQUEST["page"] ?? "ajoutSignalArticle";

if(array_key_exists($page,$pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}