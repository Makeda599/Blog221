<div class="p-6 md:p-8 space-y-6 min-h-screen bg-gray-50/50">

    <div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion des signalements</h1>
        <p class="text-sm text-gray-500 mt-1">Gérez les signalements d'articles et de commentaires pour maintenir un environnement sain.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3 flex-1 min-w-[280px]">
            <div class="relative w-full max-w-md">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" placeholder="recherche" class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>
            <button class="p-2.5 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 text-gray-600 transition">
                <i class="fa-solid fa-sliders text-sm"></i>
            </button>
        </div>

        <div class="flex items-center gap-3">
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm font-medium text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>Tous</option>
                <option>Article</option>
                <option>Commentaire</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm font-medium text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option value="en_attente">En-attente</option>
                <option value="traite">Traité</option>
                <option value="rejete">Rejeté</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/70 text-[11px] font-bold tracking-wider text-gray-400 uppercase">
                        <th class="py-4 px-6">Type</th>
                        <th class="py-4 px-6">Signaleur</th>
                        <th class="py-4 px-6">Motif</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 text-center">Statut</th>
                        <th class="py-4 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    <?php if (!empty($signalements)): ?>
                        <?php foreach ($signalements as $sig): ?>
                            <tr class="hover:bg-gray-50/50 transition">

                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2 font-medium text-gray-900">
                                            <?php if ($sig['type_signalement'] === 'article'): ?>
                                                <span class="w-5 h-5 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                                    <i class="fa-solid fa-file-lines"></i>
                                                </span>
                                                Article
                                            <?php else: ?>
                                                <span class="w-5 h-5 rounded bg-amber-50 text-amber-600 flex items-center justify-center text-xs">
                                                    <i class="fa-solid fa-comment-dots"></i>
                                                </span>
                                                Commentaire
                                            <?php endif; ?>
                                        </div>
                                        <span class="text-[11px] text-gray-400 mt-0.5 max-w-[200px] truncate" title="<?= htmlspecialchars($sig['titre_cible'] ?? '') ?>">
                                            Sur : <?= htmlspecialchars($sig['titre_cible'] ?? '') ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full overflow-hidden bg-gray-100 border border-gray-200">
                                            <img src="<?= WEBROOT ?>uploads/photos/<?= htmlspecialchars($sig['photo_signaleur'] ?? 'default.jpg') ?>" class="w-full h-full object-cover" alt="Avatar">
                                        </div>
                                        <span class="text-xs font-semibold text-gray-700">
                                            <?= htmlspecialchars(($sig['prenom_signaleur'] ?? '') . ' ' . ($sig['nom_signaleur'] ?? '')) ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <span class="text-gray-600 line-clamp-1 text-xs" title="<?= htmlspecialchars($sig['motif'] ?? '') ?>">
                                        <?= htmlspecialchars($sig['motif'] ?? '') ?>
                                    </span>
                                </td>

                                <td class="py-4 px-6 whitespace-nowrap text-xs text-gray-500">
                                    <?= isset($sig['date_signalement']) ? date('d M Y', strtotime($sig['date_signalement'])) : '' ?>
                                </td>

                                <td class="py-4 px-6 whitespace-nowrap text-center text-xs font-semibold">
                                    <?php if (($sig['statut'] ?? 'en_attente') === 'en_attente'): ?>
                                        <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100">En attente</span>
                                    <?php elseif ($sig['statut'] === 'traite'): ?>
                                        <span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">Traité</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 rounded-full bg-red-50 text-red-600 border border-red-100">Rejeté</span>
                                    <?php endif; ?>
                                </td>

                                <td class="py-4 px-6 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            title="Voir le détail du signalement"
                                            class="js-voir-detail p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors focus:outline-none focus:ring-2 focus:ring-amber-500"
                                            data-id="<?= $sig['id'] ?>"
                                            data-motif="<?= htmlspecialchars($sig['motif'] ?? '') ?>"
                                            data-description="<?= htmlspecialchars($sig['description'] ?? 'Aucune description complémentaire fournie.') ?>"
                                            data-auteur="<?= htmlspecialchars(($sig['prenom_signaleur'] ?? '') . ' ' . ($sig['nom_signaleur'] ?? '')) ?>"
                                            data-avatar="<?= WEBROOT ?>uploads/photos/<?= htmlspecialchars($sig['photo_signaleur'] ?? 'default.jpg') ?>"
                                            data-contenu="<?= htmlspecialchars($sig['titre_cible'] ?? '') ?>"
                                            data-article-id="<?= $sig['article_id'] ?? 'null' ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-sm text-gray-400 italic bg-gray-50/20">
                                Aucun signalement trouvé.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal-signalement" class="fixed hidden inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden transform transition-all relative">

        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-red-500 text-xl">⚠️</span>
                <h3 class="text-lg font-bold text-gray-900 tracking-wide uppercase">Détail du signalement</h3>
            </div>
            <button id="close-modal-x" class="text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2 border border-gray-200 rounded-lg p-4 space-y-3">
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Motif</h4>
                        <p id="modal-motif-text" class="font-bold text-gray-900 text-sm"></p>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Description du problème</h4>
                        <p id="modal-description-text" class="text-xs text-gray-600 leading-relaxed italic bg-gray-50 p-2 rounded border border-gray-100"></p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4 flex flex-col">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Signalé par :</h4>
                    <div class="flex items-center gap-3 mt-1">
                        <img id="modal-auteur-avatar" class="w-10 h-10 rounded-full object-cover border border-gray-100" src="" alt="Avatar">
                        <div>
                            <p id="modal-auteur-name" class="text-sm font-semibold text-gray-900"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border border-red-200 rounded-lg p-4 bg-white relative">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider">Contenu visé</h4>
                    <button class="text-xs font-bold text-purple-600 bg-purple-50 px-3 py-1.5 rounded-full hover:bg-purple-100 transition-colors">
                        voir plus +
                    </button>
                </div>

                <div class="flex gap-4 items-start border border-gray-100 p-3 rounded-lg shadow-sm bg-gray-50/50">
                    <img id="modal-content-avatar" class="w-11 h-11 rounded-full object-cover bg-gray-200" src="" alt="Avatar">
                    <div class="space-y-1 flex-1">
                        <p id="modal-content-body" class="text-xs text-gray-700 leading-relaxed font-normal"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
            <a id="modal-reject-link" href="#">
                <button id="modal-reject" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-sm">
                    Rejeter
                </button>
            </a>
            <a id="modal-delete-link" href="#">
                <button id="modal-delete" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 rounded-lg text-sm font-semibold text-white hover:bg-red-700 transition-colors shadow-sm">
                    Supprimer
                </button>
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("modal-signalement");
        const btnVoirDetails = document.querySelectorAll(".js-voir-detail");
        const btnCloseX = document.getElementById("close-modal-x");
        const btnModalReject = document.getElementById("modal-reject");
        const btnModalDelete = document.getElementById("modal-delete");

        // Éléments internes de la modal
        const modalMotif = document.getElementById("modal-motif-text");
        const modalDescription = document.getElementById("modal-description-text");
        const modalAuteurName = document.getElementById("modal-auteur-name");
        const modalAuteurAvatar = document.getElementById("modal-auteur-avatar");
        const modalContentAvatar = document.getElementById("modal-content-avatar");
        const modalContentBody = document.getElementById("modal-content-body");
        const modalDeleteLink = document.getElementById("modal-delete-link");
        const modalRejectLink = document.getElementById("modal-reject-link");

        function openModal(e) {
            const btn = e.currentTarget;

            modalMotif.textContent = btn.getAttribute("data-motif");
            modalDescription.textContent = btn.getAttribute("data-description");
            modalAuteurName.textContent = btn.getAttribute("data-auteur");

            const avatarSrc = btn.getAttribute("data-avatar");
            modalAuteurAvatar.src = avatarSrc;
            modalContentAvatar.src = avatarSrc; 

            modalContentBody.textContent = btn.getAttribute("data-contenu");

            const signalementId = btn.getAttribute("data-id"); 
            const articleId = btn.getAttribute("data-article-id");

            // Si c'est un article valide (pas un commentaire)
            if (articleId && articleId !== "null") {
                modalDeleteLink.href = `index.php?controller=signalArticles&page=archiverArticle&id=${articleId}&signalement_id=${signalementId}`;
                modalDeleteLink.style.display = "inline-block";
                
                modalRejectLink.href = `index.php?controller=signalArticles&page=refuserSignalement&signalement_id=${signalementId}`;
                modalRejectLink.style.display = "inline-block";
            } else {
                modalDeleteLink.href = "#";
                modalDeleteLink.style.display = "none";
                modalRejectLink.href = "#";
                modalRejectLink.style.display = "none";
            }

            modal.classList.remove("hidden");
        }

        function closeModal() {
            modal.classList.add("hidden");
        }

        btnVoirDetails.forEach(button => {
            button.addEventListener("click", openModal);
        });

        btnCloseX.addEventListener("click", closeModal);
        btnModalReject.addEventListener("click", closeModal);
        btnModalDelete.addEventListener("click", closeModal);

        modal.addEventListener("click", function(e) {
            if (e.target === modal) closeModal();
        });
    });
</script>