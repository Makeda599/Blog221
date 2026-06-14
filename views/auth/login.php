<!-- Ajoute ces liens dans ton <head> si ce n'est pas déjà fait sur ce fichier -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<div class="min-h-screen bg-[#EBE5EB] flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-x-hidden">
    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
        
        <!-- Côté Gauche : Texte et Illustration -->
        <div class="md:col-span-7 flex flex-col justify-center space-y-6 text-gray-900" 
             data-aos="fade-right" 
             data-aos-duration="1000">
            
            <div class="flex items-center gap-2 text-2xl font-bold tracking-tight hover:scale-105 transition-transform duration-300 cursor-default">
                <span class="bg-black text-white px-2 py-1 rounded text-lg font-mono shadow-lg">B</span>
                <span>LOG221</span>
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-950 uppercase leading-tight">
                    Rejoignez la <span class="text-[#E562D1]">communauté</span>
                </h1>
                <p class="text-gray-600 max-w-md leading-relaxed text-sm sm:text-base">
                    Découvrez, lisez et partagez des articles passionnants sur le développement web, le design et plus encore.
                </p>
            </div>

            <!-- Illustration avec animation de flottement -->
            <div class="pt-4 flex justify-center md:justify-start">
                <style>
                    @keyframes float-login {
                        0%, 100% { transform: translateY(0) rotate(0deg); }
                        50% { transform: translateY(-15px) rotate(1deg); }
                    }
                    .animate-float-login {
                        animation: float-login 5s ease-in-out infinite;
                    }
                </style>
                <img src="<?= WEBROOT ?>images/Woman_working_on_website_layout.png" 
                     alt="Illustration LOG221" 
                     class="w-full max-w-sm sm:max-w-md object-contain drop-shadow-2xl animate-float-login">
            </div>
        </div>

        <!-- Côté Droit : Formulaire -->
        <div class="md:col-span-5 bg-white rounded-3xl shadow-2xl border border-gray-100 p-6 sm:p-8 transform transition-all duration-500 hover:shadow-pink-100/50"
             data-aos="zoom-in-up" 
             data-aos-duration="800">
            
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">Bon retour !</h2>
                <p class="text-xs text-gray-400 mt-1">Entrez vos identifiants pour continuer</p>
            </div>

            <form method="POST" action="<?=path("auth","login")?>" class="space-y-4">
                
                <!-- Input Email -->
                <div class="group">
                    <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                        <span class="text-red-500 text-[10px] absolute -top-5 left-0 font-bold uppercase tracking-tighter"><?= $errors["email"] ?? "" ?></span>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#E562D1] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <input type="email" name="email" id="email" value="<?=$save["email"] ?? ""?>" placeholder="adresse email" 
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/20 focus:border-[#E562D1] focus:bg-white transition-all placeholder:text-gray-400">
                    </div>
                </div>

                <!-- Input Password -->
                <div class="group">
                    <div class="relative transition-all duration-300 transform group-focus-within:-translate-y-1">
                        <span class="text-red-500 text-[10px] absolute -top-5 left-0 font-bold uppercase tracking-tighter"><?= $errors["mot_de_passe"] ?? "" ?></span>
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#E562D1] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                        </span>
                        <input type="password" name="mot_de_passe" id="mot_de_passe" value="<?= $save["mot_de_passe"] ?? "" ?>" placeholder="mot de passe"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-11 pr-12 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/20 focus:border-[#E562D1] focus:bg-white transition-all placeholder:text-gray-400">
                        <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-[#E562D1] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="text-right mt-1.5">
                        <a href="#" class="text-[11px] text-[#E562D1] hover:text-[#cb51b7] transition-colors font-bold uppercase tracking-tighter">Mot de passe oublié ?</a>
                    </div>
                </div>

                <!-- Bouton Connexion -->
                <button type="submit" name="envoie"
                    class="w-full bg-[#E562D1] text-white font-bold py-3.5 rounded-xl hover:bg-[#cb51b7] active:scale-[0.97] transition-all duration-300 shadow-lg shadow-pink-200/50 text-sm uppercase tracking-widest mt-2 overflow-hidden relative group">
                    <span class="relative z-10">Se connecter</span>
                    <div class="absolute inset-0 w-1/4 h-full bg-white/20 skew-x-[-20deg] -translate-x-full group-hover:translate-x-[400%] transition-transform duration-700 ease-in-out"></div>
                </button>
            </form>

            <div class="relative my-8 text-center">
                <hr class="border-gray-100">
                <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-[10px] font-bold text-gray-300 uppercase tracking-[0.2em]">
                    Ou
                </span>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-4">
                <a href="#" class="flex items-center justify-center gap-2 border border-gray-100 rounded-xl py-3 hover:bg-gray-50 hover:border-gray-200 transition-all duration-300 text-xs font-bold text-gray-700 shadow-sm active:scale-95">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-4 h-4">
                    <span>GOOGLE</span>
                </a>
                <a href="#" class="flex items-center justify-center gap-2 border border-gray-100 rounded-xl py-3 hover:bg-gray-50 hover:border-gray-200 transition-all duration-300 text-xs font-bold text-gray-700 shadow-sm active:scale-95">
                    <img src="https://www.svgrepo.com/show/512317/github-142.svg" alt="GitHub" class="w-4 h-4">
                    <span>GITHUB</span>
                </a>
            </div>

            <p class="text-center mt-8 text-xs text-gray-400 font-medium">
                Pas encore de compte ? 
                <a href="<?= path("auth","inscription") ?>" class="text-[#E562D1] font-bold hover:underline">Inscrivez-vous</a>
            </p>
        </div>

    </div>
</div>

<!-- Scripts d'animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        easing: 'ease-out-back'
    });
</script>