import axios from 'axios';
import './echo';
import {router, usePage} from "@inertiajs/vue3";
import {useAuthStore} from "@/Stores/authStore.js";

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;
window.axios.defaults.withXSRFToken = true

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that Laravel broadcasts. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */


/**
 * Sync AuthStore
 */
router.on('success', () => {
    const auth = useAuthStore()
    auth.setUser(usePage().props.auth.user || null)
})
