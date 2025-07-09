<script setup>
import {Head} from '@inertiajs/vue3';
import PageHeading from "@/Components/Layout/PageHeading.vue";
import Card from "@/Components/Layout/Card.vue";
import UpdateSettingsForm from "@/Pages/Member/Setting/Partials/UpdateSettingsForm.vue";
import UpdateNotificationsForm from "@/Pages/Member/Setting/Partials/UpdateNotificationsForm.vue";
import UpdatePasswordForm from "@/Pages/Member/Setting/Partials/UpdatePasswordForm.vue";
import UpdateSessionsForm from "@/Pages/Member/Setting/Partials/UpdateSessionsForm.vue";

const props = defineProps({
    user: Object,
    sessions: Object,
})

</script>

<template>
    <Head title="Instellingen"/>
    <PageHeading title="Instellingen">
        Beheer hier je persoonlijke voorkeuren. Je kunt onder andere je wachtwoord wijzigen, je notificatie-instellingen
        aanpassen en andere handige opties instellen om je account naar wens te personaliseren.
    </PageHeading>
    <div class="flex flex-col gap-6">
        <Card>
            <UpdateSettingsForm
                :user="props.user"/>
        </Card>
        <Card>
            <UpdatePasswordForm
                :user="props.user"/>
        </Card>
        <Card>
            <UpdateNotificationsForm
                :user="props.user"/>
        </Card>
        <Card>
            <UpdateSessionsForm
                :sessions="props.sessions"/>
        </Card>
    </div>
</template>
