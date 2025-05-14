<script setup>
const props = defineProps({
    color: {
        type: String,
        default: 'gray',
    },
    textSize: {
        type: String,
        default: 'xs',
    }
})
</script>

<template>
    <span
        class="inline-flex items-center justify-center rounded-md px-2 py-1 font-medium 0 ring-1 ring-inset"
        :class="{
                'bg-gray-50 text-gray-600 ring-gray-500/10': props.color === 'gray',
                'bg-red-50 text-red-700 ring-red-600/10': props.color === 'red',
                'bg-yellow-50 text-yellow-800 ring-yellow-600/20': props.color === 'yellow',
                'bg-green-50 text-green-700 ring-green-600/20': props.color === 'green',
                'bg-blue-50 text-blue-700 ring-blue-700/10': props.color === 'blue',
                'bg-indigo-50 indigo-gray-700 ring-indigo-700/10': props.color === 'indigo',
                'bg-purple-50 text-purple-700 ring-purple-700/10': props.color === 'purple',
                'bg-pink-50 text-pink-700 ring-pink-700/10': props.color === 'pink',
                'bg-white text-black ring-gray-500/10': props.color === 'white',
                'text-xs': props.textSize === 'xs',
                'text-sm': props.textSize === 'sm',
                'text-md': props.textSize === 'md',
                'text-lg': props.textSize === 'lg',
                'text-xl': props.textSize === 'xl',
                'text-2xl': props.textSize === '2xl',
            }">
        <slot/>
    </span>
</template>
