<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import InputLabel from '@/components/InputLabel.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import TextAreaInput from '@/components/TextAreaInput.vue';
import TextInput from '@/components/TextInput.vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    body: '',
});
</script>

<template>
    <Head title="Create Announcement" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Create Announcement
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
                >
                    <form
                        @submit.prevent="
                            form.post(route('announcement.create'))
                        "
                        class="mt-6 space-y-6"
                    >
                        <div>
                            <InputLabel for="title" value="Title" />

                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                required
                                autofocus
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.title"
                            />
                        </div>

                        <div>
                            <InputLabel for="body" value="Markdown Content" />

                            <TextAreaInput
                                id="body"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.body"
                                rows="10"
                                required
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.body"
                            />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">{{
                                form.processing ? 'Creating' : 'Create'
                            }}</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
