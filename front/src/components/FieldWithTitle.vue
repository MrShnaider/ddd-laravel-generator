<template>
	<label>
		<span class="block text-[#606F78] text-2xl mb-1">{{ title }}</span>
		<hr class="border border-gray-400 mb-3">
		<slot />
	</label>
</template>

<script setup lang="ts">
defineProps<{ title: string }>();
</script>
