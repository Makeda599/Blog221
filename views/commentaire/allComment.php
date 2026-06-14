<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto px-4 py-8 min-h-screen overflow-x-hidden">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 pb-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                <span class="bg-black text-white px-2.5 py-1 rounded-xl text-2xl shadow-md font-mono">B</span> 
                Modération des Commentaires
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Supervisez, approuvez ou supprimez l'ensemble des commentaires publiés sur la plateforme.
            </p>
        </div>
        <div class="flex items-center gap-2 text-xs font-bold text-gray-600 bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-sm hover:shadow transition">
            <i class="fa-solid fa-calculator text-[#E562D1]"></i>
            Total : <?= count($commentaires) ?> commentaire(s)
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-4.5">Auteur</th>
                        <th class="px-6 py-4.5">Commentaire</th>
                        <th class="px-6 py-4.5">Date de publication</th>
                        <th class="px-6 py-4.5">Statut</th>
                        <th class="px-6 py-4.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    <?php if (!empty($commentaires)): ?>
                        <?php foreach ($commentaires as $com): ?>
                            <tr class="hover:bg-pink-50/10 transition-colors duration-200 group">
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-50 border border-gray-200 shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                                            <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($com['photo'] ?? 'default.jpg') ?>" class="w-full h-full object-cover" alt="Avatar">
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-900 block"><?= htmlspecialchars($com['prenom'] . ' ' . $com['nom']) ?></span>
                                            <span class="text-[10px] text-gray-400"><?= htmlspecialchars($com['email'] ?? '') ?></span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 max-w-xs sm:max-w-md">
                                    <p class="text-gray-700 font-medium line-clamp-2 italic break-words">
                                        "<?= htmlspecialchars($com['contenu']) ?>"
                                    </p>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xs font-medium">
                                    <i class="fa-regular fa-clock mr-1 text-[11px]"></i>
                                    <?= date('d M Y à H:i', strtotime($com['date_commentaire'] ?? $com['date'] ?? 'now')) ?>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if (($com['statut'] ?? 'approuve') === 'en_attente'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Modération
                                        </span>
                                    <?php elseif (($com['statut'] ?? 'approuve') === 'restreinte'): ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-600 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Restreinte
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> En ligne
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">                                       
                                       <?php if (($com['statut'] ?? 'publie') !== 'publie'): ?>
                                            <a href="?controller=commentaires&page=publierComment&id=<?= $com['id'] ?>" 
                                               title="Approuver et mettre en ligne"
                                               class="p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-xl border border-emerald-100 transition-all duration-200 active:scale-90">
                                                <i class="fa-solid fa-check text-xs"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (($com['statut'] ?? 'publie') === 'publie'): ?>
                                            <a href="?controller=commentaires&page=archiverComment&id=<?= $com['id'] ?>" 
                                               title="Restreindre le commentaire"
                                               class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-xl border border-amber-100 transition-all duration-200 active:scale-90">
                                                <i class="fa-solid fa-eye-slash text-xs"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="?controller=commentaires&page=archiverComment&id=<?= $com['id'] ?>" 
                                           title="Supprimer définitivement"
                                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce commentaire ?')"
                                           class="p-2 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-xl border border-red-100 transition-all duration-200 active:scale-90">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-400 italic font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-regular fa-comments text-3xl text-gray-300"></i>
                                    <span>Aucun commentaire n'a encore été publié sur le blog.</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>