<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG221 - Espace Auteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans flex flex-col min-h-screen justify-between text-gray-800">

    <nav class="w-full bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            
            <div class="flex-1 flex justify-start">
                <a href="?controller=articles&page=accueil" class="flex items-center gap-2">
                    <div class="bg-black text-white p-2 rounded-lg font-black tracking-tighter text-lg flex items-center justify-center w-10 h-10">
                        B
                    </div>
                    <span class="text-xl font-black tracking-tight text-gray-900">
                        LOG<span class="text-pink-500">221</span>
                    </span>
                </a>
            </div>

            <div class="hidden md:flex flex-1 justify-center items-center gap-8 text-sm font-semibold h-20">
                <a href="#" class="text-gray-500 hover:text-gray-900 transition">Dashboard</a>
                <a href="?controller=articles&page=articleAuteur" class="text-gray-900 border-b-2 border-pink-500 h-full flex items-center px-1">
                    Articles
                </a>
            </div>

            <div class="flex-1 flex justify-end items-center gap-6">
                <button class="text-gray-800 hover:text-pink-500 transition relative p-1">
                    <i class="fa-regular fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-pink-500 rounded-full"></span>
                </button>

                <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center gap-3 pl-4">

                        
                        <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 shadow-sm bg-gray-100 flex items-center justify-center">
                            <?php 
                            $avatar = $_SESSION['user']['photo'] ?? '';
                            // Test de sécurité sur le chemin physique de l'image
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
    </nav>

    <main class="flex-grow">
        <?= $content ?>
    </main>

