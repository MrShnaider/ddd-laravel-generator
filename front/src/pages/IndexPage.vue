<template>
    <div class="min-h-screen bg-[#E9EFF2] grid justify-center items-center">
        <div class="w-[600px] grid gap-7">
            <field-with-title title="Проект">
                <text-input v-model:text="project.basePath" class="mt-3 w-full"/>
            </field-with-title>
			<field-with-title title="Имя">
                <text-input v-model:text="entityName" class="mt-3 w-full"/>
            </field-with-title>
            <div>
				<field-with-title title="Поля">
					<div v-for="field in fields" class="mt-3 grid grid-cols-1 items-center" :key="field.id">
                    <div style="grid-column: 1/1; grid-row: 1/1;" class="grid grid-cols-12 gap-3">
                        <text-input v-model:text="field.title" class="col-span-8" />
                        <text-input v-model:text="field.type" class="col-span-4" />
                    </div>
                    <button @click="removeField(field.id)" style="grid-column: 1/1; grid-row: 1/1;" class="justify-self-end -mr-6">X</button>
                </div>
            	</field-with-title>
                <button class="block min-w-full mt-3" @click="addField">
                    <span class="
                        flex justify-center min-w-full py-1 px-2 rounded-lg
                        text-gray-500 border-2 border-gray-300 bg-gray-100
                    ">Добавить поле</span>
                </button>
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

const project = useProjectStore();

interface EntityField {
    id: number;
    title: string;
    type: string;
}

const fields = ref<EntityField[]>([]);
let currentFieldId = 1;
const entityName = ref('');

const addField = () => {
    fields.value.push({ id: currentFieldId++, title: '', type: ''});
}

const removeField = (id: number) => {
    fields.value = fields.value.filter(field => field.id !== id);
}

const createNewEntity = async () => {
    const json = await fetch('http://127.0.0.1:8000/api/entity/create', {
        method: 'post',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify({
            root_directory: project.basePath,
            entity_name: entityName.value
        })
    }).then((r: Response) => r.json());
    console.log(json);
}
</script>
