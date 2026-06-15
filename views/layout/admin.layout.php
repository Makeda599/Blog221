<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG221 - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

<aside class="w-64 bg-pink-200 flex flex-col justify-between p-4 h-full shrink-0">
    <div>
        <div class="mb-8 pl-4 flex flex-col items-start">
            <div class="flex flex-col items-center">
                <h1 class="text-2xl font-bold flex items-center gap-2 text-gray-800">
                    <span class="bg-gray-800 text-white w-9 h-9 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-bold text-xl font-black"></i>
                    </span>
                    <span class="tracking-tight">BLOG221</span>
                </h1>
                <p class="text-xs text-gray-600 font-semibold tracking-widest mt-1 uppercase">Admin</p>
            </div>
        </div>

        <nav class="space-y-2">
            <a href="?controller=auth&page=adminDashboard" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-chart-pie w-5 text-lg"></i> Dashboard
            </a>
            <a href="?controller=auth&page=allUtilisateurs" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-user w-5 text-lg"></i> Utilisateurs
            </a>
            <a href="?controller=articles&page=allArticles" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-book-open w-5 text-lg"></i> Articles
            </a>
            <a href="?controller=commentaires&page=allCommentaires" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-comment w-5 text-lg"></i> Commentaires
            </a>
            <a href="?controller=categories&page=allCategorie" class="flex items-center gap-4 px-4 py-3 <?= ($currentPage ?? '') === 'allCategorie' ? 'text-gray-900 font-bold bg-pink-300 shadow-sm' : 'text-gray-700 font-medium hover:bg-pink-300' ?> rounded-lg transition">
                <i class="fa-solid fa-tags w-5 text-lg"></i> Catégories
            </a>
            <a href="?controller=signalArticles&page=allSignalArticle" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-triangle-exclamation w-5 text-lg"></i> Signalements
            </a>
        </nav>
    </div>

    <div>
        <a href="?controller=auth&page=logOut" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
            <i class="fa-solid fa-right-from-bracket w-5 text-lg"></i> Deconnexion
        </a>
    </div>
</aside>

<div class="flex-1 flex flex-col h-full overflow-hidden">

    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm shrink-0">
        <div class="relative w-80">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" placeholder="recherche" class="w-full pl-10 pr-4 py-2 border border-gray-300 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-pink-300">
        </div>
        <div class="flex items-center gap-4">
            <button class="text-gray-600 hover:text-gray-900 relative">
                <i class="fa-solid fa-bell text-xl"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-pink-500 rounded-full"></span>
            </button>
            <div class="flex items-center gap-3">
               <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center gap-3 pl-4">

                        
                        <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 shadow-sm bg-gray-100 flex items-center justify-center">
                            <?php 
                            $avatar = $_SESSION['user']['photo'] ?? '';
                           if (!empty($avatar) && file_exists(ROOT . "public/uploads/photos/" . $avatar)):
                            ?>
                                <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($avatar) ?>" 
                                    alt="Profil" 
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <i class="fa-solid fa-user text-gray-400 text-lg"></i>
                            <?php endif; ?>
                        </div>
                        <span class="text-sm font-bold text-gray-800 hidden sm:inline">
                            <?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?>
                        </span>
                        
                        <a href="?controller=auth&page=logOut" class="text-gray-400 hover:text-red-500 text-xs pl-1" title="Déconnexion">
                            <i class="fa-solid fa-power-off"></i>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </header>

    <main class="flex-1 p-8 overflow-y-auto bg-gray-50">
        <?= $content ?>
    </main>

