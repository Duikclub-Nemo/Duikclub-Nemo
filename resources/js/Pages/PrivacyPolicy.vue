<script setup>
import {Head, Link} from '@inertiajs/vue3';
import Card from "@/Components/Layout/Card.vue";
import PageHeading from "@/Components/Layout/PageHeading.vue";
</script>

<template>
    <Head title="Privacy Policy"/>
    <PageHeading title="Privacy Policy">
        Bij Duikclub Nemo hechten wij veel waarde aan de privacy van onze leden en websitebezoekers. In deze
        privacyverklaring leggen wij uit welke gegevens wij verzamelen, hoe wij deze gebruiken en beschermen, en welke
        rechten je hebt met betrekking tot jouw persoonsgegevens.
    </PageHeading>
    <div class="flex">
        <Card>
            <div class="flex flex-col gap-6 sm:gap-8">
                <!-- Introductie -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Introductie
                    </h3>
                    <div class="text-justify mt-3">
                        We doen er alles aan om je privacy te waarborgen en gaan daarom zorgvuldig om met persoonsgegevens. Duikclub Nemo houdt zich aan de toepasselijke wet- en regelgeving, waaronder de Algemene Verordening Gegevensbescherming (AVG). Dit betekent dat wij:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Je persoonsgegevens verwerken in overeenstemming met het doel waarvoor deze zijn verstrekt. Deze doelen en het type persoonsgegevens staan beschreven in deze privacyverklaring.</li>
                            <li class="pl-3">Je gegevens alleen verwerken als deze minimaal nodig zijn voor de doeleinden waarvoor ze worden verzameld.</li>
                            <li class="pl-3">Altijd om je uitdrukkelijke toestemming vragen wanneer dat nodig is voor de verwerking van je gegevens.</li>
                            <li class="pl-3">Passende technische en organisatorische maatregelen nemen om je gegevens te beveiligen.</li>
                            <li class="pl-3">Geen gegevens doorgeven aan andere partijen, tenzij dit nodig is voor de doeleinden waarvoor ze zijn verstrekt.</li>
                            <li class="pl-3">Je rechten met betrekking tot je gegevens respecteren en je hierover informeren.</li>
                        </ul>
                        Als Duikclub Nemo zijn wij verantwoordelijk voor de verwerking van je persoonsgegevens. Heb je na het lezen van deze privacyverklaring vragen of wil je contact opnemen? Dat kan via <Link :href="route('contact.create')" class="hover:text-primary-600 underline">dit formulier</Link> op onze website.
                    </div>
                </div>

                <!-- Hoe gebruiken wij jouw gegevens? -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Hoe gebruiken wij jouw gegevens?
                    </h3>
                    <div class="text-justify mt-3">
                        Wij verwerken persoonsgegevens van onze leden voor de volgende doeleinden:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Het beheren van het lidmaatschap en de administratie.</li>
                            <li class="pl-3">Het plannen van activiteiten, trainingen en evenementen.</li>
                            <li class="pl-3">Het versturen van clubnieuws, updates en andere relevante communicatie.</li>
                            <li class="pl-3">Het voldoen aan wettelijke verplichtingen.</li>
                            <li class="pl-3">Het verbeteren van onze website.</li>
                        </ul>
                        Grondslagen voor deze verwerking zijn:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Je lidmaatschap bij Duikclub Nemo.</li>
                            <li class="pl-3">Je deelname aan (duik)activiteiten georganiseerd door Duikclub Nemo.</li>
                        </ul>
                    </div>
                </div>

                <!-- Welke gegevens verzamelen wij? -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Welke gegevens verzamelen wij?
                    </h3>
                    <div class="text-justify mt-3">
                        Voor bovenstaande doeleinden kunnen wij de volgende persoonsgegevens van je vragen:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">
                                <strong>Lidmaatschap:</strong> Naam, geslacht, geboortedatum, woonadres, e-mailadres, telefoonnummer, behaalde brevetten, lidmaatschapsnummers, aantal duiken en een verklaring van duikgeschiktheid.
                            </li>
                            <li class="pl-3">
                                <strong>Communicatie:</strong> Gegevens die je verstrekt via contactformulieren, e-mails of inschrijvingen voor evenementen.
                            </li>
                            <li class="pl-3">
                                <strong>Websitegebruik:</strong> Anonieme gegevens zoals IP-adres en browserinformatie, om de website te verbeteren.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Delen van gegevens -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Delen van gegevens
                    </h3>
                    <div class="text-justify mt-3">
                        Wij delen jouw gegevens alleen met derde partijen als dit nodig is voor de uitvoering van de hierboven beschreven doeleinden. Wij zorgen ervoor dat er altijd verwerkersovereenkomsten zijn met deze partijen om de veiligheid van je gegevens te garanderen. Met registratie bij Duikclub Nemo stem je in met:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Het delen van je gegevens met de Nederlandse Onderwatersport Bond (NOB) voor registratie en verzekeringen.</li>
                            <li class="pl-3">Het delen van je gegevens met derde partijen die ons ondersteunen bij administratieve of technische processen, uitsluitend indien noodzakelijk en met adequate beveiliging.</li>
                        </ul>
                    </div>
                </div>

                <!-- Bewaartermijn -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Bewaartermijn
                    </h3>
                    <div class="text-justify mt-3">
                        Je persoonsgegevens worden niet langer bewaard dan nodig is voor de doelen waarvoor ze zijn verzameld. Lidmaatschapsgegevens worden bijvoorbeeld bewaard zolang je lid bent, en daarna maximaal 7 jaar voor administratieve doeleinden.
                    </div>
                </div>

                <!-- Jouw rechten -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Jouw rechten
                    </h3>
                    <div class="text-justify mt-3">
                        Je hebt het recht om:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Inzage te krijgen in jouw persoonsgegevens.</li>
                            <li class="pl-3">Onjuiste gegevens te corrigeren.</li>
                            <li class="pl-3">Je gegevens te laten verwijderen, tenzij dit in strijd is met wettelijke verplichtingen.</li>
                            <li class="pl-3">Bezwaar te maken tegen het gebruik van je gegevens.</li>
                        </ul>
                        Voor vragen of verzoeken kun je contact met ons opnemen via <Link :href="route('contact.create')" class="hover:text-primary-600 underline">dit formulier</Link> op onze website.
                    </div>
                </div>

                <!-- Beveiliging -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Beveiliging
                    </h3>
                    <div class="text-justify mt-3">
                        Wij nemen passende technische en organisatorische maatregelen om jouw gegevens te beschermen tegen verlies, ongeoorloofde toegang of misbruik. Zo:
                        <ul class="list-disc list-outside ml-5 my-2 text-gray-700 space-y-1">
                            <li class="pl-3">Zijn alle personen die namens Duikclub Nemo toegang hebben tot je gegevens, gebonden aan geheimhouding.</li>
                            <li class="pl-3">Hanteren wij een gebruikersnaam- en wachtwoordbeleid op al onze systemen.</li>
                            <li class="pl-3">Pseudonimiseren en versleutelen we gegevens waar nodig.</li>
                            <li class="pl-3">Testen en evalueren we onze maatregelen regelmatig.</li>
                            <li class="pl-3">Informeren we onze vrijwilligers over het belang van gegevensbescherming.</li>
                        </ul>
                    </div>
                </div>

                <!-- Minderjarigen -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Minderjarigen
                    </h3>
                    <div class="text-justify mt-3">
                        Wij verwerken alleen persoonsgegevens van minderjarigen (jonger dan 16 jaar) als daarvoor schriftelijke toestemming is gegeven door een ouder, verzorger of wettelijke vertegenwoordiger.
                    </div>
                </div>

                <!-- Klachten -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Klachten
                    </h3>
                    <div class="text-justify mt-3">
                        Heb je een klacht over de verwerking van jouw gegevens? Neem dan contact met ons op. Als we er samen niet uitkomen, kun je altijd een klacht indienen bij de Autoriteit Persoonsgegevens, de toezichthouder op het gebied van privacybescherming.
                    </div>
                </div>

                <!-- Wijzigingen in Privacybeleid -->
                <div>
                    <h3 class="text-lg/5 font-medium text-gray-900 lg:truncate lg:text-xl lg:tracking-tight">
                        Wijzigingen in Privacybeleid
                    </h3>
                    <div class="text-justify mt-3">
                        Duikclub Nemo past haar privacybeleid van tijd tot tijd aan om het up-to-date te houden. Op onze website staat altijd de meest recente versie van deze privacyverklaring. We raden je aan deze regelmatig te raadplegen. Bij belangrijke wijzigingen doen we ons best om je per e-mail en via de website te informeren.
                    </div>
                </div>
            </div>

        </Card>
    </div>
</template>
