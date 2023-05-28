<template>
	<div class="min-h-screen grid justify-center items-center">
		<div class="w-[600px] grid gap-7">
			<field-with-title title="Имя">
				<text-input v-model:text="entityName" class="w-full" />
			</field-with-title>
			<div>
				<field-with-title title="Поля">
					<div class="grid gap-1">
						<div v-for="field in fields" class="grid grid-cols-1 items-center" :key="field.id">
							<div style="grid-column: 1/1; grid-row: 1/1;" class="grid grid-cols-12 gap-3">
								<text-input v-model:text="field.title" class="col-span-8" v-focus />
								<text-input v-model:text="field.type" @keyup.enter="addField" class="col-span-4" />
							</div>
							<button
								@click="removeField(field.id)"
								style="grid-column: 1/1; grid-row: 1/1;"
								class="justify-self-end -mr-6"
							>X</button>
						</div>
						<button class="block min-w-full" @click="addField">
							<span class="
								flex justify-center min-w-full py-1 px-2 rounded-lg
								text-gray-500 border-2 border-gray-300 bg-gray-100
							">Добавить поле</span>
						</button>
					</div>
				</field-with-title>
			</div>
			<div class="flex justify-end">
				<primary-button @click="createNewEntity">Сгенерировать</primary-button>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">
import TextInput from '@/components/TextInput.vue';
import FieldWithTitle from '@/components/FieldWithTitle.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { useProjectStore } from '@/stores/project';
import { ref } from 'vue';
import axios from 'axios';

const project = useProjectStore();

interface EntityField {
	id: number;
	title: string;
	type: string;
}

const fields = ref<EntityField[]>([]);
let currentFieldId = 1;
const entityName = ref('');
const vFocus = {
	mounted: (el: HTMLInputElement) => el.focus()
}

const addField = () => {
	fields.value.push({ id: currentFieldId++, title: '', type: '' });
}

const removeField = (id: number) => {
	fields.value = fields.value.filter(field => field.id !== id);
}

const createNewEntity = async () => {
	const allFieldsAreFilled = fields.value.reduce((allPrevAreFilled, field) => allPrevAreFilled && field.title !== '' && field.type !== '', true);
	if (!allFieldsAreFilled || entityName.value === '') {
		alert('Не все поля заполнены');
		return;
	}
	await axios.post('http://clean-generator/api/entity/create', {
		root_directory: project.currentProject?.directory,
		entity_name: entityName.value,
		fields: fields.value,
	});
	alert('Сущность ' + entityName.value + ' сгенерирована');
	entityName.value = '';
	fields.value = [];
}
</script>
