<div class="p-8 space-y-8 overflow-y-auto">

    <div class="space-y-1">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Gestion des articles</h1>
        <p class="text-sm text-gray-500 font-medium">Supervisez le contenu, gérez les publications et traitez les signalements.</p>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
        
        <div class="flex items-center gap-3 w-full md:w-auto flex-1 max-w-md">
            <div class="relative w-full">
                <input type="text" placeholder="recherche" class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-300 text-sm">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-gray-400 text-sm"></i>
            </div>
            <button class="p-2.5 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-700 transition shadow-sm">
                <i class="fa-solid fa-filter text-sm"></i>
            </button>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <select class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300 cursor-pointer shadow-sm">
                <option>Tous</option>
            </select>
            <select class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300 cursor-pointer shadow-sm">
                <option>Publié</option>
            </select>
            <select class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300 cursor-pointer shadow-sm">
                <option>En-attente</option>
            </select>
            <select class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300 cursor-pointer shadow-sm">
                <option>signalé</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold uppercase tracking-wider text-gray-900 bg-gray-50/50">
                        <th class="py-4 px-6">Article</th>
                        <th class="py-4 px-6">Auteur</th>
                        <th class="py-4 px-6">Statut</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                    
                    <?php if (!empty($articles)): ?>
                        <?php foreach ($articles as $article): ?>
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 shrink-0 border border-gray-100">
                                        <img src="<?= WEBROOT ?>/uploads/<?= htmlspecialchars($article['image'])?>" alt="Cover" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-bold text-gray-900"><?= htmlspecialchars($article['titre']) ?></span>
                                </td>
                                
                                <td class="py-4 px-6 text-gray-500">
                                    <?= htmlspecialchars($article['prenom'] . ' ' . $article['nom']) ?>
                                </td>
                                
                                <td class="py-4 px-6">
                                    <?php if ($article['statut'] === 'publie'): ?>
                                        <span class="px-4 py-1 text-xs font-bold bg-green-50 text-green-500 rounded-lg border border-green-200 inline-block w-28 text-center">publié</span>
                                    <?php elseif ($article['statut'] === 'en_attente'): ?>
                                        <span class="px-4 py-1 text-xs font-bold bg-gray-100 text-gray-500 rounded-lg border border-gray-200 inline-block w-28 text-center">en-attente</span>
                                    <?php else: // restreinte ?>
                                        <span class="px-4 py-1 text-xs font-bold bg-red-50 text-red-400 rounded-lg border border-red-100 inline-block w-28 text-center">restreinte</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="py-4 px-6 text-gray-500">
                                    <?= date('d M Y', strtotime($article['date_creation'] ?? $article['date'])) ?>
                                </td>
                                
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        <!-- BOUTON AJOUTÉ : Voir les détails / Lire l'article -->
                                        <a href="?controller=articles&page=detailArticle&id=<?= $article['id'] ?>" class="p-2 bg-gray-100 text-gray-600 hover:bg-gray-200 transition rounded-lg" title="Voir les détails / Lire">
                                            <i class="fa-regular fa-eye text-sm"></i>
                                        </a>

                                        <a href="?controller=admin&action=supprimerArticle&id=<?= $article['id'] ?>" onclick="return confirm('Supprimer cet article ?')" class="p-2 bg-red-50 text-red-500 hover:bg-red-100 transition rounded-lg" title="Supprimer">
                                            <i class="fa-regular fa-trash-can text-sm"></i>
                                        </a>

                                        <?php if (trim($article['statut']) === 'publie'): ?>
                                            <a href="?controller=articles&page=restreindreArticle&id=<?= $article['id'] ?>" class="p-2 bg-amber-50 text-amber-500 hover:bg-amber-100 transition rounded-lg" title="Restreindre / Masquer">
                                                <i class="fa-regular fa-eye-slash text-sm"></i>
                                            </a>
                                        <?php elseif (trim($article['statut']) === 'en_attente'): ?>
                                            <!-- Note : j'ai corrigé "publierArticle" qui pointait vers "publieArticle" dans ton switch précédent -->
                                            <a href="?controller=articles&page=publieArticle&id=<?= $article['id'] ?>" class="p-2 bg-green-50 text-green-600 hover:bg-green-100 transition rounded-lg" title="Valider et Publier">
                                                <i class="fa-regular fa-circle-check text-sm"></i>
                                            </a>
                                        <?php else: ?>
                                            <a href="?controller=articles&page=publieArticle&id=<?= $article['id'] ?>" class="p-2 bg-blue-50 text-blue-500 hover:bg-blue-100 transition rounded-lg" title="Réactiver / Publier">
                                                <i class="fa-regular fa-share-from-square text-sm"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-400 font-medium bg-gray-50/20">
                                Aucun article trouvé dans la base de données.
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>