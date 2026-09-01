<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="author" content="El_Mavic BAKALA">
    <meta name="author" content="Célina LUEMBA">
    <meta name="author" content="Gloire NGUIMBI">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/logo1.png" type="image/png">
    <title>Impacts</title>
</head>

<body>
    <main class="overflow-hidden">
        <section class="h-screen flex justify-center items-center sct1">
            <?php include 'css/header.php'; ?>
            <div
                class="h-screen backdrop-blur-md w-screen flex flex-col justify-center items-center gap-8 border-none rounded-[60px]">
                <div class="triangle flex flex-col justify-center items-center gap-4 text-white border-4 rounded-2xl p-16
                    bg-[radial-gradient(circle_at_top_left,#22c55e,#6d4a00,#2563eb)]">
                    <span class="text-green-500 text-5xl font-bold">Nôtre impact</span>

                    <h1 class="text-3xl font-bold text-center">
                        Protéger <br>
                        et transformer des <a href="Formations.html">vies</a>
                    </h1>

                    <p class="text-center w-4xl text-lg">
                        Ensemble nous batissaons un avenir durable. Découvrez comment
                        nos actions concretes sur le terrain redonne espoire et crént
                        des opportunités durables pour les communautés vulnérables.
                    </p>

                    <div class="flex gap-3 mt-8">
                        <a href="#soutiens"
                            class="hover:bg-green-700 transition-colors w-60 h-2xl text-lg text-center border-2 border-green-700 rounded-2xl p-2">soutenir
                            nos
                            actions</a>
                        <a href="#programme"
                            class="hover:bg-green-700 transition-colors w-60 h-2xl text-lg text-center border-2 border-green-700 rounded-2xl p-2">Découvrir
                            nos
                            programmes</a>
                    </div>
                </div>

                <div class="rounded-full size-32 flex flex-col justify-center items-center gap-4 text-center">
                    <img src="assets/logo1.png" rounded-full dorber alt="Logo GVAS" class="w-full h-auto">
                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : STATISTIQUE A SUIVRE -->
        <!-- ========================================================= -->

        <!-- <section class="sct_bar flex flex-col justify-center items-center w-full gap-4 my-8 p-4">
            <h1 class="text-5xl font-bold text-white">Nos Statistiques</h1>
        </section>

        <section class="my-8 sct2 bon">
            <div class="flex justify-evenly items-center gap-4">
                <div
                    class="sct2_touche3 shadow-[2px_2px_10px_green] bg-white border-2 hover:border-white border-blue-500 rounded-2xl size-64 p-1 flex flex-col justify-center items-center gap-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>

                    <span class="font-bold text-blue-500 text-2xl">+ 1200</span>
                    <p class="font-bold">Fammilles accompagnées <br> vers l'autonomie</p>
                </div>

                <div
                    class="sct2_touche1 shadow-[2px_2px_10px_green] bg-white hover:border-white border-2 border-green-500 rounded-2xl size-64 p-1 flex flex-col justify-center items-center gap-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                    </svg>

                    <span class="font-bold text-green-500 text-2xl">500+</span>
                    <p class="font-bold">Jeunes formés aux <br> de demain</p>
                </div>

                <div
                    class="sct2_touche3 shadow-[2px_2px_10px_green] bg-white border-2 hover:border-white border-blue-500 rounded-2xl size-64 p-1 flex flex-col justify-center items-center gap-4 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-16 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m20.893 13.393-1.135-1.135a2.252 2.252 0 0 1-.421-.585l-1.08-2.16a.414.414 0 0 0-.663-.107.827.827 0 0 1-.812.21l-1.273-.363a.89.89 0 0 0-.738 1.595l.587.39c.59.395.674 1.23.172 1.732l-.2.2c-.212.212-.33.498-.33.796v.41c0 .409-.11.809-.32 1.158l-1.315 2.191a2.11 2.11 0 0 1-1.81 1.025 1.055 1.055 0 0 1-1.055-1.055v-1.172c0-.92-.56-1.747-1.414-2.089l-.655-.261a2.25 2.25 0 0 1-1.383-2.46l.007-.042a2.25 2.25 0 0 1 .29-.787l.09-.15a2.25 2.25 0 0 1 2.37-1.048l1.178.236a1.125 1.125 0 0 0 1.302-.795l.208-.73a1.125 1.125 0 0 0-.578-1.315l-.665-.332-.091.091a2.25 2.25 0 0 1-1.591.659h-.18c-.249 0-.487.1-.662.274a.931.931 0 0 1-1.458-1.137l1.411-2.353a2.25 2.25 0 0 0 .286-.76m11.928 9.869A9 9 0 0 0 8.965 3.525m11.928 9.868A9 9 0 1 1 8.965 3.525" />
                    </svg>

                    <span class="font-bold text-blue-500 text-2xl">4</span>
                    <p class="font-bold">Régions couvertes par <br> nos actions sociales</p>
                </div>
            </div>
        </section>
 -->

        <!-- ========================================================= -->
        <!-- MODAL : PUBLIQUE CIBLE -->
        <!-- ========================================================= -->

        <section class="sct_bar flex flex-col justify-center items-center w-full gap-4 my-8 p-4">
            <h1 class="text-5xl font-bold text-black">Notre Public Cible</h1>
            <p>
                Nous nous engageons à toucher un large éventail de bénéficiaires, en mettant l'accent sur les jeunes,
                les adultes et les communautés locales. <br>
                Notre impact se mesure à travers l'autonomisation des individus, la préparation aux métiers techniques
                et la réintégration sociale réussie.
            </p>
        </section>

        <section class="flex justify-center items-center mT-8 mb-16">
            <div class="flex flex-wrap text-wrap justify-center items-center gap-6 max-w-6xl w-full">
                <!-- CAROUSEL -->
                <div class="relative w-full max-w-xl h-[400px] overflow-hidden rounded-2xl shadow-lg">
                    <!-- Images -->
                    <div id="carousel" class="flex h-full transition-transform duration-700 ease-in-out">
                        <img src="Assets/image6.jpg" alt="Formation GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image2.jpg" alt="Activité GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image4.jpg" alt="Action sociale GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image5.jpg" alt="Activité GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image7.jpg" alt="Activité GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image3.jpg" alt="Accompagnement GVAS"
                            class="w-full h-full object-cover flex-shrink-0">

                        <img src="Assets/image4.jpg" alt="Action sociale GVAS"
                            class="w-full h-full object-cover flex-shrink-0">
                    </div>

                    <!-- Bouton précédent -->
                    <button onclick="previousSlide()"
                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-10 h-10 flex items-center justify-center">
                        ❮
                    </button>

                    <!-- Bouton suivant -->
                    <button onclick="nextSlide()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full w-10 h-10 flex items-center justify-center">
                        ❯
                    </button>

                    <!-- Indicateurs -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">

                        <button onclick="goToSlide(0)" class="indicator w-3 h-3 rounded-full bg-white">
                        </button>

                        <button onclick="goToSlide(1)" class="indicator w-3 h-3 rounded-full bg-white/50">
                        </button>

                        <button onclick="goToSlide(2)" class="indicator w-3 h-3 rounded-full bg-white/50">
                        </button>

                        <button onclick="goToSlide(3)" class="indicator w-3 h-3 rounded-full bg-white/50">
                        </button>
                    </div>
                </div>


                <!-- TEXTE -->
                <div class="flex-1">

                    <h2 class="text-2xl font-bold text-green-700 mt-4">
                        Pour qui ?
                    </h2>

                    <p class="text-justify text-lg font-bold">
                        Nos programmes de formation sont conçus pour répondre
                        aux besoins d'une variété de publics, notamment :
                    <ul class="list-disc ml-6">
                        <li>
                            Les jeunes en quête d'opportunités éducatives et professionnelles.
                        </li>
                        <li>
                            Les adultes souhaitant améliorer leurs compétences et leur employabilité.
                        </li>
                        <li>
                            Les communautés locales cherchant à renforcer leur capital humain.
                        </li>
                    </ul>
                    </p>

                    <h3 class="text-2xl font-bold text-blue-700 mt-8">
                        Notre Impact
                    </h3>

                    <p class="text-justify text-lg font-bold">
                        Grâce à nos initiatives, nous avons pu créer des opportunités
                        durables pour les communautés vulnérables.
                    </p>

                    <ul class="list-disc ml-6">
                        <li>Autonomie au quotidien</li>
                        <li>Préparation aux métiers de Techniques</li>
                        <li>Réintégration sociale réussie</li>
                    </ul>

                </div>

            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : BAR SOUTIENS -->
        <!-- ========================================================= -->

        <section id="soutiens"
            class="flex justify-center p-8 h-64 items-center mt-4 mb-16 bg-linear-to-l  from-white to-blue-900">
            <div class="text-center flex flex-col justify-center items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                <h1 class="text-2xl font-bold">Rejoignez-Nous pour construire un avenir durable</h1>
                <p class="text-center w-2xl text-lg">
                    votre soutient qu'il soit financier ou pas, le bénévolat, permet à GVAS <br>
                    Action-Sociale de continuer à transformer des vies sur le terrain
                </p>

                <a href="#footer"
                    class="text-lg hover:bg-[rgb(0,55,255)] bg-green-700 text-white transition-colors font-bold w-60 h-2xl text-center rounded-2xl p-2">Nous
                    soutenir</a>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : AVANT PROPOS -->
        <!-- ========================================================= -->

        <section class="sct_bar flex flex-col justify-center items-center w-full gap-4 mt-16 p-4">
            <h1 class="text-5xl font-bold">Nos Piliers d'Action</h1>
            <p class="text-lg text-center">
                Découvrez les piliers sur lesquels s'appuie notre action sociale pour créer un impact durable dans les
                communautés.
            </p>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : EDUQUER -->
        <!-- ========================================================= -->

        <section class="mb-8" id="Découvrir">
            <div>
                <div class="rounded-3xl bg-white shadow-2xl">
                    <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 md:p-10">
                        <div class="flex flex-col justify-center">
                            <div class="flex items-center gap-5">
                                <div class="flex h-20 w-20 items-center justify-center
                               rounded-full bg-green-600
                               shadow-lg shadow-green-600/30">
                                    <!-- Icône livre -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832
                                5.477 9.246 5 7.5 5S4.168
                                5.477 3 6.253v13C4.168
                                18.477 5.754 18 7.5
                                18s3.332.477 4.5 1.253m0-13
                                C13.168 5.477 14.754 5
                                16.5 5S19.832 5.477 21
                                6.253v13C19.832 18.477
                                18.246 18 16.5 18s-3.332
                                .477-4.5 1.253" />
                                    </svg>
                                </div>

                                <div>
                                    <h1 class="text-4xl font-bold tracking-tight
                                   text-green-700">
                                        ÉDUQUER
                                    </h1>

                                    <p class="mt-1 text-lg font-medium text-gray-700">
                                        Donner les clés du savoir,
                                        pour bâtir un avenir meilleur.
                                    </p>
                                </div>
                            </div>
                            <div class="my-6 h-1 w-14 rounded-full bg-green-600"></div>

                            <p class="text-base leading-7 text-gray-600">
                                Nous croyons que l'éducation est le fondement
                                d'une société éclairée et autonome. C'est pourquoi
                                nous œuvrons pour rendre l'éducation accessible
                                à tous, sans distinction.
                            </p>
                        </div>

                        <div class="relative overflow-hidden rounded-2xl">
                            <img src="Assets/éduquer.jpg" alt="Éducation"
                                class="h-full min-h-[250px] w-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t
                           from-green-950/50 to-transparent"></div>
                        </div>
                    </div>

                    <!-- ========================= -->
                    <!-- CONTENU -->
                    <!-- ========================= -->

                    <div class="grid grid-cols-1 gap-10 px-6 pb-8 md:grid-cols-2 md:px-10">
                        <section>
                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-green-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                        <circle cx="12" cy="12" r="9" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-bold text-green-800">
                                        Nos objectifs
                                    </h2>

                                    <div class="mt-1 h-1 w-8 rounded bg-green-500"></div>
                                </div>

                            </div>


                            <!-- Objectif 1 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Rendre l'éducation de qualité accessible
                                    aux enfants et aux jeunes.
                                </p>
                            </div>


                            <!-- Objectif 2 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Favoriser le développement de compétences
                                    utiles pour la vie et l'emploi.
                                </p>
                            </div>


                            <!-- Objectif 3 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Promouvoir l'esprit critique, la créativité
                                    et l'ouverture d'esprit.
                                </p>
                            </div>


                            <!-- Objectif 4 -->
                            <div class="flex gap-4 py-4">

                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Lutter contre l'abandon scolaire
                                    et l'analphabétisme.
                                </p>

                            </div>

                        </section>


                        <!-- ========================= -->
                        <!-- ACTIONS -->
                        <!-- ========================= -->

                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-green-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-bold text-green-800">
                                        Nos actions clés
                                    </h2>

                                    <div class="mt-1 h-1 w-8 rounded bg-green-500"></div>
                                </div>

                            </div>


                            <!-- Action 1 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-green-800">
                                        Soutien scolaire et fournitures
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous apportons un soutien matériel et
                                        pédagogique aux élèves en difficulté.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 2 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-green-800">
                                        Ateliers et formations éducatives
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous organisons des ateliers pour renforcer
                                        les compétences des jeunes et des enseignants.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 3 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-green-800">
                                        Bibliothèques et espaces d'apprentissage
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous créons des espaces sûrs et inspirants
                                        pour apprendre et se développer.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 4 -->
                            <div class="flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-green-800">
                                        Bourses et parrainages
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous accompagnons les élèves méritants
                                        pour leur permettre de poursuivre leurs études.
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : FORMER -->
        <!-- ========================================================= -->

        <section class="mb-8" id="Former">
            <div>
                <div class="rounded-3xl bg-white shadow-2xl">
                    <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 md:p-10">
                        <div class="flex flex-col justify-center">
                            <div class="flex items-center gap-5">

                                <div class="flex h-20 w-20 items-center justify-center
                               rounded-full bg-blue-600
                               shadow-lg shadow-blue-600/30">
                                    <!-- Icône livre -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832
                                5.477 9.246 5 7.5 5S4.168
                                5.477 3 6.253v13C4.168
                                18.477 5.754 18 7.5
                                18s3.332.477 4.5 1.253m0-13
                                C13.168 5.477 14.754 5
                                16.5 5S19.832 5.477 21
                                6.253v13C19.832 18.477
                                18.246 18 16.5 18s-3.332
                                .477-4.5 1.253" />
                                    </svg>
                                </div>

                                <div>
                                    <h1 class="text-4xl font-bold tracking-tight
                                   text-blue-700">
                                        FORMER
                                    </h1>

                                    <p class="mt-1 text-lg font-medium text-gray-700">
                                        Renforcer les compétence des jeunes et des adultes pour un avenir prometteur.
                                    </p>
                                </div>
                            </div>
                            <div class="my-6 h-1 w-14 rounded-full bg-blue-600"></div>

                            <p class="text-base leading-7 text-gray-600">
                                Nous croyons que la formation est un levier essentiel
                                pour l'autonomisation et l'insertion professionnelle.
                                C'est pourquoi nous proposons des programmes de formation
                                adaptés aux besoins du marché du travail et aux aspirations
                                des individus.
                            </p>
                        </div>



                        <div class="relative overflow-hidden rounded-2xl">

                            <img src="Assets/former.jpg" alt="Formation"
                                class="h-full min-h-[250px] w-full object-cover">


                            <div class="absolute inset-0 bg-gradient-to-t
                           from-blue-950/50 to-transparent"></div>

                        </div>

                    </div>

                    <!-- ========================= -->
                    <!-- CONTENU -->
                    <!-- ========================= -->

                    <div class="grid grid-cols-1 gap-10 px-6 pb-8 md:grid-cols-2 md:px-10">
                        <section>
                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                        <circle cx="12" cy="12" r="9" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-bold text-blue-800">
                                        Nos objectifs
                                    </h2>

                                    <div class="mt-1 h-1 w-8 rounded bg-blue-500"></div>
                                </div>

                            </div>


                            <!-- Objectif 1 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Rendre la formation de qualité accessible
                                    aux jeunes et aux adultes.
                                </p>
                            </div>


                            <!-- Objectif 2 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Favoriser le développement de compétences
                                    utiles pour la vie et l'emploi.
                                </p>
                            </div>


                            <!-- Objectif 3 -->
                            <div class="flex gap-4 border-b border-gray-100
                           py-4">
                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Promouvoir l'esprit critique, la créativité
                                    et l'ouverture d'esprit.
                                </p>
                            </div>


                            <!-- Objectif 4 -->
                            <div class="flex gap-4 py-4">

                                <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                    ✓
                                </span>

                                <p class="text-sm leading-6 text-gray-600">
                                    Lutter contre l'abandon scolaire
                                    et l'analphabétisme.
                                </p>

                            </div>

                        </section>


                        <!-- ========================= -->
                        <!-- ACTIONS -->
                        <!-- ========================= -->

                        <section>

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-blue-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-bold text-blue-800">
                                        Nos actions clés
                                    </h2>

                                    <div class="mt-1 h-1 w-8 rounded bg-blue-500"></div>
                                </div>

                            </div>


                            <!-- Action 1 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-blue-800">
                                        Soutien scolaire et fournitures
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous apportons un soutien matériel et
                                        pédagogique aux élèves en difficulté.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 2 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-blue-800">
                                        Ateliers et formations éducatives
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous organisons des ateliers pour renforcer
                                        les compétences des jeunes et des enseignants.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 3 -->
                            <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-blue-800">
                                        Bibliothèques et espaces d'apprentissage
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous créons des espaces sûrs et inspirants
                                        pour apprendre et se développer.
                                    </p>
                                </div>

                            </div>


                            <!-- Action 4 -->
                            <div class="flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                                <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                    <!-- bon -->
                                </div>

                                <div>
                                    <h3 class="font-semibold text-blue-800">
                                        Bourses et parrainages
                                    </h3>

                                    <p class="mt-1 text-sm leading-5 text-gray-600">
                                        Nous accompagnons les élèves méritants
                                        pour leur permettre de poursuivre leurs études.
                                    </p>
                                </div>

                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : ACCOMPAGNER -->
        <!-- ========================================================= -->

        <section class="mb-8" id="Accompagner">
            <div class="rounded-3xl bg-white shadow-2xl">
                <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 md:p-10">
                    <div class="flex flex-col justify-center">
                        <div class="flex items-center gap-5">

                            <div class="flex h-20 w-20 items-center justify-center
                               rounded-full bg-green-600
                               shadow-lg shadow-green-600/30">
                                <!-- Icône livre -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832
                                5.477 9.246 5 7.5 5S4.168
                                5.477 3 6.253v13C4.168
                                18.477 5.754 18 7.5
                                18s3.332.477 4.5 1.253m0-13
                                C13.168 5.477 14.754 5
                                16.5 5S19.832 5.477 21
                                6.253v13C19.832 18.477
                                18.246 18 16.5 18s-3.332
                                .477-4.5 1.253" />
                                </svg>
                            </div>

                            <div>
                                <h1 class="text-4xl font-bold tracking-tight
                                   text-green-700">
                                    Accompagner
                                </h1>

                                <p class="mt-1 text-lg font-medium text-gray-700">
                                    Nous accompagnons les jeunes et les adultes dans leur parcours éducatif <br>
                                    et professionnel, en leur offrant des conseils, du mentorat et un soutien
                                    personnalisé.
                                </p>
                            </div>
                        </div>
                        <div class="my-6 h-1 w-14 rounded-full bg-green-600"></div>

                        <p class="text-base leading-7 text-gray-600">
                            Nous croyons que l'éducation est le fondement d'une société éclairée et autonome. C'est
                            pourquoi nous œuvrons pour rendre l'éducation accessible à tous, sans distinction.
                        </p>
                    </div>



                    <div class="relative overflow-hidden rounded-2xl">

                        <img src="Assets/accompagner.jpg" alt="Formation"
                            class="h-full min-h-[250px] w-full object-cover">


                        <div class="absolute inset-0 bg-gradient-to-t
                           from-blue-950/50 to-transparent"></div>

                    </div>

                </div>

                <!-- ========================= -->
                <!-- CONTENU -->
                <!-- ========================= -->

                <div class="grid grid-cols-1 gap-10 px-6 pb-8 md:grid-cols-2 md:px-10">
                    <section class="mb-8">
                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                    <circle cx="12" cy="12" r="9" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-green-800">
                                    Nos objectifs
                                </h2>

                                <div class="mt-1 h-1 w-8 rounded bg-green-500"></div>
                            </div>

                        </div>


                        <!-- Objectif 1 -->
                        <div class="flex gap-4 border-b border-green-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Rendre l'éducation de qualité accessible
                                aux enfants et aux jeunes.
                            </p>
                        </div>


                        <!-- Objectif 2 -->
                        <div class="flex gap-4 border-b border-gray-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Favoriser le développement de compétences
                                utiles pour la vie et l'emploi.
                            </p>
                        </div>


                        <!-- Objectif 3 -->
                        <div class="flex gap-4 border-b border-gray-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Promouvoir l'esprit critique, la créativité
                                et l'ouverture d'esprit.
                            </p>
                        </div>


                        <!-- Objectif 4 -->
                        <div class="flex gap-4 py-4">

                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-green-500
                               text-green-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Lutter contre l'abandon scolaire
                                et l'analphabétisme.
                            </p>

                        </div>

                    </section>


                    <!-- ========================= -->
                    <!-- ACTIONS -->
                    <!-- ========================= -->

                    <section>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-green-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-green-800">
                                    Nos actions clés
                                </h2>

                                <div class="mt-1 h-1 w-8 rounded bg-green-500"></div>
                            </div>

                        </div>


                        <!-- Action 1 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-green-800">
                                    Soutien scolaire et fournitures
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous apportons un soutien matériel et
                                    pédagogique aux élèves en difficulté.
                                </p>
                            </div>

                        </div>


                        <!-- Action 2 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-green-800">
                                    Ateliers et formations éducatives
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous organisons des ateliers pour renforcer
                                    les compétences des jeunes et des enseignants.
                                </p>
                            </div>

                        </div>


                        <!-- Action 3 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-green-800">
                                    Bibliothèques et espaces d'apprentissage
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous créons des espaces sûrs et inspirants
                                    pour apprendre et se développer.
                                </p>
                            </div>

                        </div>


                        <!-- Action 4 -->
                        <div class="flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-green-200
                           hover:bg-green-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-green-100
                               text-green-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-green-800">
                                    Bourses et parrainages
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous accompagnons les élèves méritants
                                    pour leur permettre de poursuivre leurs études.
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : PROTÉGER -->
        <!-- ========================================================= -->

        <section class="mb-16" id="Protéger">
            <div class="rounded-3xl bg-white shadow-2xl">
                <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2 md:p-10">
                    <div class="flex flex-col justify-center">
                        <div class="flex items-center gap-5">

                            <div class="flex h-20 w-20 items-center justify-center
                               rounded-full bg-blue-600
                               shadow-lg shadow-blue-600/30">
                                <!-- Icône livre -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832
                                5.477 9.246 5 7.5 5S4.168
                                5.477 3 6.253v13C4.168
                                18.477 5.754 18 7.5
                                18s3.332.477 4.5 1.253m0-13
                                C13.168 5.477 14.754 5
                                16.5 5S19.832 5.477 21
                                6.253v13C19.832 18.477
                                18.246 18 16.5 18s-3.332
                                .477-4.5 1.253" />
                                </svg>
                            </div>

                            <div>
                                <h1 class="text-4xl font-bold tracking-tight
                                   text-blue-700">
                                    PROTEGER
                                </h1>

                                <p class="mt-1 text-lg font-medium text-gray-700">
                                    Nous nous engageons à protéger les droits et le bien-être <br>
                                    des jeunes et des adultes, en veillant à ce qu'ils puissent <br>
                                    apprendre et se développer dans un environnement sûr et respectueux.
                                </p>
                            </div>
                        </div>
                        <div class="my-6 h-1 w-14 rounded-full bg-blue-600"></div>

                        <p class="text-base leading-7 text-gray-600">
                            Nous croyons que l'éducation est le fondement d'une société éclairée et autonome. C'est
                            pourquoi nous œuvrons pour rendre l'éducation accessible à tous, sans distinction.
                        </p>
                    </div>



                    <div class="relative overflow-hidden rounded-2xl">

                        <img src="Assets/protection.jpg" alt="Formation"
                            class="h-full min-h-[250px] w-full object-cover">


                        <div class="absolute inset-0 bg-gradient-to-t
                           from-blue-950/50 to-transparent"></div>

                    </div>

                </div>

                <!-- ========================= -->
                <!-- CONTENU -->
                <!-- ========================= -->

                <div class="grid grid-cols-1 gap-10 px-6 pb-8 md:grid-cols-2 md:px-10">
                    <section>
                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                    <circle cx="12" cy="12" r="9" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-blue-800">
                                    Nos objectifs
                                </h2>

                                <div class="mt-1 h-1 w-8 rounded bg-blue-500"></div>
                            </div>

                        </div>


                        <!-- Objectif 1 -->
                        <div class="flex gap-4 border-b border-gray-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Rendre l'éducation de qualité accessible
                                aux enfants et aux jeunes.
                            </p>
                        </div>


                        <!-- Objectif 2 -->
                        <div class="flex gap-4 border-b border-gray-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Favoriser le développement de compétences
                                utiles pour la vie et l'emploi.
                            </p>
                        </div>


                        <!-- Objectif 3 -->
                        <div class="flex gap-4 border-b border-gray-100
                           py-4">
                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Promouvoir l'esprit critique, la créativité
                                et l'ouverture d'esprit.
                            </p>
                        </div>


                        <!-- Objectif 4 -->
                        <div class="flex gap-4 py-4">

                            <span class="flex h-6 w-6 shrink-0 items-center
                               justify-center rounded-full
                               border-2 border-blue-500
                               text-blue-500">
                                ✓
                            </span>

                            <p class="text-sm leading-6 text-gray-600">
                                Lutter contre l'abandon scolaire
                                et l'analphabétisme.
                            </p>

                        </div>

                    </section>


                    <!-- ========================= -->
                    <!-- ACTIONS -->
                    <!-- ========================= -->

                    <section>

                        <div class="mb-5 flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center
                               rounded-full bg-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-blue-800">
                                    Nos actions clés
                                </h2>

                                <div class="mt-1 h-1 w-8 rounded bg-blue-500"></div>
                            </div>

                        </div>


                        <!-- Action 1 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-blue-800">
                                    Soutien scolaire et fournitures
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous apportons un soutien matériel et
                                    pédagogique aux élèves en difficulté.
                                </p>
                            </div>

                        </div>


                        <!-- Action 2 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-blue-800">
                                    Ateliers et formations éducatives
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous organisons des ateliers pour renforcer
                                    les compétences des jeunes et des enseignants.
                                </p>
                            </div>

                        </div>


                        <!-- Action 3 -->
                        <div class="mb-3 flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-blue-800">
                                    Bibliothèques et espaces d'apprentissage
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous créons des espaces sûrs et inspirants
                                    pour apprendre et se développer.
                                </p>
                            </div>

                        </div>


                        <!-- Action 4 -->
                        <div class="flex gap-4 rounded-xl border
                           border-gray-100 bg-gray-50 p-4
                           transition hover:border-blue-200
                           hover:bg-blue-50">

                            <div class="flex h-11 w-11 shrink-0 items-center
                               justify-center rounded-lg bg-blue-100
                               text-blue-600">
                                <!-- bon -->
                            </div>

                            <div>
                                <h3 class="font-semibold text-blue-800">
                                    Bourses et parrainages
                                </h3>

                                <p class="mt-1 text-sm leading-5 text-gray-600">
                                    Nous accompagnons les élèves méritants
                                    pour leur permettre de poursuivre leurs études.
                                </p>
                            </div>

                        </div>

                    </section>

                </div>

            </div>
            </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- MODAL : PROGRAMME -->
        <!-- ========================================================= -->

        <section id="programme" class="sct_formation mb-8 flex flex-col justify-center items-center mb-16">
            <div class="text-center flex flex-col gap-4 mb-2xl">
                <h1 class="text-5xl font-bold">Les piliers du programme</h1>
                <p class="text-wrap text-lg text-center">
                    Notre programme de formation repose sur trois piliers fondamentaux qui garantissent une approche
                    complète et efficace :
                </p>
            </div>

            <div class="une_formation flex flex-col justify-evenly items-center gap-16 my-4 p-8">
                <div class="la_formation flex items-center shadow-[2px_2px_10px_blue] rounded-2xl p-8">
                    <div class="flex justify-between items-center gap-16 p-8 border-b-4 rounded-4xl border-blue-800">
                        <div class="bg-blue-800 size-16 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-bold">Renforcement des compétences</span>
                            <p class="text-lg">
                                Acquisition et consolidation des savoirs de base <br>
                                essentiels à la vie quotidienne et citoyenne.
                            </p>
                        </div>
                    </div>

                    <div class="border-2 border-blue-700 border-bleu-700 w-[120px]"></div>


                    <div class="border border-blue-700 rounded-2xl size-64">
                        <img src="Assets/comp.png" alt="Formation GVAS"
                            class="w-full h-full object-cover flex-shrink-0 rounded-2xl">
                    </div>
                </div>

                <div class="la_formation shadow-[2px_2px_10px_blue] flex items-center p-8 rounded-2xl">
                    <div class="border border-blue-500 rounded-2xl size-64">
                        <img src="Assets/alpha.jpeg" alt="Formation GVAS"
                            class="w-full h-full object-cover flex-shrink-0 rounded-2xl">
                    </div>

                    <div class="border-2 border-blue-500 w-[120px]"></div>

                    <div class="flex justify-between items-center gap-16 p-8 border-b-4 rounded-4xl border-blue-500">
                        <div>
                            <span class="text-2xl font-bold">Alphabetisation et Préparation</span>
                            <p class="text-lg">
                                Parcours d'alphabétisation structuré servant <br>
                                de tranplin vesr les apprentissages <br> techniques et professionnels.
                            </p>
                        </div>
                        <div class="bg-blue-500 size-16 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="la_formation shadow-[2px_2px_10px_green] flex items-center p-10 rounded-2xl">
                    <div class="flex justify-between items-center gap-16 p-8 border-b-4 rounded-4xl border-green-500">
                        <div class="bg-green-500 size-16 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-2xl font-bold">Dévéloppement Professionnel</span>
                            <p class="text-lg">
                                Formation pratique et théorique pour <br>
                                préparer les individus à des carrières <br>
                                épanouissantes et durables.
                            </p>
                        </div>
                    </div>

                    <div class="border-2 border-green-500 w-[120px] h-[1px]"></div>

                    <div class="border border-green-500 rounded-2xl size-64 kola">
                        <img src="Assets/dev.jpg" alt="Formation GVAS"
                            class="w-full h-full object-cover flex-shrink-0 rounded-2xl">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'css/footer.php'; ?>

    <script>
        let currentSlide = 0;
        const carousel = document.getElementById("carousel");
        const slides = carousel.children;
        const indicators = document.querySelectorAll(".indicator");
        function updateCarousel() {
            carousel.style.transform =
                `translateX(-${currentSlide * 100}%)`;

            indicators.forEach((indicator, index) => {

                if (index === currentSlide) {
                    indicator.classList.remove("bg-white/50");
                    indicator.classList.add("bg-white");
                } else {
                    indicator.classList.remove("bg-white");
                    indicator.classList.add("bg-white/50");
                }

            });
        }

        function nextSlide() {

            currentSlide++;

            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }

            updateCarousel();
        }

        function previousSlide() {

            currentSlide--;

            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }

            updateCarousel();
        }

        function goToSlide(index) {

            currentSlide = index;

            updateCarousel();
        }

        // Défilement automatique toutes les 4 secondes
        setInterval(nextSlide, 4000);

    </script>
</body>

</html>