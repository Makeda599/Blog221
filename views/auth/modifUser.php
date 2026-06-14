<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-aos="fade-up" data-aos-duration="800">
    
    <div class="mb-6">
        <a href="?controller=auth&page=allUtilisateurs" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-[#ff00cc] transition-colors duration-200">
            <i class="fa-solid fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-user-gear text-[#ff00cc]"></i> Modifier l'utilisateur
            </h2>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="space-y-5">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Prénom</label>
                            <input type="text" name="prenom" value="<?= htmlspecialchars($save['prenom'] ?? '') ?>" 
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50">
                            <?php if(isset($errors['prenom'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['prenom'] ?></p><?php endif; ?>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Nom</label>
                            <input type="text" name="nom" value="<?= htmlspecialchars($save['nom'] ?? '') ?>" 
                                   class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50">
                            <?php if(isset($errors['nom'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['nom'] ?></p><?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Adresse Email</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($save['email'] ?? '') ?>" 
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50">
                        <?php if(isset($errors['email'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></p><?php endif; ?>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Téléphone</label>
                        <input type="text" name="telephone" value="<?= htmlspecialchars($save['telephone'] ?? '') ?>" 
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Rôle sur le site</label>
                        <select name="role" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50 appearance-none">
                            <option value="lecteur" <?= (isset($save['role']) && strtolower($save['role']) === 'lecteur') ? 'selected' : '' ?>>Lecteur</option>
                            <option value="auteur" <?= (isset($save['role']) && strtolower($save['role']) === 'auteur') ? 'selected' : '' ?>>Auteur</option>
                            <option value="admin" <?= (isset($save['role']) && strtolower($save['role']) === 'admin') ? 'selected' : '' ?>>Administrateur</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Changer la photo de profil</label>
                        <input type="file" name="photo" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                        <?php if(isset($errors['photo'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['photo'] ?></p><?php endif; ?>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="?controller=auth&page=allUtilisateurs" class="px-5 py-2.5 rounded-xl text-xs font-bold text-gray-500 hover:bg-gray-100 transition-all">
                            Annuler
                        </a>
                        <button type="submit" name="modifier_employe" class="bg-[#ff00cc] text-white px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-opacity-90 shadow-sm transition-all active:scale-95">
                            Enregistrer les modifications
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <div class="space-y-6">
            <div class="bg-gradient-to-b from-gray-900 to-gray-800 text-white rounded-3xl p-6 shadow-xl flex flex-col items-center text-center sticky top-6">
                <span class="text-[10px] font-extrabold tracking-wider uppercase bg-white/10 px-3 py-1 rounded-full border border-white/10 mb-4">
                    Profil Actuel
                </span>
                
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white/10 shadow-2xl bg-gray-700 mb-4 ring-4 ring-[#ff00cc]/20">
                    <img src="<?= WEBROOT ?>uploads/photos/<?= htmlspecialchars($save['photo'] ?? 'default.jpg') ?>" 
                         alt="Avatar" class="w-full h-full object-cover">
                </div>

                <h3 class="text-lg font-black tracking-tight">
                    <?= htmlspecialchars(($save['prenom'] ?? '') . ' ' . ($save['nom'] ?? '')) ?>
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">ID Membre : #<?= $save['id'] ?? 'X' ?></p>

                <div class="w-full h-[1px] bg-white/10 my-4"></div>

                <p class="text-xs text-gray-400 italic px-2">
                    "Les modifications appliquées ici prendront effet immédiatement sur le compte de l'utilisateur."
                </p>
            </div>
        </div>

    </div>
</div>