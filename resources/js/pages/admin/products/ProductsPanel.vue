<script setup lang="ts">
import { ref, watch, onMounted } from 'vue'
import axios from 'axios'
import {Head, router} from '@inertiajs/vue3'
import type { Product } from "@/models/Product";
import type { Category } from "@/models/Category";
import type { Meta } from "@/models/Meta";
import type { PaginatedResponse } from "@/models/PaginatedResponse";
import type { BreadcrumbItem } from "@/types";
import { index } from '@/routes/admin/products';
import AppLayout from "@/layouts/AppLayout.vue";

const products = ref<Product[]>([])
const categories = ref<Category[]>([])
const meta = ref<Meta>
const page = ref(1)
const selectedCategory = ref('')
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Управление товарами',
        href: index().url,
    },
];

const fetchProducts = async () => {
    const { data } = await axios.get<PaginatedResponse<Product>>('/api/products', {
        params: {
            page: page.value,
            search: selectedCategory.value,
        }
    })

    products.value = data.data
    meta.value = data.meta
}

const fetchCategories = async () => {
    const { data } = await axios.get('/api/categories')
    categories.value = data
}

watch([page, selectedCategory], fetchProducts, { immediate: true })

const goToDetail = (id: number) => {
    router.get(`/admin/products/${id}`, )
}

const goToCreate = () => {
    router.get('/admin/products/create', )
}

onMounted(fetchCategories)
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Продукты</h1>

            <div class="mb-4 flex items-center gap-4">
                <label class="font-medium">Категория:</label>
                <select v-model="selectedCategory" @change="page = 1"
                        class="border rounded px-2 py-1 bg-background">
                    <option value="">Все</option>
                    <option v-for="cat in categories.data" :key="cat.id" :value="cat.id">
                        {{ cat.name }}
                    </option>
                </select>
            </div>
            <div class="mb-4 flex items-center gap-4">
                <button class="px-3 py-1 border rounded hover:bg-gray-600 cursor-pointer"
                        @click="goToCreate">Добавить товар</button>
            </div>

            <table class="w-full table-auto border-collapse border">
                <thead class="bg-light-subtle">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Название</th>
                    <th class="border px-4 py-2">Категория</th>
                    <th class="border px-4 py-2">Описание</th>
                    <th class="border px-4 py-2">Цена</th>
                    <th class="border px-4 py-2">Действия</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id"
                    class="hover:bg-gray-600 cursor-pointer"
                    @click="goToDetail(product.id)">
                    <td class="border px-4 py-2">{{ product.id }}</td>
                    <td class="border px-4 py-2">{{ product.name }}</td>
                    <td class="border px-4 py-2">{{ product.category.name }}</td>
                    <td class="border px-4 py-2">{{ product.description }}</td>
                    <td class="border px-4 py-2">{{ product.price }}</td>
                    <td class="border px-4 py-2">{{ product.price }}</td>

                </tr>
                </tbody>
            </table>

            <div class="mt-4 flex justify-between items-center">
                <button class="px-3 py-1 border rounded hover:bg-gray-600 cursor-pointer"
                        :disabled="meta.value.current_page === 1"
                        @click="page--">Предыдущая</button>
                <span>{{ meta.value.current_page }} / {{ meta.value.last_page }}</span>

                <button class="px-3 py-1 border rounded hover:bg-gray-600 cursor-pointer"
                        :disabled="meta.value.current_page === meta.value.last_page"
                        @click="page++">Следующая</button>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
