import { i18n } from '@/i18n'

export async function identifyBreedByImage(file) {
	const formData = new FormData()
	formData.append('image', file)

	const response = await fetch('/api/dog-breed/identify', {
		method: 'POST',
		body: formData,
	})

	if (!response.ok) {
		const errorData = await response.json().catch(() => ({}))

		let errorMessage = i18n.global.t('unknown_error')

		if (errorData.errors) {
			const messages = Object.values(errorData.errors).flat()
			if (messages.length > 0) {
				errorMessage = messages.join(' ')
			}
		} else if (errorData.error) {
			errorMessage = errorData.error
		}

		throw new Error(errorMessage)
	}

	const data = await response.json()
	return data.breed || null
}
