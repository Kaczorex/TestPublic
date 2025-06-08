import { createI18n } from 'vue-i18n'

const messages = {
	pl: {
		dog_breeds_title: 'Rasy psów',
		identify_breed_info: 'Możesz też rozpoznać rasę psa za pomocą zdjęcia.',
		identify_button: 'Rozpoznaj rasę po zdjęciu',
		weight_kg: 'Waga (kg)',
		height_cm: 'Wzrost (cm)',
		temperament: 'Temperament',
		photo: 'Zdjęcie',
		search_placeholder: 'Szukaj...',
		no_results: 'Brak wyników',
		name: 'Nazwa',
		identify_dog_breed_title: 'Rozpoznaj rasę psa',
		recognizing: 'Rozpoznawanie...',
		identify_breed: 'Rozpoznaj rasę',
		recognized_breed: 'Rozpoznana rasa:',
		select_file_error: 'Proszę wybrać plik.',
		recognize_fail: 'Nie udało się rozpoznać rasy.',
		connection_error: 'Błąd połączenia z serwerem.',
		unknown_error: 'Nieznany błąd',

	},
	en: {
		dog_breeds_title: 'Dog Breeds',
		identify_breed_info: 'You can also identify a dog breed by photo.',
		identify_button: 'Identify breed by photo',
		weight_kg: 'Weight (kg)',
		height_cm: 'Height (cm)',
		temperament: 'Temperament',
		photo: 'Photo',
		search_placeholder: 'Search...',
		no_results: 'No results',
		name: 'Name',
		identify_dog_breed_title: 'Identify Dog Breed',
		recognized_breed: 'Recognized breed:',
		recognizing: 'Recognizing...',
		identify_breed: 'Identify breed',
		select_file_error: 'Please select a file.',
		recognize_fail: 'Failed to identify breed.',
		connection_error: 'Connection error.',
		unknown_error: 'Unknown error',
	},
}

export const i18n = createI18n({
    legacy: false,
    locale: 'pl',
    fallbackLocale: 'en',
    messages,
})
