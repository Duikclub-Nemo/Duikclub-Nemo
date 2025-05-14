<script setup>
import {Head, Link} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
</script>

<template>
    <Head title="Nederlandse Onderwatersport Bond"/>
    <PageHeading title="Nederlandse Onderwatersport Bond">
        De NOB ondersteunt verenigingen met opleidingen, verzekeringen en richtlijnen. Via de NOB zijn onze brevetten
        internationaal erkend, dankzij hun aansluiting bij CMAS.
        Op deze pagina lees je wat dit lidmaatschap voor jou betekent als duiker.
    </PageHeading>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="space-y-4">
                <Card>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Wat betekent een NOB-lidmaatschap voor jou?
                    </h2>
                    <img class="float-right w-18 sm:w-24 md:w-32 ml-4 sm:ml-6 mb-4 sm:mb-6"
                         src="../../Assets/images/nob_logo.png"
                         alt="NOB">
                    <div class="text-justify mb-4">
                        Als lid van Duikclub Nemo ben je automatisch aangesloten bij de <a
                        class="default-link" href="https://onderwatersport.org/">Nederlandse
                        Onderwatersport Bond</a>
                        (NOB) – dé organisatie voor sportduikers in Nederland. De NOB zet zich al sinds 1962 in voor
                        veilig, verantwoord en plezierig duiken, zowel in binnen- als buitenland. Maar wat betekent dit
                        concreet voor jou als lid?
                    </div>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Voordelen van NOB-lidmaatschap
                    </h2>
                    <div class="text-justify mb-2">
                        Het lidmaatschap bij de NOB biedt je een breed pakket aan voordelen:
                    </div>
                    <ul class="list-disc list-outside pl-6 space-y-3 mb-2">
                        <li>
                            <span class="block text-gray-900 font-medium">Internationaal erkende duikopleidingen</span>
                            <span class="block">
                                De NOB ontwikkelt opleidingen voor elk niveau: van 1*-duiker tot instructeur. Deze zijn gebaseerd op de richtlijnen van de CMAS, waardoor je NOB-brevetten wereldwijd worden geaccepteerd.
                            </span>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Verzekeringen inbegrepen</span>
                            <span class="block mb-1">
                                Als lid ben je automatisch verzekerd via de NOB:
                            </span>
                            <ul class="list-disc list-outside pl-6">
                                <li>
                                    <span class="font-medium text-gray-900">Aansprakelijkheidsverzekering</span> voor
                                    schade aan anderen tijdens duikactiviteiten.
                                </li>
                                <li>
                                    <span class="font-medium text-gray-900">Collectieve ongevallenverzekering</span>bij
                                    incidenten tijdens trainingen of duiken
                                    Deze verzekeringen zijn inbegrepen bij je jaarlijkse bondsbijdrage.
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Toegang tot het online ledensysteem</span>
                            <span class="block">
                                In je persoonlijke NOB-account vind je al je behaalde brevetten, geplande opleidingen, digitale lesmaterialen en toegang tot clubinformatie.
                            </span>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Het bondsblad “Onderwatersport”</span>
                            <span class="block">
                                Als lid ontvang je het officiële tijdschrift van de NOB, vol met duiktips, verhalen, interviews, stekkaarten en meer.
                            </span>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Toegang tot opleidingen, clinics en evenementen</span>
                            <span class="block">
                               Via de NOB kun je deelnemen aan landelijke specialisaties, workshops en evenementen – van marine-ecologie tot wrakduiken.
                            </span>
                        </li>
                    </ul>
                    <div class="text-justify">
                        Wil je weten wat het lidmaatschap bij de NOB kost en hoe dit geregeld is via Duikclub Nemo?
                        Bekijk dan onze pagina: <Link class="default-link" :href="route('about.membership')">Lidmaatschap & Contributie</Link>
                    </div>
                </Card>
                <Card>
                    <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                        Wat is CMAS en waarom is het belangrijk?
                    </h2>
                    <img class="float-right w-18 sm:w-24 md:w-32 ml-4 sm:ml-6 mb-4 sm:mb-6"
                         src="../../Assets/images/cmas_logo.png"
                         alt="NOB">
                    <div class="text-justify mb-4">
                        De <a class="default-link" href="https://www.cmas.org/">CMAS</a>
                        (Confédération Mondiale des Activités Subaquatiques) is de internationale
                        koepelorganisatie voor onderwatersporten, opgericht in 1959 op initiatief van Jacques-Yves
                        Cousteau. CMAS is wereldwijd erkend als dé standaard voor duikopleidingen, certificering en
                        veiligheid. Landen over de hele wereld sluiten zich aan via hun nationale bond – in Nederland is
                        dat de NOB
                    </div>
                    <div class="text-justify mb-2">
                        Voor jou als duiker betekent dit:
                    </div>
                    <ul class="list-disc list-outside pl-6 space-y-3 mb-4">
                        <li>
                            <span class="block text-gray-900 font-medium">Wereldwijde erkenning van je brevetten</span>
                            <span class="block">
                               Heb je een NOB-brevet? Dan kun je overal ter wereld duiken, van Egypte tot Indonesië. Duikscholen en resorts erkennen CMAS-gebaseerde brevetten zonder aanvullende eisen.
                            </span>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Consistente opleidingskwaliteit</span>
                            <span class="block">
                                De NOB hanteert opleidingsprogramma’s die direct zijn afgestemd op CMAS-richtlijnen, wat staat voor degelijkheid, veiligheid en internationale afstemming.
                            </span>
                        </li>
                        <li>
                            <span class="block text-gray-900 font-medium">Toegang tot CMAS-duikcentra wereldwijd</span>
                            <span class="block">
                                In veel landen zijn CMAS-duikscholen en -clubs actief, waar je terecht kunt voor vervolgbrevetten, uitrusting en begeleiding.
                            </span>
                        </li>
                    </ul>
                    <div class="text-justify">
                        CMAS is actief in meer dan 130 landen en vertegenwoordigt niet alleen sportduiken, maar ook
                        onderwaterhockey, vrijduiken, fotografie en wetenschappelijk duiken.
                    </div>
                </Card>
            </div>
        </div>
    </div>
</template>
