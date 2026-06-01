<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG221 - Gestion Catégories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    <aside class="w-64 bg-pink-200 flex flex-col justify-between p-4 h-full shrink-0">
        <div>
            <div class="mb-8 pl-2">
                <h1 class="text-2xl font-bold flex items-center gap-2 text-gray-800">
                    <i class="fa-solid fa-square-rss text-3xl"></i> LOG221
                </h1>
                <p class="text-xs text-gray-600 font-medium tracking-wider mt-1 pl-1">Admin</p>
            </div>

            
            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                    <i class="fa-solid fa-chart-pie w-5 text-lg"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                    <i class="fa-solid fa-user w-5 text-lg"></i> Utilisateurs
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                    <i class="fa-solid fa-book-open w-5 text-lg"></i> Articles
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-900 font-bold bg-pink-300 rounded-lg shadow-sm">
                    <i class="fa-solid fa-tags w-5 text-lg"></i> Catégories
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                    <i class="fa-solid fa-triangle-exclamation w-5 text-lg"></i> Signalements
                </a>
            </nav>
        </div>

        <div>
            <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-700 font-medium rounded-lg hover:bg-pink-300 transition">
                <i class="fa-solid fa-right-from-bracket w-5 text-lg"></i> Deconnexion
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm shrink-0">
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" placeholder="recherche" class="w-full pl-10 pr-4 py-2 border border-gray-300 bg-gray-50 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-pink-300">
            </div>
            <div class="flex items-center gap-4">
                <button class="text-gray-600 hover:text-gray-900 relative">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-pink-500 rounded-full"></span>
                </button>
                <div class="flex items-center gap-3">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-gray-300">
                    <span class="text-sm font-semibold text-gray-800">Abdou Aziz Diouf</span>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8 overflow-y-auto bg-gray-50">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Gestion des Catégories</h2>
                <p class="text-sm text-gray-500">Gérez, ajoutez et modifiez les thématiques de la plateforme.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <span class="font-bold text-gray-800">Toutes les catégories</span>
                        <span class="px-2.5 py-1 text-xs font-semibold text-pink-700 bg-pink-100 rounded-full">4 catégories</span>
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
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="py-4 px-6 font-medium text-gray-400">#1</td>
                                    <td class="py-4 px-6 font-semibold text-gray-800">Technologie</td>
                                    <td class="py-4 px-6 flex justify-center gap-3">
                                        <button title="Modifier" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button title="Supprimer" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="py-4 px-6 font-medium text-gray-400">#2</td>
                                    <td class="py-4 px-6 font-semibold text-gray-800">Sport & Santé</td>
                                    <td class="py-4 px-6 flex justify-center gap-3">
                                        <button title="Modifier" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button title="Supprimer" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="py-4 px-6 font-medium text-gray-400">#3</td>
                                    <td class="py-4 px-6 font-semibold text-gray-800">Culture & Art</td>
                                    <td class="py-4 px-6 flex justify-center gap-3">
                                        <button title="Modifier" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button title="Supprimer" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 self-start">
                    <h3 class="text-lg font-bold text-gray-800 mb-1" id="form-title">Ajouter une catégorie</h3>
                    <p class="text-xs text-gray-400 mb-6">Créez un nouvel intitulé pour classer les articles.</p>

                    <form action="" method="POST" class="space-y-4">
                        <input type="hidden" name="id" id="categorie-id" value="">

                        <div>
                            <label for="nom" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                Nom de la catégorie
                            </label>
                            <input type="text" name="nom" id="nom" required placeholder="Ex: Économie, Politique..." 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-pink-300 transition">
                        </div>

                        <div class="pt-2 space-y-2">
                            <button type="submit" class="w-full bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm transition text-sm flex items-center justify-center gap-2">
                                <i class="fa-solid fa-plus"></i> Enregistrer la catégorie
                            </button>
                            <button type="button" id="btn-annuler" class="hidden w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-2.5 px-4 rounded-lg transition text-sm">
                                Annuler la modification
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

    <script>
        function passerEnModeEdition(id, nom) {
            document.getElementById('form-title').innerText = "Modifier la catégorie " + nom;
            document.getElementById('categorie-id').value = id;
            document.getElementById('nom').value = nom;
            document.getElementById('btn-annuler').classList.remove('hidden');
        }
    </script>
</body>
</html>