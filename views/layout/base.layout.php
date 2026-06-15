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
                <?php if ($_SESSION['user']['role'] == "auteur"): ?>
                <a href="?controller=auth&page=auteurDashboard" class="text-gray-500 hover:text-gray-900 transition">Dashboard</a>
                <?php elseif ($_SESSION['user']['role'] == "lecteur") : ?>
                <a href="<?=path("articles","accueil") ?>" class="text-gray-500 hover:text-gray-900 transition">Accueil</a>
            <?php endif; ?>
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
                        
                        

                        <button type="button" 
                                class="text-gray-500 hover:text-[#ff00cc] text-xs pl-2 flex items-center gap-1 btn-view-profile"
                                data-id="<?= $_SESSION['user']['id'] ?>"
                                data-prenom="<?= htmlspecialchars($_SESSION['user']['prenom'] ?? '') ?>"
                                data-nom="<?= htmlspecialchars($_SESSION['user']['nom'] ?? '') ?>"
                                data-email="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>"
                                data-telephone="<?= htmlspecialchars($_SESSION['user']['telephone'] ?? 'Non renseigné') ?>"
                                data-role="<?= htmlspecialchars(strtolower($_SESSION['user']['role'] ?? 'lecteur')) ?>"
                                data-photo="<?= htmlspecialchars($_SESSION['user']['photo'] ?? 'default.jpg') ?>"
                                title="Mon Profil">
                            <i class="fa-solid fa-user"></i>
                            <span>Profil</span>
                        </button>
                        <a href="?controller=auth&page=logOut" class="text-gray-500 hover:text-red-500 text-xs pl-1 flex items-center gap-1" title="Déconnexion">
                            <i class="fa-solid fa-power-off"></i>
                            logOut
                        </a>
                    </div>
             
                <?php endif; ?>
            </div>

        </div>
    </nav>

    <main class="flex-grow">
        <?= $content ?>
    </main>

