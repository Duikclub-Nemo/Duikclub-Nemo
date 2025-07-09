<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import {ChevronLeftIcon} from "@heroicons/vue/24/outline/index.js";
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputDropdown from "@/Components/Forms/InputDropdown.vue";
import InputCKEditor from "@/Components/Forms/InputCKEditor.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";

const props = defineProps({
    user: Object,
    genders: Array,
    countries: Array,
    federations: Array,
    ckeditorLicenseKey: String,
})

const form = useForm({
    email: props.user.email,
    first_name: props.user.first_name,
    initials: props.user.initials,
    last_name: props.user.last_name,
    gender: props.user.gender,
    date_of_birth: props.user.date_of_birth,
    street: props.user.street,
    zipcode: props.user.zipcode,
    place: props.user.place,
    country_id: props.user.country_id,
    phone_number: props.user.phone_number,
    federation: props.user.federation,
    federation_membership: props.user.federation_membership,
    medical_check: props.user.medical_check,
    dives: props.user.dives,
    ice_name: props.user.ice_name,
    ice_phone_number: props.user.ice_phone_number,
    about_me: props.user.about_me,
})

const submit = () => {
    form.clearErrors()
    form.patch(route('member.profile.update'), {
        preserveScroll: true,
        preserveState: true
    })
}
</script>

<template>
    <Head title="Mijn Profiel"/>
    <PageHeading title="Mijn Profiel">
        <template #action>
            <Link :href="route('member.profile.show')"
                  class="flex items-center hover:text-gray-900">
                <ChevronLeftIcon class="size-5 mr-2" aria-hidden="true"/>
                <div>Terug</div>
            </Link>
        </template>
        Op deze pagina beheer je eenvoudig je persoonlijke gegevens als lid van Duikclub Nemo.
        Het is belangrijk dat je profiel up-to-date is, zodat we je kunnen informeren over trainingen, activiteiten en
        clubzaken.
    </PageHeading>
    <Card>
        <form class="space-y-6"
              @submit.prevent="submit">
            <fieldset class="space-y-3">
                <div>
                    <h2 class="font-medium text-lg">Persoonsgegevens</h2>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-5/12">
                        <InputLabel for="first_name"
                                    value="Voornaam"
                                    required/>
                        <InputText id="first_name"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.first_name"
                                   required
                                   autocomplete="given-name"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.first_name"/>
                    </div>
                    <div class="md:w-2/12">
                        <InputLabel for="initials"
                                    value="Voorletters"
                                    required/>
                        <InputText id="initials"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.initials"
                                   required
                                   autocomplete="initials"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.initials"/>
                    </div>
                    <div class="md:w-5/12">
                        <InputLabel for="last_name"
                                    value="Achternaam"
                                    required/>
                        <InputText id="first_name"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.last_name"
                                   required
                                   autocomplete="family-name"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.last_name"/>
                    </div>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="gender"
                                    value="Geslacht"
                                    required/>
                        <InputDropdown id="gender"
                                       class="block w-full"
                                       v-model="form.gender"
                                       :options="props.genders"
                                       required
                                       autocomplete="sex"
                                       :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.gender"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="date_of_birth"
                                    value="Geboortedatum"
                                    required/>
                        <InputText id="date_of_birth"
                                   type="date"
                                   class="block w-full"
                                   v-model="form.date_of_birth"
                                   required
                                   autocomplete="bday"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.date_of_birth"/>
                    </div>
                </div>
                <div>
                    <InputLabel for="street"
                                value="Straat en huisnummer"
                                required/>
                    <InputText id="street"
                               type="text"
                               class="block w-full md:w-3/4 lg:w-1/2"
                               v-model="form.street"
                               required
                               autocomplete="street-address"
                               :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.street"/>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-2/12">
                        <InputLabel for="zipcode"
                                    value="Postcode"
                                    required/>
                        <InputText id="zipcode"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.zipcode"
                                   required
                                   autocomplete="postal-code"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.zipcode"/>
                    </div>
                    <div class="md:w-5/12">
                        <InputLabel for="place"
                                    value="Woonplaats"
                                    required/>
                        <InputText id="place"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.place"
                                   required
                                   autocomplete="address-level2"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.place"/>
                    </div>
                    <div class="md:w-5/12">
                        <InputLabel for="country_id"
                                    value="Land"
                                    required/>
                        <InputDropdown id="country_id"
                                       class="block w-full"
                                       v-model="form.country_id"
                                       :options="props.countries"
                                       required
                                       autocomplete="country-name"
                                       :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.country_id"/>
                    </div>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="email"
                                    value="E-mailadres"
                                    required/>
                        <InputText id="email"
                                   type="email"
                                   class="block w-full"
                                   v-model="form.email"
                                   required
                                   autocomplete="email"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.email"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="phone_number"
                                    value="Telefoonnummer"/>
                        <InputText id="phone_number"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.phone_number"
                                   autocomplete="tel"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.phone_number"/>
                    </div>
                </div>
            </fieldset>
            <fieldset class="space-y-3">
                <div>
                    <h2 class="font-medium text-lg">Duikgegevens</h2>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="federation"
                                    value="Duikorganisatie"/>
                        <InputDropdown id="federation"
                                       class="block w-full"
                                       v-model="form.federation"
                                       :options="props.federations"
                                       :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.federation"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="federation_membership"
                                    value="Lidmaatschapsnummer"/>
                        <InputText id="federation_membership"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.federation_membership"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.federation_membership"/>
                    </div>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="medical_check"
                                    value="Laatste medische keuring"/>
                        <InputText id="medical_check"
                                   type="date"
                                   class="block w-full"
                                   v-model="form.medical_check"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.medical_check"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="dives"
                                    value="Aantal duiken"/>
                        <InputText id="dives"
                                   type="number"
                                   min="0"
                                   class="block w-full"
                                   v-model="form.dives"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.dives"/>
                    </div>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="ice_name"
                                    value="ICE Contactpersoon"/>
                        <InputText id="ice_name"
                                   type="text"
                                   class="block w-full"
                                   v-model="form.ice_name"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.ice_name"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="ice_phone_number"
                                    value="ICE Telefoonnummer"/>
                        <InputText id="ice_phone_number"
                                   type="tel"
                                   class="block w-full"
                                   v-model="form.ice_phone_number"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.ice_phone_number"/>
                    </div>
                </div>
            </fieldset>
            <fieldset class="space-y-3">
                <div>
                    <h2 class="font-medium text-lg">Over mij</h2>
                </div>
                <div class="min-w-0">  <!-- hier -->
                    <InputCKEditor id="about_me"
                                   class="w-full"
                                   v-model="form.about_me"
                                   path="about/"
                                   :ckeditor-license-key="ckeditorLicenseKey"
                                   :disabled="form.processing"/>
                    <InputError v-if="form.errors.about_me" class="mt-2"
                                :message="form.errors.about_me"/>
                </div>
            </fieldset>
            <div>
                <PrimaryButton @click="submit"
                               class="w-full"
                               :disabled="form.processing">
                    Opslaan
                </PrimaryButton>
            </div>
        </form>
    </Card>
</template>
