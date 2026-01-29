<script setup lang="ts">
import { reactive, computed } from 'vue'
import type { Product } from "@/models/Product";
import type { Category } from "@/models/Category";

const props = defineProps<{
    modelValue: Product
    categories: Category[]
    errors?: Record<string, string>
    submitLabel: string
}>()

const emit = defineEmits<{
    (e: 'submit', data: Product): void
}>()

const form = reactive({ ...props.modelValue })

const errors = computed(() => ({
    name: form.name && form.name.trim().length === 0 ? 'Поле названия обязательное' : null,
    category: form.category && form.category.name ? 'Поле категория обязательное' : null,
    price:
        form.price === null || form.price < 0
            ? 'Поле цена обязательное и должно быть больше 0'
            : null,
}))

const isValid = computed(() => {
    return (
        form.name !== null && form.name.trim().length > 0 &&
        form.price !== null && form.price >= 0 &&
        form.category !== null
    )
})

const submit = () => {
    if (!isValid.value) return
    emit('submit', form)
}
</script>

<template>
    <div
        class="max-w-xl rounded-xl border border-gray-700 p-6 shadow-lg"
    >
        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Название
                </label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100
                 focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="errors.name" class="mt-1 text-sm text-red-400">
                    {{ errors.name }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Описание
                </label>
                <textarea
                    v-model="form.description"
                    rows="4"
                    class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100
                 focus:border-indigo-500 focus:ring-indigo-500"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Цена
                </label>
                <input
                    v-model.number="form.price"
                    type="number"
                    min="0"
                    step="1"
                    inputmode="numeric"
                    class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100
                 focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="errors.price" class="mt-1 text-sm text-red-400">
                    {{ errors.price }}
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Категория
                </label>
                <select
                    v-model="form.category"
                    class="w-full rounded-md border border-gray-700 bg-gray-800 text-gray-100
                 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option :value="null" disabled>Выберите категорию</option>
                    <option v-for="c in categories.data" :key="c.id" :value="c.id">
                        {{ c.name }}
                    </option>
                </select>
                <p v-if="errors.category" class="mt-1 text-sm text-red-400">
                    {{ errors.category }}
                </p>
            </div>

            <div class="flex justify-end">
                <button
                    type="submit"
                    :disabled="!isValid"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2
                 font-medium text-white hover:bg-indigo-700
                 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ submitLabel ?? 'Сохранить' }}
                </button>
            </div>
        </form>
    </div>
</template>

<style scoped>

</style>
