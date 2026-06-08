<div class="max-w-3xl mx-auto px-4 py-8 min-h-screen">
    
    <div class="mb-6">
        <a href="?controller=articles&page=detailArticle&id=<?= $article['id'] ?>" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-pink-500 transition">
            <i class="fa-solid fa-arrow-left"></i> Retour à l'article
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 space-y-6">
        
        <div class="border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight flex items-center gap-2">
                <i class="fa-solid fa-flag text-red-500 text-xl"></i> Signaler un article
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Vous êtes sur le point de signaler l'article : 
                <span class="font-bold text-gray-800">"<?= htmlspecialchars($article['titre']) ?>"</span>
            </p>
        </div>

        <form action="?controller=signalArticles&page=ajoutSignalArticle&id=<?=$article['id']?>" method="POST" class="space-y-6">
            <input type="hidden" name="article_id" value="<?= $article['id'] ?>">

            <div class="space-y-2">
                <label for="motif_select" class="block text-sm font-bold text-gray-700">
                    Quel est le motif du signalement ? <span class="text-red-500">*</span>
                </label>
                
                <select name="motif_select" id="motif_select" onchange="toggleAutreChamp(this)" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-300 text-sm">
                    <option value="Contenu inapproprié ou offensant" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Contenu inapproprié ou offensant') ? 'selected' : '' ?>>Contenu inapproprié ou offensant</option>
                    <option value="Plagiat ou non-respect des droits d'auteur" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Plagiat ou non-respect des droits d\'auteur') ? 'selected' : '' ?>>Plagiat ou non-respect des droits d'auteur</option>
                    <option value="Fausses informations (Fake News)" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Fausses informations (Fake News)') ? 'selected' : '' ?>>Fausses informations (Fake News)</option>
                    <option value="Spam ou contenu publicitaire abusif" <?= (isset($save['motif_select']) && $save['motif_select'] === 'Spam ou contenu publicitaire abusif') ? 'selected' : '' ?>>Spam ou contenu publicitaire abusif</option>
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
                    placeholder="Ex: Contenu hors-sujet, Liens cassés répétitifs..." 
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
                    placeholder="Fournissez des détails supplémentaires pour aider l'équipe de modération à comprendre la situation..." 
                    class="w-full px-4 py-3 bg-gray-50 border <?= isset($errors['description']) ? 'border-red-400 focus:ring-red-300' : 'border-gray-200 focus:ring-pink-300' ?> rounded-xl focus:outline-none text-sm placeholder:text-gray-400 resize-none"
                ><?= htmlspecialchars($save['description'] ?? '') ?></textarea>
                
                <?php if(isset($errors['description'])): ?>
                    <p class="text-xs text-red-500 font-semibold"><?= $errors['description'] ?></p>
                <?php endif; ?>
            </div>

            <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl text-xs flex items-start gap-2.5">
                <span class="text-base leading-none">⚠️</span>
                <p class="leading-relaxed">
                    Chaque signalement est examiné avec soin par notre équipe de modération. Les abus de signalements répétés peuvent faire l'objet de sanctions.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="?controller=articles&page=detail&id=<?= $article['id'] ?>" class="px-5 py-2.5 text-sm font-bold text-gray-500 hover:bg-gray-50 rounded-xl transition">
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