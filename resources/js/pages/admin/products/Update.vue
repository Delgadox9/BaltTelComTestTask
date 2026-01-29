<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AppLayout from "@/layouts/AppLayout.vue";
import type { BreadcrumbItem } from "@/types";
import type { Product } from "@/models/Product";
import type { Category } from "@/models/Category";
import { index, edit } from '@/routes/admin/products';
import ProductForm from "@/pages/admin/products/ProductForm.vue";
import { router, usePage } from "@inertiajs/vue3";

const page = usePage();
const loading = ref(true);
const loaded = ref(false);
const categories = ref<Category[]>([]);
const product = ref<Product | null>(null);
const productId = Number(page.url.split('/').pop())

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Управление товарами',
        href: index().url,
    },
    {
        title: 'Обновление товара',
        href: edit(productId).url,
    },
];

const api = axios.create({
    baseURL: 'http://localhost:80',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'Accept': 'application/json',
    },
});

const submit = async (data: any) => {
    try {
        const response = await api.put(`/api/products/${data.id}`, {
            'name': data.name,
            'description': data.description,
            'price': data.price,
            'category_id': data.category.id,
        });

        router.visit('/admin/products/'+response.data.data.id);
    } catch (error: any) {
        if (error.response?.status === 422) {
            console.log('Ошибки валидации', error.response.data.errors);
        }
    }
}

const fetchCategories = async () => {
    try {
        const { data } = await axios.get('/api/categories');
        categories.value = data;
        loaded.value = true;
    } finally {
        loading.value = false
    }
}

const fetchItem = async () => {
    try {
        const { data } = await axios.get(`/api/products/${productId}`)
        product.value = data.data ?? data
        loaded.value = true
    } finally {
        loading.value = false
    }
}

onMounted(fetchCategories);
onMounted(fetchItem);
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w-4xl mx-auto">
            <div v-if="loading" class="text-gray-500">
                Загрузка...
            </div>

            <div v-else-if="loaded" class="space-y-4">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-4">Создать товар</h1>

                    <ProductForm
                        :modelValue="{
                            id: product.id,
                            name: product.name,
                            description: product.description,
                            price: product.price,
                            category: product.category
                        }"
                        :categories="categories"
                        :submitLabel="Создать"
                        @submit="submit"
                    />
                </div>
            </div>

            <div v-else class="text-red-500">
                Категории не найдены
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
