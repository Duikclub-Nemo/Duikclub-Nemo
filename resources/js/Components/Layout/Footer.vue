<script setup>
import {Link} from "@inertiajs/vue3";
import Container from "@/Components/Layout/Container.vue";
import FacebookIcon from "@/Components/Icons/FacebookIcon.vue";
import InstagramIcon from "@/Components/Icons/InstagramIcon.vue";
import YoutubeIcon from "@/Components/Icons/YoutubeIcon.vue";
</script>

<template>
    <footer>
        <div class="bg-gradient-to-b from-gray-100 to-gray-200 border-t border-gray-300">
            <Container class="py-6">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex justify-center space-x-3 md:order-2">
                        <FacebookIcon
                            class="text-gray-500 hover:text-primary-600 hover:bg-gray-200 "
                            href="https://www.facebook.com/DuikclubNemo"
                            name="Facebook"/>
                        <InstagramIcon
                            class="text-gray-500 hover:text-primary-600 hover:bg-gray-200"
                            href="https://www.instagram.com/duikclubnemo"
                            name="Instagram"/>
                        <YoutubeIcon
                            class="text-gray-500 hover:text-primary-600 hover:bg-gray-200"
                            href="https://www.youtube.com/channel/UCIhJHGDvavkC9rexe0mnIgw"
                            name="Youtube"/>
                    </div>
                    <div class="mt-4 md:order-1 md:mt-0">
                        <div class="md:text-left text-center text-sm">
                            <p>DCNemo.NL &copy;{{ new Date().getFullYear() }}
                                (
                                <Link class="default-link"
                                      :href="route('release_notes')">{{ $page.props.app.version }}
                                </Link>
                                )
                            </p>
                            <p>
                                <Link class="default-link"
                                      :href="route('terms')">Algemene Voorwaarden
                                </Link>
                                &
                                <Link class="default-link"
                                      :href="route('privacy_policy')">Privacy Policy
                                </Link>
                            </p>
                        </div>
                    </div>
                </div>
            </Container>
        </div>
        <div class="h-4 bg-primary-700"/>
    </footer>
</template>>
