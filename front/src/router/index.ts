import { createRouter, createWebHistory } from 'vue-router';
import IndexPage from '@/pages/IndexPage.vue';
import CreateEntityPage from '@/pages/CreateEntityPage.vue';
import { useProjectStore } from '@/stores/project';

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			name: 'index',
			component: IndexPage
		},
		{
			path: '/create/entity',
			name: 'create-entity',
			component: CreateEntityPage
		}
	]
});

router.beforeEach((to, from, next) => {
	if (to.query.project) {
		useProjectStore().setProjectByName(to.query.project as string);
	}
	next();
});

export default router;
