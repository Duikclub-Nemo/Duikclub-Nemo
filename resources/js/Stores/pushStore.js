import {defineStore} from 'pinia'
import {computed, ref} from "vue";
import {useAuthStore} from "@/Stores/authStore.js";
import {initializeApp} from "firebase/app"
import {getMessaging, getToken, onMessage} from "firebase/messaging"
import axios from "axios";

const firebaseConfig = {};

let app
let messaging

if (typeof window !== 'undefined') {
    try {
        app = initializeApp(firebaseConfig)
        messaging = getMessaging(app)
    } catch (error) {
        console.error('Firebase initialization error:', error)
    }
}

export const usePushStore = defineStore('push', () => {
        const auth = useAuthStore()

        // states
        const hasDeclined = ref(false)
        const token = ref(null)
        const notificationMessages = ref([])

        // getters
        const shouldShowPermissionModal = computed(() => {
            return (
                !!auth.isLoggedIn &&
                isBrowserCompatible() &&
                Notification.permission !== 'denied' &&
                Notification.permission !== 'granted' &&
                !hasDeclined.value
            )
        })

        const hasPermission = computed(() => {
            return (
                auth.isLoggedIn &&
                isBrowserCompatible() &&
                Notification.permission === 'granted' &&
                !hasDeclined.value
            )
        })

        // actions
        function declinePermission() {
            hasDeclined.value = true
        }

        async function requestPermission() {
            try {
                const permission = await Notification.requestPermission()
                if (permission === 'granted') {
                    await registerServiceWorker()
                    await getFCMToken()
                }
            } catch (error) {
                console.error('Permission request failed:', error)
            }
        }

        async function registerServiceWorker() {
            try {
                return await navigator.serviceWorker.register('/firebase-messaging-sw.js', {
                    scope: '/'
                })
            } catch (error) {
                console.error('Service worker registration failed:', error)
                throw error
            }
        }

        async function getFCMToken() {
            try {
                const currentToken = await getToken(messaging, {
                    vapidKey: ''
                })
                if (currentToken) {
                    token.value = currentToken
                    await sendTokenToServer(currentToken)
                } else {
                    console.log('No registration token available. Request permission to generate one.')
                }
            } catch (error) {
                console.error('Error getting FCM token:', error)
            }
        }

        async function sendTokenToServer(fcmToken) {
            if (auth.isLoggedIn) {
                try {
                    await axios.post('/api/fcm_tokens', {
                        token: fcmToken,
                        device_info: navigator.userAgent
                    });
                } catch (error) {
                    console.error('Error sending token to server:', error)
                }
            }
        }

        function setupMessageHandler() {
            if (!messaging) return
            onMessage(messaging, (payload) => {
                if (payload.data && !payload.data.timestamp) {
                    payload.data.timestamp = new Date().toISOString()
                } else if (!payload.data) {
                    payload.data = {timestamp: new Date().toISOString()}
                }

                const messageId = payload.data?.messageId || `message-${Date.now()}`;

                notificationMessages.value.unshift(payload)

                if (Notification.permission === 'granted') {
                    const notificationTitle = payload.data.title
                    const notificationOptions = {
                        body: payload.data.body,
                        icon: payload.data.imageUrl || '/images/apple-touch-icon.png',
                        tag: messageId
                    }
                    const notification = new Notification(notificationTitle, notificationOptions)

                    notification.onclick = function () {
                        window.open(payload.data.url || '/', '_blank');
                        notification.close();
                    }

                }

            })
        }

        function initialize() {
            if (isBrowserCompatible()) {
                if (Notification.permission === 'granted') {
                    registerServiceWorker()
                        .then(() => getFCMToken())
                        .then(() => setupMessageHandler())
                        .catch(err => console.error('Push initialization error:', err))
                }
            }
        }

        // functions
        function isBrowserCompatible() {
            return (
                typeof window !== 'undefined' &&
                'Notification' in window &&
                'PushManager' in window
            )
        }

        // expose
        return {
            // states
            hasDeclined,
            token,
            notificationMessages,
            hasPermission,
            // getters
            shouldShowPermissionModal,
            // actions
            declinePermission,
            requestPermission,
            initialize,
        }
    },
    {
        persist: {
            key: 'nemo_push_permission',
            storage: localStorage,
            pick: ['hasDeclined'],
        },
    })
