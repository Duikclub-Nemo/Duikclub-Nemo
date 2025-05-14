import {computed, ref} from 'vue'
import {defineStore} from 'pinia'
import {usePage} from '@inertiajs/vue3'

export const useAuthStore = defineStore('auth', () => {
    // states
    const user = ref(usePage().props.auth?.user || null)
    const isLoggedIn = computed(() => !!user.value)

    // actions
    const setUser = (newUser) => {
        user.value = newUser
    }

    const hasRole = (roles) => {
        // Return false when empty
        if (!roles) {
            return false;
        }
        // Get roles assigned to authenticated users and validate array
        const assignedRoles = usePage().props.auth["roles"];
        if (!Array.isArray(assignedRoles)) {
            return false;
        }

        // Check Roles
        let result = false;
        if (roles.includes('|')) {
            // IF Syntax "Role a | Role b"
            roles.split('|').forEach(function (item) {
                if (assignedRoles.includes(item.trim())) {
                    result = true
                }
            })
        } else if (roles.includes('&')) {
            // AND Syntax "Role a & Role b"
            result = true
            roles.split('&').forEach(function (item) {
                if (!assignedRoles.includes(item.trim())) {
                    result = false
                }
            })
        } else {
            // Single Role
            result = assignedRoles.includes(roles.trim())
        }

        return result
    }

    const hasPermission = (permissions) => {
        // Return false when empty
        if (!permissions) {
            return false;
        }

        // Get permissions assigned to authenticated users and validate an array
        const assignedPermissions = usePage().props.auth["permissions"];
        if (!Array.isArray(assignedPermissions)) {
            return false;
        }

        // Check Permissions
        let result = false;
        if (permissions.includes('|')) {
            // IF Syntax "Permission 1 | Permission 2"
            permissions.split('|').forEach(function (item) {
                if (assignedPermissions.includes(item.trim())) {
                    result = true
                }
            })
        } else if (permissions.includes('&')) {
            // AND Syntax "Permission 1 & Permission 2"
            result = true
            permissions.split('&').forEach(function (item) {
                if (!assignedPermissions.includes(item.trim())) {
                    result = false
                }
            })
        } else {
            // Single Permission
            result = assignedPermissions.includes(permissions.trim())
        }

        return result
    }

    // expose
    return {
        // states
        user,
        isLoggedIn,
        // actions
        setUser,
        hasRole,
        hasPermission,
    }
})
