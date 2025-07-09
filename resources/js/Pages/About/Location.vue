<script setup>
import {Head, Link} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
</script>

<template>
    <Head title="Les- en trainingslocatie"/>
    <PageHeading title="Les- en trainingslocatie">
        Op deze pagina ontdek je waar, wanneer en hoe we trainen. Van conditie tot perslucht, van vergaderruimte tot
        kleedkamers, hier vind je alle informatie over onze leslocatie, voorzieningen en bereikbaarheid.
    </PageHeading>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="grow md:w-2/3 space-y-4">
                <Card>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Training bij Duikclub Nemo
                    </h2>
                    <div class="text-justify mb-4">
                        Elke zaterdagmiddag duiken we het water in bij zwembad Vie in Kerkrade. Geen opleiding? Geen
                        probleem! We houden het afwisselend:
                        twee weken werken aan je conditie, gevolgd door een week trainen met perslucht. Zo blijft het
                        leuk
                        én leerzaam.
                    </div>
                    <div class="text-justify font-medium">
                        Tijdstip:
                    </div>
                    <div class="text-justify mb-4">
                        Iedere zaterdagmiddag van 15:30 tot 16:30 uur
                    </div>
                    <div class="text-justify mb-4">
                        Na afloop drinken we samen nog iets in de gezellige horeca van het complex, een ontspannen
                        moment
                        om na te praten en het clubgevoel te versterken.
                    </div>
                    <div>Het trainingschema is terug te vinden in de
                        <Link class="default-link" :href="route('activities.index')">agenda</Link>
                    </div>
                </Card>
            </div>
            <div class="md:w-1/3">
                <img src="../../Assets/images/vie.jpg" alt="Vie"
                     class="rounded-lg sm:rounded-xl shadow-sm"/>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="grow md:w-2/3 space-y-4">
                <Card>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Over Zwembad Vie
                    </h2>
                    <div class="text-justify mb-4">
                        Zwembad Vie is hét moderne sport- en ontmoetingscentrum van Kerkrade, geopend in 2022. Het
                        gebouw biedt onderdak aan diverse sportverenigingen en is ontworpen met oog voor
                        toegankelijkheid, duurzaamheid en comfort. Het complex beschikt over meerdere baden, een ruime
                        horeca, een multifunctionele vergaderruimte én een groene, publiek toegankelijke dakzone. Vie
                        vormt het kloppend hart van sportend Kerkrade, boven én onder water.
                    </div>
                    <div class="text-justify">
                        Duikclub Nemo is trots om onderdeel te zijn van dit levendige sportcentrum. Wij maken wekelijks
                        gebruik van het wedstrijdbad, dat met zijn afmetingen van 25 x 15 meter, 2 meter diepte én een
                        springput van 3 meter ideaal is voor zowel conditietraining als persluchtoefeningen. Daarnaast
                        hebben we de beschikking over een eigen materiaalruimte, reserveren we een aparte baan voor
                        recreatief zwemmen en gebruiken we de vergaderzaal voor theorielessen en bijeenkomsten. Ook de
                        kleedfaciliteiten zijn uitstekend geregeld, met vaste dames- en herenkleedkamers én individuele
                        hokjes.
                    </div>
                </Card>
            </div>
            <div class="md:w-1/3">
                <Card>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Route & Parkeren
                    </h2>
                    <div class="text-justify font-medium">
                        Adres
                    </div>
                    <div class="text-justify mb-4">
                        Zwembad Vie<br>
                        Vieboulevard 21<br>
                        6466 KA Kerkrade
                    </div>
                    <div class="text-justify font-medium">
                        Parkeren
                    </div>
                    <div class="text-justify mb-4">
                        Er is een ruime parkeerplaats naast het zwembad, bereikbaar via de Veldstraat.
                        Parkeren is momenteel gratis, maar er zijn plannen om dit in de toekomst betaald te maken.
                        Controleer dus altijd de informatie ter plaatse of op de website van Vie.
                    </div>
                    <div class="text-justify font-medium">
                        Routebeschrijving
                    </div>
                    <div class="text-justify mb-4">
                        Kom je via de Locht of Dentgenbachweg? Volg dan de borden “Vie” en sla af richting de Casper
                        Sprokelstraat. De parkeerplaats bevindt zich aan de achterzijde van het gebouw. Vanaf daar loop
                        je binnen één minuut naar de hoofdingang van het zwembad.
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>
