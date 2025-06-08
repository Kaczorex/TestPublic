<template>
    <transition name="fade">
        <div
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @keydown.esc.window="close"
        >
            <div
                class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative"
                @click.stop
            >
                <button
                    @click="close"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                    aria-label="Close modal"
                >
                    ✕
                </button>

                <h2 class="text-2xl font-semibold mb-4">{{ t('identify_dog_breed_title') }}</h2>

                <form @submit.prevent="submit" class="space-y-4" novalidate>
                    <input
                        type="file"
                        accept="image/*"
                        @change="onFileChange"
                        :disabled="loading"
                        class="block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4
                   file:rounded file:border-0
                   file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700
                   hover:file:bg-blue-100"
                        required
                    />

                    <button
                        type="submit"
                        :disabled="loading || !file"
                        class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50 transition"
                    >
                        {{ loading ? t('recognizing') : t('identify_breed') }}
                    </button>

                </form>

                <div
                    v-if="breed"
                    class="mt-4 p-3 bg-green-100 text-green-800 rounded break-words"
                >
                    <strong>{{ t('recognized_breed') }}</strong> {{ breed }}
                </div>

                <div v-if="error" class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                    {{ error }}
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref } from 'vue'
import { identifyBreedByImage } from '../Api/dogBreedApi'

import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const emit = defineEmits(['close'])

const file = ref(null)
const breed = ref('')
const error = ref('')
const loading = ref(false)

function close() {
    file.value = null
    breed.value = ''
    error.value = ''
    loading.value = false
    emit('close')
}

function onFileChange(event) {
    breed.value = ''
    error.value = ''
    file.value = event.target.files[0] || null
}

async function submit() {
    if (!file.value) {
        error.value = t('select_file_error')
        return
    }

    loading.value = true
    breed.value = ''
    error.value = ''

    try {
        const result = await identifyBreedByImage(file.value)
        if (result) {
            breed.value = result
        } else {
            error.value = t('recognize_fail')
        }
    } catch (e) {
        if (e.message && e.message !== '') {
            error.value = e.message
        } else {
            error.value = t('connection_error')
        }
    } finally {
        loading.value = false
    }
}


</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
