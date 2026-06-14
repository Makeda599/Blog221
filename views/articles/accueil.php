<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome pour les icônes de déconnexion si nécessaire -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Inclusion de la bibliothèque AOS pour les animations au scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Blog221 - Accueil</title>
    <style>
        /* Animation personnalisée pour un flottement plus doux que le bounce natif */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 4s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
</head>
<body class="bg-[#f4f4f4] font-sans text-gray-900 overflow-x-hidden">

<header class="bg-white py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50 border-b border-gray-100 backdrop-blur-md bg-white/90">
    <div class="text-2xl font-bold flex items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
        <span class="bg-black text-white px-2 py-1 rounded mr-2 text-xl shadow-md">B</span> LOG221
    </div>
    <nav class="hidden md:flex space-x-8 font-medium">
        <a href="?controller=articles&page=accueil" class="text-[#ff00cc] border-b-2 border-[#ff00cc] pb-1">Accueil</a>
        <a href="#" class="text-gray-600 hover:text-[#ff00cc] transition-colors duration-300">À propos</a>
        <a href="#" class="text-gray-600 hover:text-[#ff00cc] transition-colors duration-300">Contact</a>
    </nav>
    
    <div class="flex space-x-4 items-center">
        <?php if (isset($_SESSION['user'])): ?>
            <div class="flex items-center gap-3 bg-gray-50 p-1.5 pr-3 rounded-full border border-gray-100">
                <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-100 border border-gray-200 shadow-sm">
                    <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($_SESSION['user']['photo'] ?? 'default.jpg') ?>" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <div class="hidden sm:block text-left">
                    <p class="text-xs font-bold text-gray-900"><?= htmlspecialchars($_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']) ?></p>
                    <p class="text-[10px] text-gray-400 capitalize"><?= htmlspecialchars($_SESSION['user']['role'] ?? 'Lecteur') ?></p>
                </div>
                <a href="?controller=auth&page=logOut" class="ml-2 text-gray-400 hover:text-red-500 transition-colors duration-300 text-sm" title="Se déconnecter">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>
        <?php else: ?>
            <button class="border border-[#ff00cc] text-[#ff00cc] px-5 py-2 rounded-xl text-sm font-semibold hover:bg-pink-50 transition-all duration-300 transform active:scale-95">
                <a href="<?= path("auth","login") ?>">Se connecter</a>
            </button>
            <button class="bg-[#ff00cc] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-opacity-90 shadow-sm hover:shadow-md transition-all duration-300 transform active:scale-95">
                <a href="<?= path("auth","inscription") ?>">S'inscrire</a>
            </button>
        <?php endif; ?>
    </div>
</header>

    <!-- Section Hero avec entrées asynchrones -->
    <section class="max-w-7xl mx-auto p-6 md:p-12">
        <div class="bg-white rounded-3xl p-8 md:p-16 flex flex-col md:flex-row items-center gap-12 relative overflow-hidden shadow-sm border border-gray-50">
            <div class="flex-1 z-10" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                    Bienvenue sur <span class="inline-flex items-center bg-black text-white px-3 py-1 rounded-lg text-3xl font-bold shadow-lg"><span class="text-white mr-1">B</span>LOG221</span>
                </h1>
                <p class="text-gray-600 text-base md:text-lg mb-8 leading-relaxed max-w-xl">
                    Découvrez un espace dédié à la création, au partage et à l'échange d'idées. Que vous soyez auteur, lecteur, ou simplement passionné, ce blog est conçu pour vous.
                </p>
                <button class="bg-[#ff00cc] text-white px-10 py-3 rounded-xl font-bold hover:bg-opacity-95 shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                    S'inscrire
                </button>
            </div>
            <div class="flex-1 relative w-full flex justify-center" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="relative w-full max-w-md group">
                    <div class="overflow-hidden rounded-2xl shadow-xl border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&w=600" alt="Bureau" class="w-full object-cover h-[350px] transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <!-- Badges flottants avec animation de respiration -->
                    <div class="absolute -top-4 -right-4 bg-white/90 backdrop-blur-sm border border-gray-100 py-1.5 px-3 rounded-lg shadow-md text-xs text-gray-700 flex items-center gap-1 animate-float">
                        <span>📋</span> 12 articles par jour
                    </div>
                    <div class="absolute -bottom-4 -left-4 bg-white py-2 px-4 rounded-xl shadow-md border border-gray-100 flex items-center gap-2 text-sm font-semibold animate-float-delayed">
                        <span class="text-gray-800">📊 12k+ lecteurs</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Grille des articles à la une (Effet cascade / Stagger) -->
<section class="max-w-7xl mx-auto px-6 py-12">
    <div data-aos="fade-up" data-aos-duration="800">
        <h2 class="text-3xl font-extrabold mb-2 flex items-center gap-2">
            À la une sur <span class="inline-flex items-center bg-black text-white px-2 py-0.5 rounded text-xl font-bold">B</span>LOG221
        </h2>
        <p class="text-gray-500 mb-10 text-sm">Découvrez les derniers articles publiés par notre communauté d'auteurs talentueux.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php if (!empty($articlesALaUne)): ?>
            <?php $delay = 100; foreach ($articlesALaUne as $art): ?>
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full relative group" 
                     data-aos="fade-up" 
                     data-aos-delay="<?= $delay; ?>" 
                     data-aos-duration="800">
                    <div class="relative overflow-hidden">
                        <img src="<?= WEBROOT ?>/uploads/<?= htmlspecialchars($art['image'] ?? 'default.jpg') ?>" class="h-44 w-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-gray-700 text-[10px] uppercase font-bold px-2 py-1 rounded-md shadow-sm z-10">
                            <?= htmlspecialchars($art['categorie_nom'] ?? 'Tech') ?>
                        </span>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-extrabold text-sm text-gray-900 mb-2 line-clamp-2 group-hover:text-[#ff00cc] transition-colors duration-300"><?= htmlspecialchars($art['titre']) ?></h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-3 leading-relaxed"><?= htmlspecialchars($art['description']) ?></p>
                        <div class="mt-auto">
                            <div class="flex items-center gap-2 text-xs text-gray-600 mb-3 border-t pt-3">
                                <img src="<?= WEBROOT ?>/uploads/photos/<?= htmlspecialchars($art['photo'] ?? 'default.jpg') ?>" class="w-6 h-6 rounded-full object-cover">
                                <span class="font-medium truncate"><?= htmlspecialchars($art['prenom'] . ' ' . $art['nom']) ?></span>
                                <span class="text-gray-400 ml-auto text-[10px]"><?= date('d M', strtotime($art['date'])) ?></span>
                            </div>
                            <?php if(isset($_SESSION["user"])) : ?>
                            <a href="?controller=articles&page=detailArticle&id=<?= $art['id'] ?>" class="w-full bg-[#ff00cc] text-white py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-1 hover:bg-opacity-90 transition-all duration-300 shadow-sm active:scale-95">
                                Lire l'article <span class="text-xs group-hover:translate-x-1 transition-transform">➔</span>
                            </a>
                            <?php else :?>
                            <a href="?controller=auth&page=login&redirect_article_id=<?= $art['id'] ?>" class="w-full bg-[#ff00cc] text-white py-2.5 rounded-xl text-xs font-bold flex items-center justify-center gap-1 hover:bg-opacity-90 transition-all duration-300 shadow-sm active:scale-95">
                                Lire l'article <span class="text-xs group-hover:translate-x-1 transition-transform">➔</span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php $delay += 100; endforeach; ?>
        <?php else: ?>
            <p class="text-gray-400 italic text-sm col-span-4 text-center py-8" data-aos="fade-up">Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</section>

    <section class="max-w-7xl mx-auto px-6 py-12 text-center relative">
        <h2 class="text-3xl font-extrabold mb-6" data-aos="fade-up" data-aos-duration="800">Explorez par catégorie</h2>
        
        <div class="flex flex-wrap justify-center gap-3 mb-10" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
            <button class="border border-[#ff00cc] text-white bg-[#ff00cc] px-5 py-1.5 rounded-full text-xs font-semibold shadow-sm hover:shadow-md transition-all duration-300">Frontend</button>
            <button class="border border-gray-200 text-gray-500 bg-white px-5 py-1.5 rounded-full text-xs font-semibold hover:border-[#ff00cc] hover:text-[#ff00cc] transition-all duration-300">Data Science</button>
            <button class="border border-gray-200 text-gray-500 bg-white px-5 py-1.5 rounded-full text-xs font-semibold hover:border-[#ff00cc] hover:text-[#ff00cc] transition-all duration-300">Design</button>
            <button class="border border-gray-200 text-gray-500 bg-white px-5 py-1.5 rounded-full text-xs font-semibold hover:border-[#ff00cc] hover:text-[#ff00cc] transition-all duration-300">Marketing</button>
        </div>

        <div class="max-w-4xl mx-auto relative px-4">
            <div class="hidden lg:block absolute -left-36 top-1/4 w-24 opacity-80 animate-float">
                <img src="<?= WEBROOT ?>images/Woman getting thumbs up and likes on social media.png" alt="Illustration 1" class="w-full">
            </div>
            <div class="hidden lg:block absolute -right-36 top-10 w-24 opacity-80 animate-float-delayed">
                <img src="<?= WEBROOT ?>images/Person typing essay on laptop, Digital writing or blogging@2x.png" alt="Illustration 2" class="w-full">
            </div>

            <div class="space-y-6 text-left">
                <div class="bg-white rounded-2xl p-4 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-lg transition-all duration-300 items-center border border-gray-50 group" data-aos="fade-right" data-aos-duration="800">
                    <div class="w-full md:w-56 h-36 shrink-0 overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&w=300" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-extrabold text-base text-gray-900 mb-2 group-hover:text-[#ff00cc] transition-colors duration-300">L'architecture micro-frontend : mythe ou réalité pour les grandes...</h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">Une analyse approfondie des défis liés à l'architecture moderne et comment l'intégrer dans vos environnements de production.</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <img src="https://i.pravatar.cc/100?img=11" class="w-5 h-5 rounded-full">
                            <span class="font-medium">Mamadou Diop</span>
                            <span class="text-gray-400 text-[10px]">• 12 min</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-4 flex flex-col md:flex-row gap-6 shadow-sm hover:shadow-lg transition-all duration-300 items-center border border-gray-50 group" data-aos="fade-right" data-aos-duration="800" data-aos-delay="150">
                    <div class="w-full md:w-56 h-36 shrink-0 overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=300" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-extrabold text-base text-gray-900 mb-2 group-hover:text-[#ff00cc] transition-colors duration-300">L'architecture micro-frontend : mythe ou réalité pour les grandes...</h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2">Une analyse approfondie des défis liés à l'architecture moderne et comment l'intégrer dans vos environnements de production.</p>
                        <div class="flex items-center gap-2 text-xs text-gray-600">
                            <img src="https://i.pravatar.cc/100?img=14" class="w-5 h-5 rounded-full">
                            <span class="font-medium">Alioune Badara</span>
                            <span class="text-gray-400 text-[10px]">• 10 min</span>
                        </div>
                    </div>
                </div>
            </div>

            <button class="mt-8 text-xs font-bold text-[#ff00cc] bg-white border border-gray-200 px-6 py-2.5 rounded-xl inline-flex items-center gap-2 hover:border-[#ff00cc] hover:shadow-sm transition-all duration-300 active:scale-95" data-aos="fade-up" data-aos-duration="600">
                Voir plus <span class="text-[10px]">❯</span>
            </button>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 py-10 text-center relative" data-aos="zoom-in" data-aos-duration="800">
        <div class="hidden lg:block absolute -left-20 bottom-0 w-24 opacity-70 animate-float"><img src="<?= WEBROOT ?>images/design composition monitor(1).png" alt="Illustration 3"></div>
        <div class="hidden lg:block absolute -right-20 bottom-0 w-24 opacity-70 animate-float-delayed"><img src="<?= WEBROOT ?>images/website designer with tablet and working process on desktop.png" alt="Illustration 4"></div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-50">
            <h2 class="text-2xl md:text-3xl font-extrabold mb-4 text-gray-900">Prêt à rejoindre notre communauté ?</h2>
            <p class="text-xs text-gray-500 max-w-lg mx-auto mb-6 leading-relaxed">
                Que vous vouliez partager vos connaissances ou simplement rester connecté avec l'univers tech, vous êtes au bon endroit.
            </p>
            <div class="flex justify-center gap-4">
                <button class="border border-[#ff00cc] text-[#ff00cc] px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-pink-50 transition-all duration-300 active:scale-95">Écrire</button>
                <button class="bg-[#ff00cc] text-white px-6 py-2.5 rounded-xl text-xs font-bold hover:bg-opacity-90 shadow-sm transition-all duration-300 active:scale-95">S'abonner</button>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 px-6 mt-16 border-t border-gray-100" data-aos="fade-up" data-aos-duration="800">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-xl font-black tracking-wider mb-6 text-gray-900">INSCRIVEZ-VOUS À NOTRE NEWSLETTER</h2>
            <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                <input type="email" placeholder="Votre adresse email" class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#ff00cc] bg-gray-50 transition-all duration-300 focus:bg-white">
                <button class="bg-[#ff00cc] text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-opacity-90 transition-all duration-300 active:scale-95 shadow-sm">Envoyer</button>
            </div>
        </div>
    </section>

    <footer class="bg-pink-100 py-12 px-6 md:px-20 border-t border-pink-200">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <div class="text-xl font-bold flex items-center mb-4">
                    <span class="bg-black text-white px-2 py-0.5 rounded text-base mr-2">B</span> LOG221
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">A digital product agency building amazing UI/UX design and management for tomorrow's big companies.</p>
            </div>
            <div>
                <h4 class="font-extrabold text-sm mb-4 text-gray-950">Legal</h4>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">Terms & conditions</a></li>
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-extrabold text-sm mb-4 text-gray-950">Horaire</h4>
                <p class="text-xs text-gray-600 leading-relaxed">Du lundi au vendredi<br><span class="font-semibold">09H00 - 18H00</span></p>
            </div>
            <div>
                <h4 class="font-extrabold text-sm mb-4 text-gray-950">Company</h4>
                <ul class="space-y-2 text-xs text-gray-600">
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">home</a></li>
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">service</a></li>
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">à propos</a></li>
                    <li><a href="#" class="hover:text-[#ff00cc] transition-colors">Contactez-nous</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, 
            offset: 120 
        });
    </script>
</body>
</html>