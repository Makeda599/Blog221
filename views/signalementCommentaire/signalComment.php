<div class="max-w-3xl mx-auto px-4 py-8 min-h-screen">
    
    <div class="mb-6">
        <!-- Retour vers l'article d'origine grâce à la variable passée par le contrôleur -->
        <a href="?controller=articles&page=detailArticle&id=<?= $article_id ?>" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-pink-500 transition">
            <i class="fa-solid fa-arrow-left"></i> Retour à l'article
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 space-y-6">
        
        <div class="border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-flag text-red-500 text-xl"></i> Signaler un commentaire
            </h1>
            <p class="text-sm text-gray-500 mt-2 bg-gray-50 p-3 rounded-xl border border-gray-100 italic text-gray-700">
                "<?= htmlspecialchars($commentaire['contenu'] ?? '') ?>"
            </p>
            <p class="text-xs text-gray-400 mt-1">
                Dans l'article : <span class="font-semibold text-gray-600">"<?= htmlspecialchars($commentaire['article_titre'] ?? '') ?>"</span>
            </p>
        </div>

        <!-- L'action pointe bien vers le contrôleur de signalement des commentaires -->
        <form action="?controller=signalCommentaires&page=ajoutSignalCommentaires&id=<?= $commentaire['id'] ?>&article_id=<?= $article_id ?>" method="POST" class="space-y-6">
            <input type="hidden" name="commentaire_id" value="<?= $commentaire['id'] ?>">

            <div class="space-y-2">
                <label for="motif_select" class="block text-sm font-bold text-gray-700">
                    Quel est le motif du signalement ? <span class="text-red-500">*</span>
                </label>
                
                <select name="motif_select" id="motif_select" onchange="toggleAutreChamp(this)" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-300 text-sm">
                    <option value="Propos haineux, harcèlement ou insultes" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Propos haineux, harcèlement ou insultes') ? 'selected' : '' ?>>Propos haineux, harcèlement ou insultes</option>
                    <option value="Spam, publicité ou hameçonnage" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Spam, publicité ou hameçonnage') ? 'selected' : '' ?>>Spam, publicité ou hameçonnage</option>
                    <option value="Contenu à caractère sexuel ou inapproprié" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Contenu à caractère sexuel ou inapproprié') ? 'selected' : '' ?>>Contenu à caractère sexuel ou inapproprié</option>
                    <option value="Divulgation d'informations personnelles" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Divulgation d\'informations personnelles') ? 'selected' : '' ?>>Divulgation d'informations personnelles</option>
                    <option value="Autre" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Autre') ? 'selected' : '' ?>>Autre (Préciser ci-dessous)</option>
                </select>
            </div>

            <div id="champ_autre" class="space-y-2 <?= (isset($save['motif_select']) && $save['motif_select'] === 'Autre') ? '' : 'hidden' ?>">
                <label for="motif_autre" class="block text-sm font-bold text-gray-700">
                    Veuillez spécifier votre motif : <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text"
                    name="motif_autre" 
                    id="motif_autre"
                    placeholder="Ex: Commentaire complètement hors-sujet..." 
                    value="<?= htmlspecialchars($save['motif_autre'] ?? '') ?>"
                    class="w-full px-4 py-3 bg-gray-50 border <?= isset($errors['motif_autre']) ? 'border-red-400 focus:ring-red-300' : 'border-gray-200 focus:ring-pink-300' ?> rounded-xl focus:outline-none text-sm placeholder:text-gray-400"
                >
                <?php if(isset($errors['motif_autre'])): ?>
                    <p class="text-xs text-red-500 font-semibold"><?= $errors['motif_autre'] ?></p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <label for="description" class="block text-sm font-bold text-gray-700">
                        Description / Informations complémentaires
                    </label>
                    <span class="text-xs text-gray-400 font-normal">Recommandé</span>
                </div>
                <textarea 
                    name="description" 
                    id="description"
                    rows="5" 
                    placeholder="Fournissez des détails supplémentaires pour aider l'équipe de modération..." 
                    class="w-full px-4 py-3 bg-gray-50 border <?= isset($errors['description']) ? 'border-red-400 focus:ring-red-300' : 'border-gray-200 focus:ring-pink-300' ?> rounded-xl focus:outline-none text-sm placeholder:text-gray-400 resize-none"
                ><?= htmlspecialchars($save['description'] ?? '') ?></textarea>
                
                <?php if(isset($errors['description'])): ?>
                    <p class="text-xs text-red-500 font-semibold"><?= $errors['description'] ?></p>
                <?php endif; ?>
            </div>

            <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl text-xs flex items-start gap-2.5">
                <span class="text-base leading-none">⚠️</span>
                <p class="leading-relaxed">
                    Chaque signalement de commentaire est examiné avec soin par notre équipe. Les abus répétés peuvent faire l'objet de sanctions sur votre compte.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="?controller=articles&page=detailArticle&id=<?= $article_id ?>" class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-50 rounded-xl transition">
                    Annuler
                </a>
                <button type="submit" name="envoyer_signalement" class="bg-red-500 text-white font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-red-600 transition tracking-wide shadow-sm active:scale-95">
                    Envoyer le signalement
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function toggleAutreChamp(select) {
    const champAutre = document.getElementById('champ_autre');
    if (select.value === 'Autre') {
        champAutre.classList.remove('hidden');
    } else {
        champAutre.classList.add('hidden');
    }
}
</script>