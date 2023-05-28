<template>
	<div>
		<h2 class="block text-[#606F78] text-2xl mb-1">{{ title }}</h2>
		<hr class="border border-gray-400 mb-3">
		<slot />
	</div>
</template>

<script setup lang="ts">
defineProps<{ title: string }>();
</script>
