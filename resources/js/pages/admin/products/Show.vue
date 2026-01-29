<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import {usePage} from '@inertiajs/vue3'
import AppLayout from "@/layouts/AppLayout.vue";
import type { BreadcrumbItem } from "@/types";
import type { Product } from "@/models/Product";
import { index, show } from '@/routes/admin/products';

const page = usePage()

const productId = Number(page.url.split('/').pop())

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Управление товарами',
        href: index().url,
    },
    {
        title: 'Продукт',
        href: show(productId).url,
    },
];

const id = Number(page.url.split('/').pop())

const product = ref<Product | null>(null)
const loading = ref(true)
const loaded = ref(false)

const fetchItem = async () => {
    try {
        const { data } = await axios.get(`/api/products/${id}`)
        product.value = data.data ?? data
        loaded.value = true
    } finally {
        loading.value = false
    }
}

onMounted(fetchItem)
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6 max-w-4xl mx-auto">
            <div v-if="loading" class="text-gray-500">
                Загрузка...
            </div>

            <div v-else-if="loaded" class="space-y-4">
                <h1 class="text-2xl font-bold">
                    {{ product.name }}
                </h1>

                <div class>
                    Категория: <span class="font-medium">{{ product.category.name }}</span>
                </div>

                <div class="border-t pt-4">
                    Описание:
                    <p class=" whitespace-pre-line">
                        {{ product.description }}
                    </p>
                </div>
                <div class="border-t pt-4">
                    Цена:
                    <p class=" whitespace-pre-line">
                        {{ product.price }}
                    </p>
                </div>
            </div>

            <div v-else class="text-red-500">
                Продукт не найден
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
