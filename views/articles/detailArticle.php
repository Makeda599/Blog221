<div class="max-w-7xl mx-auto px-4 py-8 min-h-screen">
    
    <div class="mb-6">
        <a href="?controller=articles&page=articleAuteur" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-pink-500 transition">
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
                    <a href="?controller=articles&page=signaler&id=<?= $article['id'] ?>" class="inline-flex items-center gap-1.5 text-red-500 font-semibold hover:underline">
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

    <section class="max-w-none lg:w-[65.3%] mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 space-y-8">
        
        <div class="flex items-center justify-between border-b border-gray-50 pb-4">
            <h3 class="text-xl font-extrabold text-gray-900">
                Commentaires <span class="text-gray-400 font-medium ml-1 text-lg">(24)</span>
            </h3>
            <select class="bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold text-gray-600 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>les plus pertinents</option>
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
            
            <form action="?controller=articles&page=ajouterCommentaire" method="POST" class="flex-1 space-y-3">
                <input type="hidden" name="id_article" value="<?= $article['id'] ?>">
                <textarea 
                    name="contenu" 
                    rows="3" 
                    placeholder="Ajoutez un commentaire constructif..." 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-300 text-sm placeholder:text-gray-400 resize-none"
                    required
                ></textarea>
                <div class="flex justify-end">
                    <button type="submit" class="bg-pink-500 text-white font-bold text-xs px-5 py-2.5 rounded-lg hover:bg-pink-600 transition tracking-wide shadow-sm active:scale-95">
                        publier
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-6">
            
            <div class="space-y-4">
                <div class="flex gap-3 items-start bg-gray-50/50 p-4 rounded-xl border border-gray-100/50">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0">
                        <img src="<?= WEBROOT ?>/uploads/photos/avatar2.jpg" alt="User" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-gray-900">Aminata UI</span>
                            <span class="text-[10px] text-gray-400">Il y a 3 heures</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Super résumé ! L'arrivée du Compiler est vraiment ce que j'attends le plus. Avez-vous des informations sur l'impact potentiel sur les temps de build dans des monorepos larges ?
                        </p>
                        <div class="flex items-center gap-4 pt-1 text-xs font-semibold text-gray-400">
                            <button class="hover:text-pink-500 flex items-center gap-1"><i class="fa-regular fa-comment text-[11px]"></i> répondre</button>
                            <button class="hover:text-pink-500 flex items-center gap-1"><i class="fa-regular fa-heart text-[11px]"></i> 12</button>
                            <a href="#" class="hover:text-red-500 ml-auto flex items-center gap-1 text-[11px]"><i class="fa-solid fa-flag text-[9px]"></i> signaler</a>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 items-start ml-6 md:ml-12 bg-pink-50/30 p-4 rounded-xl border border-pink-100/20">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shrink-0">
                        <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($article['auteur_photo'] ?? 'default.jpg') ?>" alt="Auteur" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1.5">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-gray-900"><?= htmlspecialchars(($article['prenom'] ?? 'Abdou Aziz') . ' ' . ($article['nom'] ?? 'Diouf')) ?></span>
                            <span class="bg-pink-100 text-pink-600 font-extrabold text-[9px] px-1.5 py-0.5 rounded">Auteur</span>
                            <span class="text-[10px] text-gray-400">Il y a 2 heures</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Merci Aminata ! D'après les premiers retours de l'équipe Meta, l'impact sur le build est minime car le compiler utilise des heuristiques très optimisées. Le gain de perfs au runtime compense largement.
                        </p>
                        <div class="flex items-center gap-4 pt-1 text-xs font-semibold text-gray-400">
                            <button class="hover:text-pink-500 flex items-center gap-1"><i class="fa-regular fa-comment text-[11px]"></i> répondre</button>
                            <a href="#" class="hover:text-red-500 ml-auto flex items-center gap-1 text-[11px]"><i class="fa-solid fa-flag text-[9px]"></i> signaler</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

</div>