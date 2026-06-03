<?php
require_once(ROOT."models/categorieModel.php");
require_once(ROOT."models/articleModel.php");
require_once(ROOT."models/commentairesModel.php");

$accueil = function(){
    $articles = getAllArticles();
    $articlesALaUne = getArticlesALaUne(4); 
    $articlesRecents = getArticlesRecents(6);
    require_once(ROOT."views/articles/accueil.php");
    // loadView("articles/accueil", compact("articles"), "base");
};
$ajoutArticle = function () {
    $categories = allCategorie();
    $save = [];
    $errors = [];
    
    if (isset($_REQUEST["envoyer"])) {
        $save = $_POST;
        $errors = validateArticle($save);
           if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
            $errors['image'] = "L'image de couverture est obligatoire.";
        } elseif ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                $errors['image'] = "Le format doit être JPEG, PNG, WEBP ou GIF.";
            }
            if ($_FILES['image']['size'] > 3 * 1024 * 1024) {
                $errors['image'] = "L'image ne doit pas dépasser 3 Mo.";
            }
        } else {
            $errors['image'] = "Erreur lors du téléchargement de l'image.";
        }

        if (empty($errors)) {
            $uploadDir = ROOT . "public/uploads/";

            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = uniqid("art_", true) . '.' . $extension;
            $uploadFile = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $save['image'] = $imageName;
                $save["statut"] = "en_attente";
                $save["id_auteur"] = $_SESSION["user"]["id"];
                ajoutArticle ($save);
                // Appel de votre modèle pour insérer l'article en BDD
                // insertArticle($save); 

                // header("Location: ?controller=articles&page=accueil");
                // exit();
                redirectTo("articles","articleAuteur");
            } else {
                $errors['image'] = "Impossible de sauvegarder l'image sur le serveur.";
            }
        }
    }
    loadView("articles/ajoutArticle", compact("categories", "errors", "save"), "auteur");
};

$articleParAuteur = function(){
    if(isset($_SESSION["user"])){
        $id=$_SESSION["user"]["id"];
        $articles = getAllArticleByAuteur($id);

    }
   
    else {
        $articles = [];
        $id = null;
    }
    // dd($articles);
    loadView("articles/articleAuteur", compact("articles", "id"), "base");

};
$detailArticle = function(){
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $article = getDetailArticle($id);
        $commentaires = getCommentairesByArticle($id);
        } else {
        $id = 0;
        $article = null;
        $commentaires = [];
    }

    
    loadView("articles/detailArticle",compact("article","id","commentaires"),"base");
};
$allArticle = function(){
    $articles = getAllArticles();
    loadView("articles/allArticle",compact("articles"),"admin");
};
$publieArticle = function(){
    if(isset($_GET["id"])){
        $id = (int)$_GET["id"];
        publierArticle($id);
    }
    redirectTo("articles","allArticles");

};

$restreindreArticle = function(){
    if(isset($_GET["id"])){
        $id = (int)$_GET["id"];
        restreindreArticle($id);
    }
    redirectTo("articles","allArticles");
   
};
$pages = [
    "accueil" => $accueil,
    "ajoutArticle" =>$ajoutArticle,
    "articleAuteur" =>$articleParAuteur,
    "detailArticle" => $detailArticle ,
    "allArticles" => $allArticle,
    "publieArticle"=>$publieArticle,
    "restreindreArticle"=>$restreindreArticle,

];
$page = $_REQUEST["page"] ?? "accueil";
if(array_key_exists($page,$pages)){
    $pages[$page]();
}else{
    echo "page introuvable";
    exit();
}