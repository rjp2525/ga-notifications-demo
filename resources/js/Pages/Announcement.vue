<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import type { Announcement } from '@/types';
import { Head } from '@inertiajs/vue3';

defineProps<{
    announcement: Announcement;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
                >
                    {{ announcement.title }}
                </h2>
                <div class="flex flex-col justify-end text-right text-white">
                    <span class="text-base">{{ announcement.author }}</span>
                    <span class="text-xs">{{ announcement.posted }}</span>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div
                        class="prose dark:prose-invert p-6 text-gray-900 dark:text-gray-100"
                    >
                        <div v-html="announcement.body"></div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
