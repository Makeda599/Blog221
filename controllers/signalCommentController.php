<?php
require_once(ROOT."models/signalCommentaireModel.php");
require_once(ROOT."models/commentairesModel.php"); 

$ajout = function(){
    if(isset($_GET["id"])){
        $id = (int)$_GET["id"];
        $article_id = (int)($_GET["article_id"] ?? 0);
        
        $commentaire = getDetailCommentairePourSignalement($id);
        
        $save = [];
        $errors = [];
        
        if(isset($_REQUEST['envoyer_signalement'])){
            $save = $_POST;
            
            if (isset($_POST['motif_select']) && $_POST['motif_select'] !== 'Autre') {
                $save['motif'] = $_POST['motif_select'];
            } else {
                $save['motif'] = $_POST['motif_autre'] ?? '';
            }
            
            $errors = validateSignalArticle($save);  
            if(empty($errors)){
                $save["date_signalement"] = date("Y-m-d H:i:s");
                $save["commentaire_id"] = $id;
                $save["statut"] = "en_attente";
                
                ajoutSignalCommentaire($save);
                
                redirectTo("articles", "detailArticle&id=$article_id");
            }
        }
        
        loadView("signalementCommentaire/signalComment", compact("commentaire", "errors", "save", "article_id"), "base");
    } else {
        redirectTo("articles", "accueil");
    }
};

$allSignalCommentaires = function(){
    $signalements = getAllSignalements();
    loadView("signalementArticle/allSignalement", compact("signalements"), "admin");
};

$archiverCommentaires = function(){
    if(isset($_GET["id"]) && isset($_GET["signalement_id"])){
        $id_commentaire = (int)$_GET["id"];
        $id_signalement = (int)$_GET["signalement_id"];
        
        traiteSignalementCommentaire($id_signalement);
        archiverCommentaire((int)$id_commentaire); 
        
        redirectTo("signalCommentaires", "allSignalCommentaires");
    }
};

$refuserSignalement = function(){
    if(isset($_GET["signalement_id"]) && isset($_GET["id"])){
        $id_signalement = (int)$_GET["signalement_id"];
        $id_commentaire = $_GET["id"];
        RejeterSignalementCommentaire($id_signalement);
        publierCommentaire((int)$id_commentaire);
        redirectTo("signalCommentaires", "allSignalCommentaires");
    }
};

$pages = [
    "ajoutSignalCommentaires" => $ajout,
    "allSignalCommentaires"   => $allSignalCommentaires,
    "archiverCommentaires"    => $archiverCommentaires,
    "refuserSignalement"      => $refuserSignalement,
];

$page = $_REQUEST["page"] ?? "ajoutSignalCommentaires";

if(array_key_exists($page, $pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}