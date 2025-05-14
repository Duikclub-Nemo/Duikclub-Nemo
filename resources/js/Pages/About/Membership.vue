<script setup>
import {Head, Link} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";

const props = defineProps({
    prices: Object,
})
</script>

<template>
    <Head title="Lidmaatschap & Contributie"/>
    <PageHeading title="Lidmaatschap & Contributie">
        Bij Duikclub Nemo kun je rekenen op een open en toegankelijke vereniging waar veiligheid, plezier en
        ontwikkeling centraal staan. Leden dragen bij aan zowel de club (Duikclub Nemo) als aan de Nederlandse
        Onderwatersport Bond (NOB). Hieronder leggen we uit hoe dit werkt.
    </PageHeading>
    <div class="space-y-4">
        <Card>
            <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                Clubcontributie (Duikclub Nemo)
            </h2>
            <div class="text-justify mb-4">
                Duikclub Nemo kent de volgende lidmaatschapsvormen (conform het Huishoudelijk Reglement):
            </div>
            <div class="text-justify mb-4">
                <ul class="list-disc list-outside pl-6 space-y-4 text-gray-700">
                    <li>
                        <div>
                            <span class="block font-semibold text-gray-800">Aspirant Lid</span>
                            <span class="block text-gray-600">voor nieuwe leden. Deze status geldt gedurende het eerste lidmaatschapsjaar.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="block font-semibold text-gray-800">Seniorlid</span>
                            <span class="block text-gray-600">voor leden die langer dan één jaar aangesloten zijn bij de club.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="block font-semibold text-gray-800">Gezinslid</span>
                            <span class="block text-gray-600">voor leden die op hetzelfde adres wonen als een ander lid en langer dan één jaar aangesloten zijn bij de club.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="block font-semibold text-gray-800">Instructeur</span>
                            <span class="block text-gray-600">actieve instructeur met een geldige instructeurslicentie, erkend door het bestuur.</span>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="block font-semibold text-gray-800">Erelid</span>
                            <span class="block text-gray-600">leden die zich op bijzondere wijze verdienstelijk hebben gemaakt voor de club. Zij zijn vrijgesteld van contributie.</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="text-justify mb-4">
                De clubcontributie wordt maandelijks voldaan en dekt onder andere zwembadhuur, onderhoud van materialen
                en algemene clubkosten.
            </div>
            <div class="text-justify mb-4">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 w-1/2 text-left text-sm font-medium text-gray-700">Lidmaatschapstype</th>
                        <th class="px-4 py-2 w-1/2 text-left text-sm font-medium text-gray-700">Bedrag per maand</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">Aspirant / Seniorlid</td>
                        <td class="px-4 py-2">€ {{ props.prices.member }}</td>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">Gezinslid (na 1 jaar, zelfde adres)</td>
                        <td class="px-4 py-2">€ {{ props.prices.family }}</td>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">Instructeur</td>
                        <td class="px-4 py-2">€ {{ props.prices.instructor }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-justify mb-4">
                <h3 class="font-medium mb-2 text-gray-900">Aanvullende informatie</h3>
                <ul class="list-disc list-outside pl-6 space-y-1 text-gray-700">
                    <li>
                        <span class="block text-gray-800">Eerste jaar: Je tekent voor een lidmaatschap van ten minste één jaar.</span>
                    </li>
                    <li>
                        <span class="block text-gray-800">Na het eerste jaar: Het lidmaatschap is maandelijks opzegbaar (met 1 maand opzegtermijn).</span>
                    </li>
                    <li>
                        <span class="block text-gray-800">Gezinskorting: Gaat automatisch in na één jaar, mits er een ander lid op hetzelfde adres woont.</span>
                    </li>
                    <li>
                        <span class="block text-gray-800">De clubcontributie wordt maandelijks overgemaakt vóór de 8e van de maand. Vermeld bij betaling: "<i>CTRB + naam van het lid</i>". We verzoeken vriendelijk om de contributie per individueel lid over te maken.</span>
                    </li>
                </ul>
            </div>
            <div class="text-justify">
                <h3 class="font-medium text-gray-900">Rekeningnummer Duikclub Nemo</h3>
                <div class="select-all">
                    NL39 RABO 0307 9726 07
                </div>
                <div>
                    t.n.v. Duikclub NEMO
                </div>
            </div>
        </Card>
        <Card>
            <h2 class="flex items-center text-xl font-semibold text-gray-900 mb-2">
                Bondscontributie (NOB)
            </h2>
            <div class="text-justify mb-4">
                Iedere duiker in Nederland is verplicht lid te zijn van een duikbond. Bij Duikclub Nemo is dit de
                <Link class="default-link" :href="route('about.federation')">Nederlandse
                    Onderwatersport Bond
                </Link>
                (NOB). Wij innen deze contributie jaarlijks in december van het voorgaande jaar en dragen dit af aan de
                bond.
            </div>
            <div class="text-justify mb-4">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 w-1/2 text-left text-sm font-medium text-gray-700">Type</th>
                        <th class="px-4 py-2 w-1/2 text-left text-sm font-medium text-gray-700">Jaarbijdrage 2025</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-700">
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">Leden vanaf 18 jaar</td>
                        <td class="px-4 py-2">€ {{ props.prices.federation_senior }}</td>
                    </tr>
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2">Leden t/m 17 jaar</td>
                        <td class="px-4 py-2">€ {{ props.prices.federation_junior }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-xs mt-1">* Peildatum leeftijd: 1 januari</div>
            </div>
            <div class="text-justify">
                Inclusief ongevallen- en aansprakelijkheidsverzekering, het bondsblad Onderwatersport, en toegang tot
                het NOB-ledensysteem.
            </div>
        </Card>
    </div>
</template>
