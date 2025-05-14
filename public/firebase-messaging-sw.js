importScripts('https://www.gstatic.com/firebasejs/11.6.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/11.6.0/firebase-messaging-compat.js');

// Set Firebase configuration, once available
self.addEventListener('fetch', () => {
    try {
        const urlParams = new URLSearchParams(location.search);
        self.firebaseConfig = Object.fromEntries(urlParams);
    } catch (err) {
        console.error('Failed to add event listener', err);
    }

});
// "Default" Firebase configuration (prevents errors)
const defaultConfig = {
    apiKey: true,
    projectId: true,
    messagingSenderId: true,
    appId: true,
};

// Initialize Firebase app
firebase.initializeApp(self.firebaseConfig || defaultConfig);
let messaging;
try {
    messaging = firebase.messaging();
} catch (err) {
    console.error('Failed to initialize Firebase Messaging', err);
}

// To display background notifications
if (messaging) {
    try {
        messaging.onBackgroundMessage((payload) => {
            console.log('Received background message: ', payload);

            const messageId = payload.data?.messageId || `${payload.notification.title}-${payload.notification.body}-${Date.now()}`;

            const notificationTitle = payload.data.title;
            const notificationOptions = {
                body: payload.data.body,
                icon: payload.data.imageUrl || '/images/apple-touch-icon.png',
                tag: messageId,
                data: {
                    url: payload.data.url || '/'
                }
            };
            self.registration.showNotification(notificationTitle, notificationOptions);
        });
    } catch (err) {
        console.log(err);
    }
}

self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    const urlToOpen = event.notification.data?.url || '/';

    event.waitUntil(
        self.clients.matchAll({
            type: 'window',
            includeUncontrolled: true
        })
            .then(function (clientList) {
                for (let i = 0; i < clientList.length; i++) {
                    const client = clientList[i];
                    if (client.url === urlToOpen && 'focus' in client) {
                        return client.focus();
                    }
                }
                if (self.clients.openWindow) {
                    return self.clients.openWindow(urlToOpen);
                }
            })
    );
});
