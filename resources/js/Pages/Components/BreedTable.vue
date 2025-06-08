<template>
    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-blue-600 text-white select-none">
        <tr>
            <th class="px-4 py-2 cursor-pointer" @click="$emit('sortBy', 'name')">
                {{ t('name') }}
                {{ sortAsc ? '▲' : '▼' }}
                <input
                    :value="search"
                    class="ml-2 border rounded px-2 py-1"
                    :placeholder="t('search_placeholder')"
                    type="text"
                    @input="$emit('update:search', $event.target.value)"
                />
                <span v-if="sortKey === 'name'">
                </span>
            </th>
            <th class="py-3 px-6">{{ t('weight_kg') }}</th>
            <th class="py-3 px-6">{{ t('height_cm') }}</th>
            <th class="py-3 px-6">{{ t('temperament') }}</th>
            <th class="py-3 px-6">{{ t('photo') }}</th>
        </tr>
        </thead>
        <tbody>
        <BreedRow
            v-for="breed in breeds"
            :key="breed.id"
            :breed="breed"
        />
        <tr v-if="breeds.length === 0">
            <td class="text-center py-8 text-gray-500 font-semibold" colspan="5">
                {{ t('no_results') }}
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script setup>
import BreedRow from './BreedRow.vue';
import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const props = defineProps({
                              breeds: {
                                  type: Array,
                                  required: true,
                              },
                              sortKey: {
                                  type: String,
                                  required: true,
                              },
                              sortAsc: {
                                  type: Boolean,
                                  required: true,
                              },
                              search: {
                                  type:String,
                                  required: false
                              },
                          });
</script>