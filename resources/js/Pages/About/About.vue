<script setup>
import {Head, Link} from '@inertiajs/vue3';
import Card from "@/Components/Layout/Card.vue";
import PageHeading from "@/Components/Layout/PageHeading.vue";

const timeline = [
    {
        year: 'Januari 2004',
        title: 'Oprichting Duikclub Nemo',
        text: 'Oprichting van Duikclub Nemo door John Niemarkt als duikschool onder de vlag van de Associated European Divers (AED). ' +
            'De club start met trainingen in het oude zwembad In de Bende in Landgraaf.'
    },
    {
        year: 'December 2015',
        title: 'Oprichting van de vereniging',
        text: 'In deze periode wordt besloten de club juridisch om te vormen van duikschool naar een vereniging. ' +
            'Dit markeert het officiële begin van Duikclub Nemo als vereniging.'
    },
    {
        year: 'Januari 2016',
        title: 'Aansluiting bij de NOB',
        text: 'Duikclub Nemo sluit zich aan bij de Nederlandse Onderwatersport Bond (NOB), nadat de AED definitief haar CMAS-licentie verliest. ' +
            'Hiermee blijven de brevetten internationaal erkend.'
    },
    {
        year: 'September 2016',
        title: 'Verhuizing naar D’r Pool in Kerkrade',
        text: 'De politieke situatie rondom zwembad In de Bende in Landgraaf was zo onzeker, dat besloten werd te verhuizen naar zwembad D’r Pool in Kerkrade.'
    },
    {
        year: 'September 2022',
        title: 'Verhuizing naar zwembad Vie',
        text: 'Start van de trainingen in het nieuwe zwembad Vie in Kerkrade, ter vervanging van het gesloten D’r Pool.'
    },
]

</script>

<template>
    <Head title="Over Duikclub Nemo"/>
    <PageHeading title="Over Duikclub Nemo">
        Op deze pagina lees je meer over wie we zijn, waar we vandaan komen en wat ons als club zo bijzonder maakt. Van
        onze oprichting in 2004 tot de verhuizing naar het zwembad Vie, ontdek de geschiedenis, sfeer en visie van
        Duikclub Nemo.
    </PageHeading>
    <div class="flex flex-col md:flex-row gap-4">
        <div class="grow md:w-1/2 space-y-4">
            <Card>
                <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                    Wie zijn wij?
                </h2>
                <div class="text-justify">
                    Duikclub Nemo uit Kerkrade is een actieve en gezellige vereniging waar duikliefhebbers van alle
                    leeftijden en niveaus samenkomen. Ons doel is om mensen zodanig op te leiden dat ze zelfstandig over
                    de hele wereld kunnen duiken. Daarnaast bieden we onze leden de mogelijkheid om op een leuke manier
                    bezig te zijn met de duiksport, zich verder te specialiseren en de vereiste basisconditie op peil te
                    houden.
                </div>
            </Card>
            <Card>
                <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                    Onze missie & visie
                </h2>
                <div class="text-justify mb-2">
                    Wij streven ernaar om mensen op te leiden tot zelfstandige duikers die wereldwijd kunnen duiken.
                    Voor onze bestaande leden bieden we mogelijkheden om op een leuke manier bezig te zijn met de
                    duiksport, zich verder te specialiseren en de vereiste basisconditie op peil te houden.
                </div>
                <div class="text-justify">
                    Bij Duikclub Nemo leggen we naast veiligheid de nadruk op het groepsgevoel. Niet alleen de
                    trainingen zijn belangrijk, maar gezamenlijk een drankje nemen na afloop is ook van belang.
                </div>
            </Card>
            <Card>
                <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                    Trainingen en activiteiten
                </h2>
                <div class="text-justify">
                    Onze trainingen vinden elke zaterdag plaats in
                    <Link class="default-link" :href="route('about.location')">Zwembad Vie in
                        Kerkrade
                    </Link>
                    , van 15:30 tot 16:30 uur. We
                    bieden zowel conditietrainingen als persluchttrainingen aan. Daarnaast organiseren we regelmatig
                    buitenduiken, theorielessen en andere activiteiten. Bekijk onze
                    <Link class="default-link" :href="route('activities.index')">agenda</Link>
                    voor een overzicht van de geplande activiteiten.
                </div>
            </Card>
            <Card>
                <h2 class="flex items-center text-xl font-semibold text-gray-900">
                    Ben je nieuwsgierig geworden?
                </h2>
                <div class="text-justify mb-2">
                    Bekijk hoe je lid kunt worden op de pagina
                    <Link class="default-link" :href="route('about.membership')">Lidmaatschap &
                        Contributie
                    </Link>
                    , of ontdek waar en wanneer we
                    trainen via
                    <Link class="default-link" :href="route('about.location')">Les- en
                        Trainingslocatie
                    </Link>
                    .
                </div>
                <div class="text-justify">
                    Wil je eerst eens ervaren hoe het is om te duiken? Vraag dan een vrijblijvende
                    <Link class="default-link" :href="route('about.trail')">proefles</Link>
                    aan!
                    Heb je vragen of wil je meer informatie? Neem gerust contact met ons op via het
                    <Link class="default-link" :href="route('contact.create')">contactformulier
                    </Link>
                    .
                </div>
            </Card>
        </div>
        <div class="md:w-1/2">
            <Card>
                <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                    Geschiedenis
                </h2>
                <div class="text-justify mb-5">
                    Duikclub Nemo was sinds 2004 actief onder de vlag van de AED. Na de opheffing van de AED in 2015
                    zijn we lid geworden van de Nederlandse Onderwatersport Bond (NOB) en officieel opgericht als
                    Duikclub Nemo in december 2015.
                </div>
                <div>
                    <ol class="relative border-s border-primary-500">
                        <li v-for="item in timeline" class="mb-7 ms-4">
                            <div
                                class="absolute size-3 bg-primary-500 rounded-full mt-1.5 -start-1.5 border border-white"></div>
                            <time class="text-sm font-normal leading-none">
                                {{ item.year }}
                            </time>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ item.title }}
                            </h3>
                            <p class="text-base font-normal text-justify">
                                {{ item.text }}
                            </p>
                        </li>
                    </ol>
                </div>
            </Card>
        </div>
    </div>
</template>
