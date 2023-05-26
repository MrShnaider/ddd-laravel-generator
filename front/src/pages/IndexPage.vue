<template>
	<div class="min-h-screen grid justify-center items-center">
		<div class="w-[800px] grid gap-10">
			<field-with-title title="Новый проект">
				<div class="grid grid-cols-10 gap-3">
					<text-input placeholder="Название проекта" v-model:text="newProjectData.title" class="col-span-3" />
					<text-input placeholder="Директория генерации" v-model:text="newProjectData.directory" class="col-span-5" />
					<primary-button @click="addNewProject" class="col-span-2">Создать</primary-button>
				</div>
			</field-with-title>
			<field-with-title v-if="projectStore.projects.length > 0" title="Выбрать проект">
				<ul>
					<li v-for="project in projectStore.projects" class="grid grid-cols-1 grid-rows-1" :key="project.title">
						<router-link :to="{ name: 'create-entity', query: { project: project.title } }" class="
							col-[1/2] row-[1/2]
							grid grid-cols-10 items-baseline px-4 py-3 rounded-lg
							transition-all cursor-pointer
							hover:bg-white hover:shadow-md hover:translate-x-1
							focus-visible:bg-white focus-visible:shadow-md focus-visible:translate-x-1
						">
							<h2 class="col-span-3 font-semibold text-2xl text-gray-500 uppercase">{{ project.title }}</h2>
							<p class="col-span-5 text-gray-500">{{ project.directory }}</p>
						</router-link>
						<button
							@click="projectStore.deleteProjectByName(project.title)"
							class="col-[1/2] row-[1/2] justify-self-end relative left-8 p-2 text-gray-500"
						>{{ 'X' }}</button>
					</li>
				</ul>
			</field-with-title>
		</div>
	</div>
</template>

<script setup lang="ts">
import { useProjectStore, type ProjectData } from '@/stores/project';
import TextInput from '@/components/TextInput.vue';
import FieldWithTitle from '@/components/FieldWithTitle.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { reactive } from 'vue';

const projectStore = useProjectStore();
const newProjectData = reactive<ProjectData>({
	title: '',
	directory: ''
});
const addNewProject = () => {
	if (newProjectData.title === '' || newProjectData.directory === '')
		return;
	projectStore.addNewProject({ ...newProjectData });
	newProjectData.title = '';
	newProjectData.directory = '';
}
</script>
