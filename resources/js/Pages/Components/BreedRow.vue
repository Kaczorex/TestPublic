<template>
    <tr class="hover:bg-gray-100 transition">
        <td class="py-4 px-6 border-b border-gray-200 font-medium text-gray-800">
            {{ breed.name }}
        </td>
        <td class="py-4 px-6 border-b border-gray-200 text-gray-700">
            {{ breed.weight.metric }}
        </td>
        <td class="py-4 px-6 border-b border-gray-200 text-gray-700">
            {{ breed.height.metric }}
        </td>
        <td class="py-4 px-6 border-b border-gray-200 text-gray-700">
            {{ translatedTemperament }}
        </td>
        <td class="py-4 px-6 border-b border-gray-200">
            <img :src="breed.image?.url" alt="Zdjęcie psa" class="h-16 w-auto rounded" />
        </td>
    </tr>
</template>

<script setup>
import { ref } from 'vue'
import { useTemperamentTranslation } from '../Composables/useTemperamentTranslation.js'

const props = defineProps({
                              breed: {
                                  type: Object,
                                  required: true,
                              },
                          })

const temperamentString = ref(props.breed.temperament || '')
const { translatedTemperament } = useTemperamentTranslation(temperamentString)
</script>
