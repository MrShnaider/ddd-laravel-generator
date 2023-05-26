<template>
    <input
        :value="text"
        @input="(event) => $emit('update:text', (event.target as HTMLInputElement).value)"
        type="text" class="block h-14 px-4 py-3 text-lg text-gray-600 font-semibold rounded-lg border border-[#CCCCCC] outline-none"
    />
</template>

<script setup lang="ts">
defineProps< { text: string } >();
defineEmits<{ (e: 'update:text', value: string): void }>();
</script>
