import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useProjectStore = defineStore('project', () => {
	const currentProject = ref(null as ProjectData|null);
	const projects = ref([] as ProjectData[]);

	const addNewProject = (project: ProjectData) => {
		projects.value.push(project);
	}

	const setProjectByName = (name: string) => {
		currentProject.value = projects.value.filter(p => p.title === name)[0];
	}

	const deleteProjectByName = (name: string) => {
		projects.value = projects.value.filter(p => p.title !== name);
	}

	return { currentProject, projects, addNewProject, setProjectByName, deleteProjectByName };
})

export interface ProjectData {
	title: string;
	directory: string;
}
