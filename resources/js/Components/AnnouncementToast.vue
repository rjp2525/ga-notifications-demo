<script lang="ts" setup>
import moment from 'moment';
import { computed } from 'vue';

const props = defineProps<{
    title: string;
    author: string;
    date: string;
}>();

// This is a computed prop for handling new data, otherwise state will persist
const timeAgo = computed(() => moment(props.date).fromNow());
</script>

<template>
    <div class="flex w-full flex-col">
        <div class="text-base">{{ title }}</div>
        <div class="text-xs italic text-zinc-400">
            {{ timeAgo }} by {{ author }}
        </div>
    </div>
</template>
