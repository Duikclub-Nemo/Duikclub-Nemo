import {defineStore} from 'pinia'
import {computed, onMounted, onUnmounted, ref} from 'vue'
import axios from 'axios'
import {useAuthStore} from "@/Stores/authStore";
import {useToastStore} from "@/Stores/toastStore.js";

export const useNotificationStore = defineStore('notifications', () => {
    const userId = useAuthStore().user.id

    // states
    const notifications = ref([])
    const unread = computed(() =>
        notifications.value.filter(n => n.read_at === null).length
    )

    // actions
    async function fetch() {
        const {data} = await axios.get('/api/notifications/get')
        notifications.value = data
    }

    async function markAllRead() {
        await axios.post('/api/notifications/mark-all-read')
        await fetch()
    }

    async function markAsRead(id) {
        await axios.post(`/api/notifications/${id}/mark-read`)
        await fetch()
    }

    async function remove(id) {
        await axios.delete(`/api/notifications/${id}`)
        await fetch()
    }

    // functions
    function subscribe() {
        if (!userId || typeof window === 'undefined') return
        window.Echo
            .private(`App.Models.User.${userId}`)
            .notification((data) => {
                fetch()
                useToastStore().add({
                    type: data.style ?? 'info',
                    message: data.title,
                    duration: data.duration ?? 3000
                })
            })
    }

    function unsubscribe() {
        if (!userId || typeof window === 'undefined') return
        window.Echo.leave(`App.Models.User.${userId}`)
    }

    onMounted(subscribe)
    onUnmounted(unsubscribe)

    // expose
    return {
        // states
        notifications,
        unread,
        // actions
        fetch,
        markAllRead,
        markAsRead,
        remove,
    }
})
