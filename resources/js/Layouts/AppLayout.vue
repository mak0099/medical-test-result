<template>
    <div>
        <Head :title="title" />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('test-results.create')" :active="route().current('test-results.create')">
                                    New Test Result
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('test-results.index')" :active="route().current('test-results.index')">
                                    Test Result List
                                </jet-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('medical-tests.index')" :active="route().current('medical-tests.index')">
                                    Medical Tests
                                </jet-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String,
        },

        components: {
            Head,
            JetNavLink,
            Link,
        },
    })
</script>
