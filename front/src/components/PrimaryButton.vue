<template>
	<button @click="$emit('click')" class="
		bg-[#329CBD] text-[#E5F1FB] shadow-md px-5 py-4 rounded-lg text-xl font-medium
		hover:bg-cyan-600 active:shadow-none
	"><slot /></button>
</template>

<script setup lang="ts">
defineEmits(['click']);
</script>
