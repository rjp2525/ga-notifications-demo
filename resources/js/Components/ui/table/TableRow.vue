<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <tr
        :class="
            cn(
                'border-b transition-colors hover:bg-zinc-100/50 data-[state=selected]:bg-zinc-100 dark:border-b-slate-700 dark:hover:bg-zinc-800/50 dark:data-[state=selected]:bg-zinc-800',
                props.class,
            )
        "
    >
        <slot />
    </tr>
</template>
