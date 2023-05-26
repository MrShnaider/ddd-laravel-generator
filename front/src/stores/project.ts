import { ref } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios';

export const useProjectStore = defineStore('project', () => {
	const currentProject = ref(null as ProjectData|null);
	const projects = ref([] as ProjectData[]);

	const addNewProject = async (project: ProjectData) => {
		await axios.post('http://clean-generator/api/project', {
			title: project.title,
			directory: project.directory
		});
		await refresh();
	}

	const setProjectByName = (name: string) => {
		currentProject.value = projects.value.filter(p => p.title === name)[0];
	}

	const deleteProjectByName = async (name: string) => {
		await axios.delete('http://clean-generator/api/project', { data: {
			title: projects.value.filter(p => p.title === name)[0].title,
		}});
		await refresh();
	}

	const refresh = async () => {
		projects.value = (await axios.get<ProjectData[]>('http://clean-generator/api/project')).data;
	}

	return { currentProject, projects, addNewProject, setProjectByName, deleteProjectByName, refresh };
})

export interface ProjectData {
	title: string;
	directory: string;
}
