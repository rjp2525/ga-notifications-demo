<script setup lang="ts">
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import {
    Pagination,
    PaginationList,
    PaginationListItem,
} from '@/components/ui/pagination';
import { Table, TableBody, TableCell, TableRow } from '@/components/ui/table';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import type { PaginatedAnnouncements } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment';

defineProps<{
    unread_announcements: PaginatedAnnouncements;
    past_announcements: PaginatedAnnouncements;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-lg">
                            New Announcements (From your notifications)
                        </div>
                        <Table v-if="unread_announcements.data.length > 0">
                            <TableBody>
                                <TableRow
                                    v-for="announcement in unread_announcements.data"
                                    :key="announcement.id"
                                >
                                    <TableCell class="font-medium">
                                        <div class="flex-col">
                                            <div class="text-base font-medium">
                                                {{ announcement.title }}
                                            </div>
                                            <div class="mt-0.5 text-xs">
                                                By {{ announcement.author }}
                                                {{
                                                    moment(
                                                        announcement.posted,
                                                    ).fromNow()
                                                }}
                                            </div>
                                        </div>
                                    </TableCell>
                                    <TableCell class="text-right">
                                        <div
                                            class="flex items-center justify-end gap-2"
                                        >
                                            <Link
                                                as-child
                                                :href="
                                                    route('announcement.view', {
                                                        slug: announcement.slug,
                                                    })
                                                "
                                            >
                                                <Button variant="ghost"
                                                    >View</Button
                                                >
                                            </Link>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                        <div class="mt-4 flex justify-center">
                            <Pagination
                                v-if="unread_announcements.links.length > 3"
                                :total="unread_announcements.total"
                                :sibling-count="1"
                                show-edges
                                :default-page="
                                    unread_announcements.current_page
                                "
                            >
                                <PaginationList class="flex items-center gap-1">
                                    <template
                                        v-for="(
                                            link, index
                                        ) in unread_announcements.links"
                                        :key="index"
                                    >
                                        <PaginationListItem
                                            v-if="link.url"
                                            :value="index"
                                            as-child
                                        >
                                            <Button
                                                :as="Link"
                                                :href="link.url"
                                                class="h-10 w-10 p-0"
                                            >
                                                {{ link.label }}
                                            </Button>
                                        </PaginationListItem>
                                    </template>
                                </PaginationList>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-lg">Past Announcements</div>
                        <Table v-if="past_announcements.data.length > 0">
                            <TableBody>
                                <TableRow
                                    v-for="announcement in past_announcements.data"
                                    :key="announcement.id"
                                >
                                    <TableCell class="font-medium">
                                        <div class="flex-col">
                                            <div class="text-base font-medium">
                                                {{ announcement.title }}
                                                <Badge
                                                    v-if="announcement.viewed"
                                                    class="ml-1"
                                                    >Seen</Badge
                                                >
                                            </div>
                                            <div class="mt-0.5 text-xs">
                                                By {{ announcement.author }}
                                                {{
                                                    moment(
                                                        announcement.posted,
                                                    ).fromNow()
                                                }}
                                            </div>
                                        </div>
                                    </TableCell>
                                    <TableCell class="text-right">
                                        <div
                                            class="flex items-center justify-end gap-2"
                                        >
                                            <Link
                                                as-child
                                                :href="
                                                    route('announcement.view', {
                                                        slug: announcement.slug,
                                                    })
                                                "
                                            >
                                                <Button variant="ghost"
                                                    >View</Button
                                                >
                                            </Link>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                        <div class="mt-4 flex justify-center">
                            <Pagination
                                v-if="past_announcements.links.length > 3"
                                :total="past_announcements.total"
                                :sibling-count="1"
                                show-edges
                                :default-page="past_announcements.current_page"
                            >
                                <PaginationList class="flex items-center gap-1">
                                    <template
                                        v-for="(
                                            link, index
                                        ) in past_announcements.links"
                                        :key="index"
                                    >
                                        <PaginationListItem
                                            v-if="link.url"
                                            :value="index"
                                            as-child
                                        >
                                            <Button
                                                :as="Link"
                                                :href="link.url"
                                                class="h-10 w-10 p-0"
                                            >
                                                {{ link.label }}
                                            </Button>
                                        </PaginationListItem>
                                    </template>
                                </PaginationList>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
