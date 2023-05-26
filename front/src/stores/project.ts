import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useProjectStore = defineStore('project', () => {
	const currentProject = ref(null as ProjectData|null);
	const projects = ref([] as ProjectData[]);

	const addNewProject = async (project: ProjectData) => {
		await fetch('http://clean-generator/api/project', {
			method: 'post',
			headers: { 'Content-Type': 'application/json'},
			body: JSON.stringify({
				title: project.title,
				directory: project.directory
			})
		}).then(r => r.json()).then((json: ProjectData[]) => {
			projects.value = json;
		})
		await refresh();
	}

	const setProjectByName = (name: string) => {
		currentProject.value = projects.value.filter(p => p.title === name)[0];
	}

	const deleteProjectByName = (name: string) => {
		fetch('http://clean-generator/api/project', {
			method: 'delete',
			headers: { 'Content-Type': 'application/json'},
			body: JSON.stringify({
				title: projects.value.filter(p => p.title === name)[0].title,
			})
		}).then(r => r.json()).then((json: ProjectData[]) => {
			projects.value = json;
		})
		refresh();
	}

	const refresh = async () => {
		await fetch('http://clean-generator/api/project', {
			method: 'get',
			headers: { 'Content-Type': 'application/json' }
		}).then(r => r.json()).then((json: ProjectData[]) => {
			projects.value = json;
		})
	}

	return { currentProject, projects, addNewProject, setProjectByName, deleteProjectByName, refresh };
})

export interface ProjectData {
	title: string;
	directory: string;
}
