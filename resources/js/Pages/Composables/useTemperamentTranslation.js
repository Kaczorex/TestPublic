import { computed } from 'vue'
import { useI18n } from 'vue-i18n'
import temperaments from '../../i18n/temperaments.js'

export function useTemperamentTranslation(temperamentString) {
	const { locale } = useI18n()

	const translatedTemperament = computed(() => {
		if (!temperamentString.value) return ''

		const lang = locale.value || 'pl'
		const keys = temperamentString.value.split(',').map(t => t.trim().toLowerCase())
		const translated = keys.map(key => temperaments[key]?.[lang] || key)

		return translated.join(', ')
	})

	return {
		translatedTemperament,
	}
}
