<div class="min-h-screen bg-[#EBE5EB] flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <div class="max-w-5xl w-full grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

        <div class="md:col-span-7 flex flex-col justify-center space-y-6 text-gray-900">
            <div class="flex items-center gap-2 text-2xl font-bold tracking-tight">
                <span class="bg-black text-white px-2 py-1 rounded text-lg font-mono">B</span>
                <span>LOG221</span>
            </div>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-gray-950 uppercase">
                    Rejoignez la communauté
                </h1>
                <p class="text-gray-600 max-w-md leading-relaxed text-sm sm:text-base">
                    Découvrez, lisez et partagez des articles passionnants sur le développement web, le design et plus encore.
                </p>
            </div>

            <div class="pt-4 flex justify-center md:justify-start">
                <img src="<?= WEBROOT ?>images/Woman_working_on_website_layout.png" alt="Illustration LOG221" class="w-full max-w-sm sm:max-w-md object-contain drop-shadow-sm">
            </div>
        </div>

        <div class="md:col-span-5 bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8">
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold text-gray-900 uppercase tracking-wide">Creez un compte</h2>
                <p class="text-xs text-gray-400 mt-1">Complétez votre profil pour commencer</p>
            </div>

     <form method="POST" action="<?= path("auth", "inscription") ?>" enctype="multipart/form-data" class="space-y-3">

    <div class="grid grid-cols-2 gap-3 mb-4">
        <?php $roleActuel = $save["role"] ?? "lecteur"; ?>
        <label class="role-label flex flex-col items-center justify-center border-2 rounded-xl py-2 cursor-pointer transition <?= $roleActuel === 'lecteur' ? 'border-[#E562D1] bg-pink-50/30' : 'border-gray-200 hover:bg-gray-50' ?>">
            <input type="radio" name="role" value="lecteur" class="hidden" <?= $roleActuel === 'lecteur' ? 'checked' : '' ?>>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mb-1 <?= $roleActuel === 'lecteur' ? 'text-[#E562D1]' : 'text-gray-400' ?>">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span class="text-[10px] font-bold uppercase <?= $roleActuel === 'lecteur' ? 'text-gray-900' : 'text-gray-500' ?>">Lecteur</span>
        </label>

        <label class="role-label flex flex-col items-center justify-center border-2 rounded-xl py-2 cursor-pointer transition <?= $roleActuel === 'auteur' ? 'border-[#E562D1] bg-pink-50/30' : 'border-gray-200 hover:bg-gray-50' ?>">
            <input type="radio" name="role" value="auteur" class="hidden" <?= $roleActuel === 'auteur' ? 'checked' : '' ?>>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mb-1 <?= $roleActuel === 'auteur' ? 'text-[#E562D1]' : 'text-gray-400' ?>">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            <span class="text-[10px] font-bold uppercase <?= $roleActuel === 'auteur' ? 'text-gray-900' : 'text-gray-500' ?>">Auteur</span>
        </label>
    </div>

    <div class="flex flex-col items-center justify-center pb-2">
        <?php if (isset($errors["photo"])): ?>
            <span class="text-red-500 text-xs mb-1 font-medium"><?= $errors["photo"] ?></span>
        <?php endif; ?>

        <label for="profile_photo" class="group relative cursor-pointer">
            <div class="w-20 h-20 rounded-full bg-gray-50 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden group-hover:border-[#E562D1] transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-300 group-hover:text-[#E562D1] transition">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
            </div>
            <div class="absolute bottom-0 right-0 bg-[#E562D1] p-1.5 rounded-full text-white shadow-sm border-2 border-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                    <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
            </div>
        </label>
        <input type="file" id="profile_photo" name="photo" class="hidden" accept="image/*">
        <p class="text-[10px] text-gray-400 mt-2 italic text-center">Format image (max 2 MB)</p>
    </div>

    <div class="space-y-3">
        <div>
            <?php if (isset($errors["nom"])): ?><span class="text-red-500 text-xs block mb-1 font-medium"><?= $errors["nom"] ?></span><?php endif; ?>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-regular fa-user text-sm"></i>
                </span>
                <input type="text" name="nom" placeholder="Nom" value="<?= htmlspecialchars($save["nom"] ?? "") ?>" class="w-full bg-white border border-gray-300 rounded-xl pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/50 focus:border-[#E562D1] transition">
            </div>
        </div>

        <div>
            <?php if (isset($errors["prenom"])): ?><span class="text-red-500 text-xs block mb-1 font-medium"><?= $errors["prenom"] ?></span><?php endif; ?>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-regular fa-user text-sm"></i>
                </span>
                <input type="text" name="prenom" placeholder="Prénom" value="<?= htmlspecialchars($save["prenom"] ?? "") ?>" class="w-full bg-white border border-gray-300 rounded-xl pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/50 focus:border-[#E562D1] transition">
            </div>
        </div>

        <div>
            <?php if (isset($errors["email"])): ?><span class="text-red-500 text-xs block mb-1 font-medium"><?= $errors["email"] ?></span><?php endif; ?>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </span>
                <input type="email" name="email" placeholder="Adresse email" value="<?= htmlspecialchars($save["email"] ?? "") ?>" class="w-full bg-white border border-gray-300 rounded-xl pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/50 focus:border-[#E562D1] transition">
            </div>
        </div>

        <div>
            <?php if (isset($errors["telephone"])): ?><span class="text-red-500 text-xs block mb-1 font-medium"><?= $errors["telephone"] ?></span><?php endif; ?>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-solid fa-phone text-sm"></i>
                </span>
                <input type="text" name="telephone" placeholder="Téléphone" value="<?= htmlspecialchars($save["telephone"] ?? "") ?>" class="w-full bg-white border border-gray-300 rounded-xl pl-11 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/50 focus:border-[#E562D1] transition">
            </div>
        </div>

        <div>
            <?php if (isset($errors["mot_de_passe"])): ?><span class="text-red-500 text-xs block mb-1 font-medium"><?= $errors["mot_de_passe"] ?></span><?php endif; ?>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-solid fa-lock text-sm"></i>
                </span>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" class="w-full bg-white border border-gray-300 rounded-xl pl-11 pr-12 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E562D1]/50 focus:border-[#E562D1] transition">
            </div>
        </div>
    </div>

    <button type="submit" name="envoie" class="w-full bg-[#E562D1] text-white font-bold py-3 rounded-xl hover:bg-[#cb51b7] transition shadow-md text-sm uppercase tracking-wider mt-4">
        S'inscrire
    </button>
</form>

            <div class="relative my-5 text-center">
                <hr class="border-gray-200">
                <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-3 text-[10px] font-semibold text-gray-400 uppercase tracking-wider">OU CONTINUER AVEC</span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="#" class="flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-2 hover:bg-gray-50 transition text-xs font-medium text-gray-700">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4"> Google
                </a>
                <a href="#" class="flex items-center justify-center gap-2 border border-gray-200 rounded-xl py-2 hover:bg-gray-50 transition text-xs font-medium text-gray-700">
                    <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-4 h-4"> Github
                </a>
            </div>
                <div class="relative my-5 text-center">
                <hr class="border-gray-200">
                <span class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-3 text-[10px] font-semibold text-gray-400 uppercase tracking-wider"><a href="<?=path("auth","login")?>">Connectez-vous</a></span>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.role-label').forEach(label => {
    label.addEventListener('click', function() {
        document.querySelectorAll('.role-label').forEach(l => {
            l.classList.remove('border-[#E562D1]', 'bg-pink-50/30');
            l.classList.add('border-gray-200');
            l.querySelector('svg').classList.replace('text-[#E562D1]', 'text-gray-400');
        });

        this.classList.remove('border-gray-200');
        this.classList.add('border-[#E562D1]', 'bg-pink-50/30');
        this.querySelector('svg').classList.replace('text-gray-400', 'text-[#E562D1]');
    });
});
</script>