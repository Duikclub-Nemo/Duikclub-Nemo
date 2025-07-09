<script setup>
import {defineAsyncComponent, ref} from "vue";
import {Head, Link, useForm} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import InputLabel from "@/Components/Forms/InputLabel.vue";
import InputText from "@/Components/Forms/InputText.vue";
import InputError from "@/Components/Forms/InputError.vue";
import InputSwitch from "@/Components/Forms/InputSwitch.vue";
import PrimaryButton from "@/Components/Forms/PrimaryButton.vue";
import HelpIcon from "@/Components/Icons/HelpIcon.vue";
import InputDropdown from "@/Components/Forms/InputDropdown.vue";

const props = defineProps({
    genders: Array,
    countries: Array,
    federations: Array,
    certifications: Array,
    terms_date: String,
    terms: String
})

const form = useForm({
    email: '',
    password: '',
    password_confirmation: '',
    first_name: '',
    initials: '',
    last_name: '',
    gender: 1,
    date_of_birth: '',
    street: '',
    zipcode: '',
    place: '',
    country_id: 154,
    phone_number: '',
    federation: 3,
    federation_membership: '',
    certification: null,
    certification_date: '',
    certificate_number: '',
    medical_check: '',
    dives: 0,
    ice_name: '',
    ice_phone_number: '',
    privacy_mode: false,
    display_userlist: true,
    accepted_terms: false
})

const submit = () => {
    form.clearErrors()
    form.post(route('register'), {})
}

const isPrivacyModeModal = ref(false)
const isDisplayUserListModal = ref(false)

const PrivacyModeDescriptionModal = defineAsyncComponent(() =>
    import('@/Modals/PrivacyModeDescriptionModal.vue'))

const DisplayUserListDescriptionModal = defineAsyncComponent(() =>
    import('@/Modals/DisplayUserListDescriptionModal.vue'))

const setPrivacyMode = (bool) => {
    form.privacy_mode = bool
    isPrivacyModeModal.value = false
}

const setDisplayUserList = (bool) => {
    form.display_userlist = bool
    isDisplayUserListModal.value = false
}
</script>

<template>
    <Head title="Registreren"/>
    <PageHeading title="Registreren">
        Ben je lid bij Duikclub Nemo, maar heb je nog account? Dan kun je je hier registreren. Wil je meer weten
        of een lidmaatschap bij Duikclub Nemo?
        <Link class="text-primary-600 hover:underline"
              :href="route('about.membership')">Bekijk dan deze pagina.
        </Link>
    </PageHeading>
    <Card>
        <form class="space-y-6"
              @submit.prevent="submit">
            <fieldset class="space-y-3">
                <div>
                    <h2 class="font-medium text-lg">Accountgegevens</h2>
                </div>
                <div>
                    <InputLabel for="email"
                                value="E-mailadres"
                                required/>
                    <InputText id="email"
                               type="email"
                               class="block w-full md:w-3/4 lg:w-1/2"
                               v-model="form.email"
                               required
                               autofocus
                               autocomplete="email"
                               :disabled="form.processing"/>
                    <InputError class="mt-1"
                                :message="form.errors.email"/>
                </div>
                <div class="md:flex md:space-x-6 space-y-4 md:space-y-0">
                    <div class="md:w-1/2">
                        <InputLabel for="password"
                                    value="Wachtwoord"
                                    required/>
                        <InputText id="password"
                                   type="password"
                                   class="block w-full"
                                   v-model="form.password"
                                   required
                                   autocomplete="new-password"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.password"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="password_confirmation"
                                    value="Bevestig wachtwoord"
                                    required/>
                        <InputText id="password_confirmation"
                                   type="password"
                                   class="block w-full"
                                   v-model="form.password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.password_confirmation"/>
                    </div>
                </div>
            </fieldset>
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
                        <InputLabel for="certification"
                                    value="Brevet"/>
                        <InputDropdown id="certification"
                                       class="block w-full"
                                       v-model="form.certification"
                                       :options="props.certifications"
                                       :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.certification"/>
                    </div>
                    <div class="md:w-1/2">
                        <InputLabel for="certification_date"
                                    value="Brevet behaald"/>
                        <InputText id="certification_date"
                                   type="date"
                                   class="block w-full"
                                   v-model="form.certification_date"
                                   :disabled="form.processing"/>
                        <InputError class="mt-1"
                                    :message="form.errors.certification_date"/>
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
                    <h2 class="font-medium text-lg">Instellingen</h2>
                </div>
                <div class="flex flex-row items-center">
                    <InputSwitch v-model="form.privacy_mode"
                                 :disabled="form.processing">
                        <div>
                            Privacy Mode
                        </div>
                    </InputSwitch>
                    <HelpIcon
                        class="ml-2 dark:hover:text-primary-500 hover:text-primary-600 hover:bg-gray-200 dark:hover:bg-gray-600"
                        @click="isPrivacyModeModal = true"/>
                    <InputError class="mt-1"
                                :message="form.errors.privacy_mode"/>
                </div>
                <div class="flex flex-row items-center">
                    <InputSwitch v-model="form.display_userlist"
                                 :disabled="form.processing">
                        Weergeven op ledenlijst
                    </InputSwitch>
                    <HelpIcon
                        class="ml-2 dark:hover:text-primary-500 hover:text-primary-600 hover:bg-gray-200 dark:hover:bg-gray-600"
                        @click="isDisplayUserListModal = true"/>
                    <InputError class="mt-1"
                                :message="form.errors.display_userlist"/>
                </div>
            </fieldset>
            <fieldset class="space-y-3">
                <div>
                    <h2 class="font-medium text-lg">Algemene Voorwaarden</h2>
                </div>
                <div
                    class="w-full h-60 p-2 border border-gray-200 bg-gray-50 rounded-lg overflow-y-scroll">
                    <div>{{ terms }}</div>
                    <div class="mt-2">Laatst bijgewerkt: {{ terms_date }}</div>
                </div>
                <div>
                    <InputSwitch v-model="form.accepted_terms"
                                 :disabled="form.processing">
                        Ik heb de Algemene Voorwaarden gelezen en ga hiermee akkoord.
                    </InputSwitch>
                    <InputError class="mt-1"
                                :message="form.errors.accepted_terms"/>
                </div>
            </fieldset>
            <div>
                <PrimaryButton @click="submit"
                               class="w-full"
                               :disabled="form.processing">
                    Registeren
                </PrimaryButton>
            </div>
        </form>
    </Card>

    <PrivacyModeDescriptionModal :show="isPrivacyModeModal"
                                 @close="isPrivacyModeModal = false"
                                 @privacymode="setPrivacyMode"/>

    <DisplayUserListDescriptionModal :show="isDisplayUserListModal"
                                     @close="isDisplayUserListModal = false"
                                     @displayuserlist="setDisplayUserList"/>

</template>
