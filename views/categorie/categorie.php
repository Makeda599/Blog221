<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gestion des Catégories</h2>
    <p class="text-sm text-gray-500">Gérez, ajoutez et modifiez les thématiques du blog.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- LISTE DES CATÉGORIES -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <span class="font-bold text-gray-800">Toutes les catégories</span>
            <span class="px-2.5 py-1 text-xs font-semibold text-pink-700 bg-pink-100 rounded-full">
               <?= count($categories) ?> catégories
            </span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/70 text-xs font-semibold uppercase tracking-wider text-gray-500">
                        <th class="py-3 px-6 w-16">ID</th>
                        <th class="py-3 px-6">Nom de la catégorie</th>
                        <th class="py-3 px-6 text-center w-32">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                  <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <?php foreach($categories as $categorie): ?>
                        <?php extract($categorie) ?>
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-4 px-6 font-medium text-gray-400">#1</td>
                            <td class="py-4 px-6 font-semibold text-gray-800"><?= $nom ?></td>
                            <td class="py-4 px-6 flex justify-center gap-3">
                                <button onclick="passerEnModeEdition(1, 'Technologie')" title="Modifier" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <a href="<?= path('categories','deleteCategorie') ?>&id=1" onclick="return confirm('Supprimer cette catégorie ?')" title="Supprimer" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;  ?>
                        <!-- <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-4 px-6 font-medium text-gray-400">#2</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">Sport & Santé</td>
                            <td class="py-4 px-6 flex justify-center gap-3">
                                <button onclick="passerEnModeEdition(2, 'Sport &amp; Santé')" title="Modifier" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <a href="<?= path('categories','deleteCategorie') ?>&id=2" onclick="return confirm('Supprimer cette catégorie ?')" title="Supprimer" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr> -->
                    </tbody>
               
            </table>
        </div>
    </div>

    <!-- FORMULAIRE AJOUT / MODIFICATION -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start">
        <h3 class="text-lg font-bold text-gray-800 mb-1" id="form-title">Ajouter une catégorie</h3>
        <p class="text-xs text-gray-400 mb-6" id="form-desc">Créez un nouvel intitulé pour classer les articles.</p>

        <form method="POST" action="<?= path('categories','allCategorie') ?>" class="space-y-4">
            <input type="hidden" name="id" id="categorie-id" value="">

            <div>
                <label for="nom" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                        <span class="text-red-500 text-xs block mb-1"><?= $errors['nomCategorie'] ?? "" ?></span>
                    Nom de la catégorie
                </label>
                <input type="text" name="nomCategorie" id="nom" placeholder="Ex: Économie, Politique..."
                    class="w-full px-4 py-2.5 border <?= !empty($errors['nomCategorie']) ? 'border-red-400' : 'border-gray-300' ?> rounded-lg text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-300 transition">
            </div>

            <div class="pt-2 space-y-2">
                <button type="submit" name="envoie" id="btn-submit" class="w-full bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> Enregistrer la catégorie
                </button>
                <button type="button" id="btn-annuler" onclick="cancelEdition()" class="hidden w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-2.5 px-4 rounded-lg transition text-sm">
                    Annuler la modification
                </button>
            </div>
        </form>
    </div>

</div>

<script>
    function passerEnModeEdition(id, nom) {
        document.getElementById('form-title').innerText = "Modifier la catégorie";
        document.getElementById('form-desc').innerText = "Modifiez le nom de la catégorie sélectionnée.";
        document.getElementById('categorie-id').value = id;
        document.getElementById('nom').value = nom;

        const btnSubmit = document.getElementById('btn-submit');
        btnSubmit.innerHTML = '<i class="fa-solid fa-pen"></i> Mettre à jour';
        btnSubmit.className = "w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2";

        document.getElementById('btn-annuler').classList.remove('hidden');
    }

    function cancelEdition() {
        document.getElementById('form-title').innerText = "Ajouter une catégorie";
        document.getElementById('form-desc').innerText = "Créez un nouvel intitulé pour classer les articles.";
        document.getElementById('categorie-id').value = "";
        document.getElementById('nom').value = "";

        const btnSubmit = document.getElementById('btn-submit');
        btnSubmit.innerHTML = '<i class="fa-solid fa-plus"></i> Enregistrer la catégorie';
        btnSubmit.className = "w-full bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2";

        document.getElementById('btn-annuler').classList.add('hidden');
    }
</script>