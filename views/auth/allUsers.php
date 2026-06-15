<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-aos="fade-up" data-aos-duration="800">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-users text-[#ff00cc]"></i> Gestion des Utilisateurs
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Liste complète des membres inscrits sur Blog221, gestion de leurs rôles et accès.
            </p>
        </div>
        <div>
            <a href="?controller=auth&page=inscription" class="inline-flex items-center gap-2 bg-[#ff00cc] text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm hover:bg-opacity-90 hover:shadow transition-all duration-300 active:scale-95">
                <i class="fa-solid fa-user-plus"></i> Ajouter un utilisateur
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Utilisateur</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Contact & Email</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Rôle</th>
                        <th scope="col" class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    <?php if (!empty($utilisateurs)): ?>
                        <?php foreach ($utilisateurs as $user): ?>
                            <tr class="hover:bg-gray-50/80 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-4">
                                        <div class="w-11 h-11 rounded-full overflow-hidden border border-gray-200 shadow-sm bg-gray-50 shrink-0">
                                            <img src="<?= WEBROOT ?>uploads/photos/<?= htmlspecialchars($user['photo'] ?? 'default.jpg') ?>" 
                                                 alt="Avatar" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="text-sm font-extrabold text-gray-900">
                                                <?= htmlspecialchars(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) ?>
                                            </div>
                                            <div class="text-xs text-gray-400">ID: #<?= $user['id'] ?></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700 font-medium"><?= htmlspecialchars($user['email']) ?></div>
                                    <div class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                                        <i class="fa-solid fa-phone text-[10px]"></i> <?= htmlspecialchars($user['telephone'] ?? 'Non renseigné') ?>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                        $role = strtolower($user['role'] ?? 'lecteur');
                                        if ($role === 'admin') {
                                            $badgeClass = 'bg-red-50 text-red-700 border-red-100';
                                            $icon = 'fa-shield-halved';
                                        } elseif ($role === 'auteur') {
                                            $badgeClass = 'bg-amber-50 text-amber-700 border-amber-100';
                                            $icon = 'fa-pen-nib';
                                        } else {
                                            $badgeClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                            $icon = 'fa-book-open';
                                        }
                                    ?>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold border capitalize <?= $badgeClass ?>">
                                        <i class="fa-solid <?= $icon ?> text-[10px]"></i> <?= $role ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" 
                                                class="p-2 text-purple-600 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors btn-view-profile"
                                                data-id="<?= $user['id'] ?>"
                                                data-prenom="<?= htmlspecialchars($user['prenom'] ?? '') ?>"
                                                data-nom="<?= htmlspecialchars($user['nom'] ?? '') ?>"
                                                data-email="<?= htmlspecialchars($user['email'] ?? '') ?>"
                                                data-telephone="<?= htmlspecialchars($user['telephone'] ?? 'Non renseigné') ?>"
                                                data-role="<?= htmlspecialchars(strtolower($user['role'] ?? 'lecteur')) ?>"
                                                data-photo="<?= htmlspecialchars($user['photo'] ?? 'default.jpg') ?>"
                                                title="Voir le profil">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </button>

                                        <a href="?controller=auth&page=modifUtilisateur&id=<?= $user['id'] ?>" 
                                           class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors"
                                           title="Modifier l'utilisateur">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                        </a>
                                        
                                        <!-- 🗑️ Supprimer -->
                                        <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['role'] == "admin"): ?>
                                            <a href="?controller=auth&page=supprimerUser&id=<?= $user['id'] ?>" 
                                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                               class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition-colors"
                                               title="Supprimer l'utilisateur">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </a>
                                        <?php else: ?>
                                            <span class="p-2 text-gray-300 bg-gray-50 rounded-xl cursor-not-allowed" title="Vous êtes actuellement connecté">
                                                <i class="fa-solid fa-user-check text-xs"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-400 italic">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-solid fa-user-slash text-3xl text-gray-300"></i>
                                    Aucun utilisateur trouvé dans la base de données.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


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

            <div class="p-6 bg-black/20 border-t border-white/10 grid grid-cols-2 gap-3">
                <a id="drawerEditLink" href="#" class="bg-[#ff00cc] text-white py-3 rounded-xl text-xs font-bold hover:bg-opacity-90 transition-all text-center active:scale-95 shadow-sm">
                    <i class="fa-solid fa-user-pen mr-1"></i> Modifier
                </a>
                <a id="drawerDeleteLink" href="#" onclick="return confirm('Supprimer définitivement ce compte ?');" class="bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl text-xs font-bold transition-all text-center active:scale-95 shadow-sm">
                    <i class="fa-solid fa-trash mr-1"></i> Supprimer
                </a>
            </div>

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
    const editLink = document.getElementById('drawerEditLink');
    const deleteLink = document.getElementById('drawerDeleteLink');

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
            drawerPhoto.src = '<?= WEBROOT ?>uploads/photos/' + photo;
            drawerRole.textContent = role;

            drawerRole.className = "px-3 py-1 rounded-full text-[10px] font-extrabold tracking-wider uppercase border ";
            if(role === 'admin') drawerRole.classList.add('bg-red-500/20', 'text-red-300', 'border-red-500/30');
            else if(role === 'auteur') drawerRole.classList.add('bg-amber-500/20', 'text-amber-300', 'border-amber-500/30');
            else drawerRole.classList.add('bg-blue-500/20', 'text-blue-300', 'border-blue-500/30');

            drawerStatArticles.textContent = (role === 'auteur') ? '8' : '0';

            editLink.href = '?controller=auth&page=modifUtilisateur&id=' + id;
            deleteLink.href = '?controller=auth&page=supprimerUser&id=' + id;

            const sessionUserId = '<?= $_SESSION['user']['id'] ?? 0 ?>';
            if (id === sessionUserId) {
                deleteLink.classList.add('hidden');
            } else {
                deleteLink.classList.remove('hidden');
            }

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