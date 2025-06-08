<template>
    <div class="p-6 max-w-6xl mx-auto bg-gray-50 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold mb-4 text-gray-800">{{ t('dog_breeds_title') }}</h1>

        <p class="mb-6 text-gray-600">
            {{ t('identify_breed_info') }}
        </p>

        <button
            @click="showModal = true"
            class="mb-8 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
        >
            {{ t('identify_button')}}
        </button>

        <BreedTable
            :breeds="filteredBreeds"
            :sortKey="sortKey"
            :sortAsc="sortAsc"
            :search="search"
            @sortBy="sortBy"
            @update:search="val => search = val"
        />

        <BreedRecognizerModal v-if="showModal" @close="showModal = false" />
    </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import BreedTable from '../Components/BreedTable.vue'
import BreedRecognizerModal from '../Components/BreedRecognizerModal.vue'

import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const props = defineProps({
                              breeds: {
                                  type: Array,
                                  required: true,
                              },
                          })

const search = ref('')
const sortKey = ref('name')
const sortAsc = ref(true)
const showModal = ref(false)

const sortedBreeds = computed(() =>
                                  [...props.breeds].sort((
                                                             a,
                                                             b
                                                         ) => {
                                      if (a[sortKey.value] < b[sortKey.value]) return sortAsc.value ? -1 : 1
                                      if (a[sortKey.value] > b[sortKey.value]) return sortAsc.value ? 1 : -1
                                      return 0
                                  })
)

const filteredBreeds = computed(() =>
                                    sortedBreeds.value.filter(breed =>
                                                                  breed.name.toLowerCase().includes(search.value.toLowerCase())
                                    )
)

function sortBy(key) {
    if (sortKey.value === key) {
        sortAsc.value = !sortAsc.value
    } else {
        sortKey.value = key
        sortAsc.value = true
    }
}
</script>
