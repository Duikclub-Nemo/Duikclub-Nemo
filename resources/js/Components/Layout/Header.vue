<script setup>
import {Link} from "@inertiajs/vue3";
import Container from "@/Components/Layout/Container.vue";
</script>

<template>
    <header class="bg-[url('@/Assets/images/header.jpg')] bg-cover bg-top h-28">
        <Container class="flex h-full items-center">
            <Link class="flex mx-auto"
                  :href="route('home')">
                <img src="../../Assets/images/nemo.png"
                     class="hidden sm:block h-24 "
                     :alt="$page.props.app.title"/>
                <div class="flex flex-1 items-center sm:ml-8">
                    <div class="font-logo text-white drop-shadow-[2px_2px_var(--tw-shadow-color)] shadow-gray-800 mx-auto sm:mx-0">
                        <p class="text-4xl sm:text-5xl">{{ $page.props.app.title }}</p>
                        <p class="text-lg sm:text-xl ml-4">{{ $page.props.app.subtitle }}</p>
                    </div>
                </div>
            </Link>
        </Container>
    </header>
</template>
