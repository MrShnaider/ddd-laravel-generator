<template>
	<label>
		<span class="text-[#606F78] text-2xl mb-1">{{ title }}</span>
		<hr class="border border-gray-400">
		<slot />
	</label>
</template>

<script setup lang="ts">
defineProps<{ title: string }>();
</script>
