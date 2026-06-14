<div class="max-w-7xl mx-auto px-4 py-8 min-h-screen">
    
  <div class="mb-6">
        <?php 
        $urlRetour = "?controller=articles&page=accueil"; 

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 'admin') {
                $urlRetour = "?controller=articles&page=allArticles"; 
            } elseif ($_SESSION['user']['role'] === 'auteur') {
                $urlRetour = "?controller=articles&page=articleAuteur";
            }
        }
        ?>
        <a href="<?= $urlRetour ?>" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-pink-500 transition">
            <i class="fa-solid fa-arrow-left"></i> Retour aux articles
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <article class="lg:col-span-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 space-y-6">
            
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight">
                <?= htmlspecialchars($article['titre'] ?? "Les nouveautés de React 19 et comment s'y préparer dès aujourd'hui") ?>
            </h1>

            <div class="flex flex-wrap items-center justify-between gap-4 pb-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full overflow-hidden bg-gray-100 border border-gray-200">
                        <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($article['photo'] ?? 'default.jpg') ?>" alt="Auteur" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900"><?= htmlspecialchars(($article['prenom'] ?? 'Abdou Aziz') . ' ' . ($article['nom'] ?? 'Diouf')) ?></p>
                        <p class="text-xs text-gray-500">Publié le <?= htmlspecialchars($article['date'] ?? '24 mai 2026') ?></p>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg font-medium">
                    <i class="fa-regular fa-clock"></i> 5 min de lecture
                </div>
            </div>

            <div class="w-full h-[300px] md:h-[450px] rounded-2xl overflow-hidden bg-gray-100 shadow-inner">
                <img src="<?= WEBROOT ?>/uploads/<?= htmlspecialchars($article['image'] ?? 'react19.jpg') ?>" alt="Couverture" class="w-full h-full object-cover">
            </div>

            <div class="prose max-w-none text-gray-600 leading-relaxed space-y-6">
                <?= nl2br(htmlspecialchars($article['description'] ?? "Le contenu de l'article s'affichera ici...")) ?>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-gray-100 text-sm">
                <div class="text-gray-500">
                    <span class="font-bold text-gray-800">Catégorie :</span> 
                    <span class="bg-pink-50 text-pink-600 font-semibold px-3 py-1 rounded-md text-xs ml-1">
                        <?= htmlspecialchars($article['categorie_nom'] ?? 'Développement Web') ?>
                    </span>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-1.5 text-gray-400 hover:text-pink-500 transition">
                        <i class="fa-regular fa-bookmark"></i>
                    </button>
                    <button class="flex items-center gap-1.5 text-gray-400 hover:text-red-500 transition">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <a href="?controller=signalArticles&page=ajoutSignalArticle&id=<?= $article['id'] ?>" class="inline-flex items-center gap-1.5 text-red-500 font-semibold hover:underline">
                        <i class="fa-solid fa-flag text-xs"></i> signaler l'article
                    </a>
                </div>
            </div>

        </article>

        <aside class="lg:col-span-4 space-y-6">
            
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $article['id_auteur']): ?>
                <a href="?controller=articles&page=modifierArticle&id=<?= $article['id'] ?>" class="w-full inline-flex items-center justify-center gap-2 bg-pink-500 text-white font-bold px-5 py-3.5 rounded-xl shadow-sm hover:bg-pink-600 transition active:scale-95 text-sm">
                    <i class="fa-solid fa-pen text-xs"></i> modifier l'article
                </a>
            <?php endif; ?>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                <h3 class="font-extrabold text-gray-900 flex items-center gap-2 border-b border-gray-50 pb-3">
                    <i class="fa-solid fa-bars-staggered text-pink-500 text-sm"></i> Sommaire
                </h3>
                <nav class="space-y-2.5 text-sm font-medium text-gray-500">
                    <a href="#" class="block hover:text-pink-500 transition">1. Le React Compiler : Adieu useMemo</a>
                    <a href="#" class="block hover:text-pink-500 transition">2. Les Actions : Simplification</a>
                </nav>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center space-y-4">
                <div class="w-20 h-20 rounded-full overflow-hidden mx-auto border-2 border-pink-100 shadow-sm">
                    <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($article['photo'] ?? 'default.jpg') ?>" alt="Profil" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="font-extrabold text-gray-900"><?= htmlspecialchars(($article['prenom'] ?? 'Abdou Aziz') . ' ' . ($article['nom'] ?? 'Diouf')) ?></h4>
                    <p class="text-xs text-pink-500 font-bold mt-0.5">Auteur certifié</p>
                </div>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Lead Frontend Engineer @ TechCorp. Passionné par l'architecture Web et l'écosystème React.
                </p>
            </div>

        </aside>

    </div>

    <?php if (isset($article['statut']) && $article['statut'] === 'publie'): ?>
        <section class="max-w-none lg:w-[65.3%] mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 space-y-8">
            
            <div class="flex items-center justify-between border-b border-gray-50 pb-4">
                <h3 class="text-xl font-extrabold text-gray-900">
                    Commentaires <span class="text-gray-400 font-medium ml-1 text-lg">(<?= count($commentaires ?? []) ?>)</span>
                </h3>
                <select class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <option>les plus récents</option>
                </select>
            </div>

            <div class="flex gap-4">
                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0 hidden sm:block">
                    <?php if (isset($_SESSION['user'])): ?>
                        <img src="<?=WEBROOT?>/uploads/photos/<?= htmlspecialchars($_SESSION['user']['photo'] ?? 'default.jpg') ?>" alt="Mon Avatar" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="fa-solid fa-user"></i></div>
                    <?php endif; ?>
                </div>
                
                <form action="?controller=commentaires&page=ajoutCommentaire" method="POST" class="flex-1 space-y-3">
                    <input type="hidden" name="article_id" value="<?= $article['id'] ?>">
                    
                    <textarea 
                        name="contenu" 
                        rows="3" 
                        placeholder="Ajoutez un commentaire constructif..." 
                        class="w-full px-4 py-3 bg-gray-50 border <?= isset($errors['contenu']) ? 'border-red-400 focus:ring-red-300' : 'border-gray-200 focus:ring-pink-300' ?> rounded-xl focus:outline-none text-sm placeholder:text-gray-400 resize-none"
                    ><?= htmlspecialchars($_POST['contenu'] ?? '') ?></textarea>
                    
                    <?php if(isset($errors['contenu'])): ?>
                        <p class="text-xs text-red-500 font-semibold"><?= $errors['contenu'] ?></p>
                    <?php endif; ?>

                    <div class="flex justify-end">
                        <button type="submit" name="publier" class="bg-pink-500 text-white font-bold text-xs px-5 py-2.5 rounded-lg hover:bg-pink-600 transition tracking-wide shadow-sm active:scale-95">
                            publier
                        </button>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
                <?php if (!empty($commentaires)): ?>
                    <?php foreach ($commentaires as $com): ?>
                        <div class="space-y-4">
                            <div class="flex gap-3 items-start bg-gray-50/50 p-4 rounded-xl border border-gray-100/50 justify-between">
                                <div class="flex gap-3 items-start flex-1">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0">
                                        <img src="<?=WEBROOT?>/uploads/photos/<?= htmlspecialchars($com['photo'] ?? 'default.jpg') ?>" alt="Avatar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 space-y-1.5">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="text-sm font-bold text-gray-900"><?= htmlspecialchars($com['prenom'] . ' ' . $com['nom']) ?></span>
                                            
                                            <?php if ($com['utilisateur_id'] == $article['id_auteur']): ?>
                                                <span class="bg-pink-100 text-pink-600 font-extrabold text-[9px] px-1.5 py-0.5 rounded">Auteur</span>
                                            <?php endif; ?>
                                            
                                            <span class="text-[10px] text-gray-400">Le <?= date('d M Y à H:i', strtotime($com['date'])) ?></span>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">
                                            <?= nl2br(htmlspecialchars($com['contenu'])) ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="shrink-0 self-start">
                                    <a href="?controller=signalCommentaires&page=ajoutSignalCommentaires&id=<?= $com['id'] ?>&article_id=<?= $article['id'] ?>" 
                                       class="text-gray-400 hover:text-red-500 transition text-xs p-1" 
                                       title="Signaler ce commentaire">
                                        <i class="fa-solid fa-flag"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-6 text-sm text-gray-400 italic">
                        Aucun commentaire pour le moment. Soyez le premier à donner votre avis !
                    </div>
                <?php endif; ?>
            </div>

        </section>
    <?php else: ?>
        <div class="max-w-none lg:w-[65.3%] mt-8 bg-amber-50 border border-amber-200 text-amber-800 p-5 rounded-2xl text-sm flex items-center gap-3 shadow-sm">
            <!-- <span class="text-xl">⚠️</span> -->
            <p class="font-medium">L'espace de discussion est fermé. Il sera disponible dès que l'article sera officiellement publié.</p>
        </div>
    <?php endif; ?>
</div>