       <div class="w-full grid grid-cols-1 xl:grid-cols-4 gap-8 items-start px-4">

           <div class="xl:col-span-3 bg-white rounded-xl border border-gray-200 p-8 space-y-6 shadow-sm w-full">

               <h2 class="text-3xl font-bold flex items-center gap-3 text-gray-800">
                   <i class="fa-solid fa-file-circle-plus text-2xl text-gray-700"></i> Ajout article
               </h2>


                   <?php if (!empty($errors)): ?>
                       <div class="bg-red-50 border-l-4 border-red-500 p-4 text-red-700 text-sm">
                           <i class="fa-solid fa-triangle-exclamation mr-2"></i> Certains champs sont incorrects.
                       </div>
                   <?php endif; ?>

                   <form action="?controller=articles&page=ajoutArticle" method="POST" enctype="multipart/form-data" class="space-y-6 w-full">

                       <div class="space-y-2">
                           <div class="border-2 border-dashed <?= isset($errors['image']) ? 'border-red-400 bg-red-50' : 'border-gray-300 bg-gray-50' ?> rounded-lg p-12 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-100 transition group relative w-full h-64 overflow-hidden">

                               <div id="upload-placeholder" class="flex flex-col items-center justify-center text-center">
                                   <div class="text-gray-400 group-hover:text-gray-600 transition mb-2">
                                       <i class="fa-regular fa-image text-5xl"></i>
                                   </div>
                                   <span class="text-sm text-gray-500 font-medium">Ajoutez une image de couverture</span>
                               </div>

                               <img id="image-preview" src="#" alt="Aperçu de la couverture" class="absolute inset-0 w-full h-full object-cover hidden">

                               <input type="file" name="image" id="image-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                           </div>
                           <?php if (isset($errors['image'])): ?>
                               <p class="text-red-500 text-xs mt-1 italic"><?= $errors['image'] ?></p>
                           <?php endif; ?>
                       </div>

                       <div class="space-y-2 w-full">
                           <label class="block text-xl font-medium text-gray-800">Catégorie</label>
                           <div class="relative w-full">
                               <select name="id_categorie" class="w-full bg-white border <?= isset($errors['id_categorie']) ? 'border-red-500 ring-1 ring-red-100' : 'border-gray-300' ?> rounded-lg px-4 py-3.5 appearance-none focus:outline-none focus:ring-2 focus:ring-pink-300 text-gray-800">
                                   <option value="" disabled <?= !isset($save['id_categorie']) ? 'selected' : '' ?>>Choisissez une catégorie</option>
                                   <?php if (isset($categories)): ?>
                                       <?php foreach ($categories as $cat): ?>
                                           <option value="<?= $cat['id'] ?>" <?= (isset($save['id_categorie']) && $save['id_categorie'] == $cat['id']) ? 'selected' : '' ?>>
                                               <?= htmlspecialchars($cat['nom']) ?>
                                           </option>
                                       <?php endforeach; ?>
                                   <?php endif; ?>
                               </select>
                               <div class="absolute inset-y-0 right-4 flex flex-col justify-center pointer-events-none text-gray-500 text-xs gap-0.5">
                                   <i class="fa-solid fa-chevron-up"></i>
                                   <i class="fa-solid fa-chevron-down"></i>
                               </div>
                           </div>
                           <?php if (isset($errors['id_categorie'])): ?>
                               <p class="text-red-500 text-xs italic"><?= $errors['id_categorie'] ?></p>
                           <?php endif; ?>
                       </div>

                       <div class="space-y-2 w-full">
                           <label class="block text-xl font-medium text-gray-800">Titre</label>
                           <div class="relative w-full">
                               <input type="text" name="titre" value="<?= $save['titre'] ?? '' ?>" placeholder="Donnez le titre de l'article"
                                   class="w-full bg-white border <?= isset($errors['titre']) ? 'border-red-500 ring-1 ring-red-100' : 'border-gray-300' ?> rounded-lg px-4 py-3.5 pr-10 focus:outline-none focus:ring-2 focus:ring-pink-300 text-gray-800 placeholder-gray-400">
                               <span class="absolute inset-y-0 right-4 flex items-center text-gray-400">
                                   <i class="fa-regular fa-keyboard"></i>
                               </span>
                           </div>
                           <?php if (isset($errors['titre'])): ?>
                               <p class="text-red-500 text-xs italic"><?= $errors['titre'] ?></p>
                           <?php endif; ?>
                       </div>

                       <div class="space-y-2 w-full">
                           <label class="block text-xl font-medium text-gray-800">Date</label>
                           <div class="relative w-full">
                               <input type="date" name="date" value="<?= $save['date'] ?? '' ?>"
                                   class="w-full bg-white border <?= isset($errors['date']) ? 'border-red-500 ring-1 ring-red-100' : 'border-gray-300' ?> rounded-lg px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-pink-300 text-gray-800">
                           </div>
                           <?php if (isset($errors['date'])): ?>
                               <p class="text-red-500 text-xs italic"><?= $errors['date'] ?></p>
                           <?php endif; ?>
                       </div>

                       <div class="space-y-2 w-full">
                           <label class="block text-xl font-medium text-gray-800">Description</label>
                           <textarea name="description" rows="8" placeholder="Écrivez le contenu de votre article ici..."
                               class="w-full bg-white border <?= isset($errors['description']) ? 'border-red-500 ring-1 ring-red-100' : 'border-gray-300' ?> rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-pink-300 text-gray-800 placeholder-gray-400"><?= $save['description'] ?? '' ?></textarea>
                           <?php if (isset($errors['description'])): ?>
                               <p class="text-red-500 text-xs italic"><?= $errors['description'] ?></p>
                           <?php endif; ?>
                       </div>

                       <div class="pt-2">
                           <button type="submit" name="envoyer" value="envoyer" class="w-44 bg-pink-400 text-white py-3 rounded-lg font-semibold shadow-sm hover:bg-pink-500 active:scale-[0.98] transition">
                               envoyer
                           </button>
                       </div>
                   </form>
               
           </div>

           <aside class="bg-white rounded-xl border border-gray-200 p-5 space-y-5 shadow-sm w-full">
               <div class="flex items-center gap-2 text-gray-800 font-bold text-lg border-b pb-3">
                   <i class="fa-solid fa-gear text-gray-600"></i>
                   <h3>Paramètres</h3>
               </div>

               <!-- Statut -->
               <div class="space-y-2">
                   <span class="block text-sm font-bold text-gray-700">Statut</span>
                   <div class="inline-flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-md px-3 py-1.5 text-xs text-gray-600 font-medium">
                       <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                       en_attente
                   </div>
               </div>

               <!-- Visibilité -->
               <div class="space-y-2">
                   <span class="block text-sm font-bold text-gray-700">Visible</span>
                   <div class="inline-flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-md px-3 py-1.5 text-xs text-gray-600 font-medium">
                       <span class="w-2 h-2 rounded-full bg-green-400"></span>
                       tout le monde
                   </div>
               </div>
           </aside>

       </div>

    <script>
    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('upload-placeholder');
                
                preview.src = event.target.result;
                preview.classList.remove('hidden'); // Affiche l'image
                placeholder.classList.add('hidden'); // Cache le texte d'origine
            }
            reader.readAsDataURL(file);
        }
    });
</script>