<div id="profileDrawer" class="fixed inset-0 z-50 overflow-hidden pointer-events-none" role="dialog" aria-modal="true">
    <div id="drawerOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm opacity-0 transition-opacity duration-500 ease-in-out"></div>

    <div class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
        <div id="drawerPanel" class="w-screen max-w-md bg-gradient-to-b from-gray-900 to-gray-800 text-white transform translate-x-full transition-transform duration-500 ease-in-out shadow-2xl flex flex-col justify-between">
            
            <div class="p-6 flex items-center justify-between border-b border-white/10">
                <span id="drawerRole" class="px-3 py-1 rounded-full text-[10px] font-extrabold tracking-wider uppercase border"></span>
                <button type="button" id="closeDrawer" class="text-gray-400 hover:text-white rounded-xl p-2 bg-white/5 hover:bg-white/10 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto py-6 px-6 space-y-8 flex flex-col items-center">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white/10 shadow-2xl bg-gray-700 ring-4 ring-[#ff00cc]/30 shrink-0">
                    <img id="drawerPhoto" src="" alt="Avatar" class="w-full h-full object-cover">
                </div>

                <div class="text-center">
                    <h2 id="drawerFullName" class="text-2xl font-black tracking-tight"></h2>
                    <p id="drawerId" class="text-xs text-gray-400 mt-1 font-medium"></p>
                </div>

                <div class="w-full h-[1px] bg-white/10"></div>

                <div class="w-full space-y-4 text-left text-gray-300">
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Adresse Email</span>
                        <span id="drawerEmail" class="text-sm font-bold text-white break-all"></span>
                    </div>
                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                        <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Téléphone</span>
                        <span id="drawerPhone" class="text-sm font-bold text-white"></span>
                    </div>
                </div>

                <!-- Stats simulées de la maquette -->
                <div class="w-full bg-white/5 rounded-2xl p-4 border border-white/5 grid grid-cols-3 gap-2 text-center">
                    <div class="p-2">
                        <span class="block text-lg font-black text-purple-400">1.8K</span>
                        <span class="text-[9px] text-gray-400 uppercase">Visites</span>
                    </div>
                    <div class="p-2 border-x border-white/10">
                        <span class="block text-lg font-black text-pink-400">3.2M</span>
                        <span class="text-[9px] text-gray-400 uppercase">Comms</span>
                    </div>
                    <div class="p-2">
                        <span id="drawerStatArticles" class="block text-lg font-black text-blue-400">0</span>
                        <span class="text-[9px] text-gray-400 uppercase">Articles</span>
                    </div>
                </div>
            </div>

            <!-- <div class="p-6 bg-black/20 border-t border-white/10 grid grid-cols-2 gap-3">
                <a id="drawerEditLink" href="#" class="bg-[#ff00cc] text-white py-3 rounded-xl text-xs font-bold hover:bg-opacity-90 transition-all text-center active:scale-95 shadow-sm">
                    <i class="fa-solid fa-user-pen mr-1"></i> Modifier
                </a>
                <a id="drawerDeleteLink" href="#" onclick="return confirm('Supprimer définitivement ce compte ?');" class="bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl text-xs font-bold transition-all text-center active:scale-95 shadow-sm">
                    <i class="fa-solid fa-trash mr-1"></i> Supprimer
                </a>
            </div> -->

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const drawer = document.getElementById('profileDrawer');
    const overlay = document.getElementById('drawerOverlay');
    const panel = document.getElementById('drawerPanel');
    const closeBtn = document.getElementById('closeDrawer');

    const drawerRole = document.getElementById('drawerRole');
    const drawerPhoto = document.getElementById('drawerPhoto');
    const drawerFullName = document.getElementById('drawerFullName');
    const drawerId = document.getElementById('drawerId');
    const drawerEmail = document.getElementById('drawerEmail');
    const drawerPhone = document.getElementById('drawerPhone');
    const drawerStatArticles = document.getElementById('drawerStatArticles');
    // const editLink = document.getElementById('drawerEditLink');
    // const deleteLink = document.getElementById('drawerDeleteLink');

    document.querySelectorAll('.btn-view-profile').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const prenom = this.getAttribute('data-prenom');
            const nom = this.getAttribute('data-nom');
            const email = this.getAttribute('data-email');
            const phone = this.getAttribute('data-telephone');
            const role = this.getAttribute('data-role');
            const photo = this.getAttribute('data-photo');

            drawerFullName.textContent = prenom + ' ' + nom;
            drawerId.textContent = 'Membre ID: #' + id;
            drawerEmail.textContent = email;
            drawerPhone.textContent = phone;
            drawerPhoto.src = '<?= WEBROOT ?>/uploads/photos/' + photo;
            drawerRole.textContent = role;

            drawerRole.className = "px-3 py-1 rounded-full text-[10px] font-extrabold tracking-wider uppercase border ";
            if(role === 'admin') drawerRole.classList.add('bg-red-500/20', 'text-red-300', 'border-red-500/30');
            else if(role === 'auteur') drawerRole.classList.add('bg-amber-500/20', 'text-amber-300', 'border-amber-500/30');
            else drawerRole.classList.add('bg-blue-500/20', 'text-blue-300', 'border-blue-500/30');

            drawerStatArticles.textContent = (role === 'auteur') ? '8' : '0';

            // editLink.href = '?controller=auth&page=modifUtilisateur&id=' + id;
            // deleteLink.href = '?controller=auth&page=supprimerUser&id=' + id;

            const sessionUserId = '<?= $_SESSION['user']['id'] ?? 0 ?>';
            // if (id === sessionUserId) {
            //     deleteLink.classList.add('hidden');
            // } else {
            //     deleteLink.classList.remove('hidden');
            // }

            drawer.classList.remove('pointer-events-none');
            overlay.classList.remove('opacity-0');
            panel.classList.remove('translate-x-full');
        });
    });

    function hideDrawer() {
        overlay.classList.add('opacity-0');
        panel.classList.add('translate-x-full');
        setTimeout(() => {
            drawer.classList.add('pointer-events-none');
        }, 500); 
    }

    closeBtn.addEventListener('click', hideDrawer);
    overlay.addEventListener('click', hideDrawer);
});
</script>