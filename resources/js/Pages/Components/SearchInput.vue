<template>
    <input
        type="text"
        :value="search"
        @input="$emit('update:search', $event.target.value)"
        :placeholder="t('search_placeholder')"
        class="border rounded p-2 w-full"
        aria-label="Search input"
    />
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const props = defineProps({
                              search: {
                                  type: String,
                                  default: '',
                              },
                          })

const { t } = useI18n()
</script>
