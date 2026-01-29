<script setup lang="ts">
defineProps<{
    show: boolean
    title?: string
    message?: string
    confirmText?: string
    cancelText?: string
}>()

const emit = defineEmits<{
    (e: 'confirm'): void
    (e: 'cancel'): void
}>()
</script>

<template>
    <div
        v-if="show"
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <div
            class="absolute inset-0 bg-black/70"
            @click="$emit('cancel')"
        />

        <div
            class="relative z-10 w-full max-w-sm rounded-xl bg-gray-900 border border-gray-700 p-6 shadow-xl"
        >
            <h2 class="text-lg font-semibold text-gray-100 mb-2">
                {{ title ?? 'Подтвердите действие' }}
            </h2>

            <p class="text-sm text-gray-300 mb-6">
                {{ message ?? 'Вы уверены что хотите продолжить?' }}
            </p>

            <div class="flex justify-end gap-3">
                <button
                    @click="$emit('cancel')"
                    class="px-4 py-2 rounded-md bg-gray-700 text-gray-200 hover:bg-gray-600"
                >
                    {{ cancelText ?? 'Отмена' }}
                </button>

                <button
                    @click="$emit('confirm')"
                    class="px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700"
                >
                    {{ confirmText ?? 'Подтвердить' }}
                </button>
            </div>
        </div>
    </div>
</template>
