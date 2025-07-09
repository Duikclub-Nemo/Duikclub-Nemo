// src/stores/toastStore.js
import {defineStore} from 'pinia'
import {ref} from 'vue'

export const useToastStore = defineStore('toasts', () => {
        // states
        const items = ref([])

        // actions
        function add(message) {
            items.value.unshift({
                key: Symbol(),
                ...message
            })
        }

        function success(value) {
            add({
                type: 'success',
                message: value,
                duration: 3000,
            })
        }

        function danger(value) {
            add({
                type: 'danger',
                message: value,
                duration: 3000,
            })
        }

        function remove(index) {
            items.value.splice(index, 1)
        }

        // expose
        return {
            // states
            items,
            // actions
            add,
            success,
            danger,
            remove
        }
    },
    {
        persist: false
    }
)
