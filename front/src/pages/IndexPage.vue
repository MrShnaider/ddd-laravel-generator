<template>
    <div class="min-h-screen bg-[#E9EFF2] grid justify-center items-center">
        <div class="w-[600px] grid gap-7">
            <label>
                <span class="text-[#606F78] text-2xl mb-1">Имя</span>
                <hr class="border border-gray-400">
                <text-input class="mt-3 w-full"/>
            </label>
            <div>
                <span class="text-[#606F78] text-2xl mb-1">Поля</span>
                <hr class="border border-gray-400">
                <div v-for="field in fields" class="mt-3 grid grid-cols-1 items-center" :key="field.id">
                    <div style="grid-column: 1/1; grid-row: 1/1;" class="grid grid-cols-12 gap-3">
                        <text-input class="col-span-8" />
                        <text-input class="col-span-4" />
                    </div>
                    <button @click="removeField(field.id)" style="grid-column: 1/1; grid-row: 1/1;" class="justify-self-end -mr-6">X</button>
                </div>
                <button class="block min-w-full mt-3" @click="addField">
                    <span class="
                        flex justify-center min-w-full py-1 px-2 rounded-lg
                        text-gray-500 border-2 border-gray-300 bg-gray-100
                    ">Добавить поле</span>
                </button>
            </div>
            
            <div class="flex justify-end">
                <button class="bg-[#329CBD] text-[#E5F1FB] shadow-md px-5 py-4 rounded-lg text-xl font-medium">Сгенерировать</button>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import TextInput from '@/components/TextInput.vue';
import { ref } from 'vue';

interface EntityField {
    id: number;
    title: string;
    type: string;
}

const fields = ref<EntityField[]>([]);
let currentFieldId = 1;

const addField = () => {
    fields.value.push({ id: currentFieldId++, title: '', type: ''});
}

const removeField = (id: number) => {
    fields.value = fields.value.filter(field => field.id !== id);
}
</script>
