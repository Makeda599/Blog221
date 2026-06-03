<div class="max-w-7xl mx-auto px-4 py-8 space-y-8 min-h-screen">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Mes articles</h1>
            <p class="text-gray-500 mt-2">Gérez vos publications, suivez vos statistiques et rédigez de nouveaux contenus avec élégance.</p>
        </div>
        <a href="?controller=articles&page=ajoutArticle" class="inline-flex items-center gap-2 bg-pink-500 text-white font-semibold px-5 py-3 rounded-xl shadow-sm hover:bg-pink-600 transition active:scale-95">
            <i class="fa-solid fa-plus text-sm"></i> ajouter article
        </a>
    </div>

    <div class="flex flex-col lg:flex-row justify-between items-stretch lg:items-center gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex items-center gap-2 flex-1">
            <div class="relative w-full max-w-md">
                <input type="text" placeholder="recherche" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300 text-sm">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-gray-400 text-sm"></i>
            </div>
            <button class="p-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-100">
                <i class="fa-solid fa-sliders"></i>
            </button>
        </div>

        <div class="flex flex-wrap items-center gap-3 text-sm">
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>Tous</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>Publié</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>En-attente</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:outline-none focus:ring-2 focus:ring-pink-300">
                <option>signalé</option>
            </select>
        </div>
    </div>

    <?php if (empty($articles)): ?>
        <div class="text-center bg-white border border-gray-200 rounded-xl p-16 shadow-sm">
            <div class="text-gray-300 mb-4">
                <i class="fa-regular fa-folder-open text-6xl"></i>
            </div>
            <p class="text-gray-500 font-medium text-lg">Vous n'avez pas encore rédigé d'articles.</p>
            <a href="?controller=articles&page=ajoutArticle" class="text-pink-500 hover:underline mt-2 inline-block text-sm">Commencer à écrire dès maintenant</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($articles as $article): ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition duration-300 relative">

                    <span class="absolute top-3 left-3 bg-white/95 text-gray-800 text-xs font-bold px-2.5 py-1 rounded-md shadow-sm z-10 backdrop-blur-sm">
                        <?= htmlspecialchars($article['categorie_nom'] ?? 'Général') ?>
                    </span>

                    <div class="h-48 w-full bg-gray-100 overflow-hidden relative">
                        <?php if (!empty($article['image']) && file_exists(ROOT . "public/uploads/" . $article['image'])): ?>
                            <img src="<?= WEBROOT  ?>/uploads/<?= htmlspecialchars($article['image']) ?>" alt="Couverture" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                <i class="fa-regular fa-image text-4xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-5 flex flex-col flex-1 space-y-3">
                        <h3 class="font-bold text-gray-900 text-lg leading-snug line-clamp-2 min-h-[3.5rem] group-hover:text-pink-500 transition">
                            <?= htmlspecialchars($article['titre']) ?>
                        </h3>

                        <p class="text-gray-500 text-sm line-clamp-3 flex-1">
                            <?= htmlspecialchars($article['description']) ?>
                        </p>

                        <div class="pt-2 border-t border-gray-50">
                            <a href="?controller=articles&page=detailArticle&id=<?= $article['id'] ?>" class="inline-flex items-center gap-2 bg-pink-500 text-white font-medium text-xs px-4 py-2.5 rounded-lg hover:bg-pink-600 transition tracking-wide active:scale-95 shadow-sm">
                                voir article <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>