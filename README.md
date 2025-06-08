
## Opis
Aplikacja Laravel + Vue3 + Inertia.js integrująca się z publicznym API theDogApi, demonstrująca wzorce Repository i Service Layer oraz nowoczesny frontend z TailwindCSS.

## Technologie
- Laravel 10
- Vue3 + Inertia.js
- TailwindCSS
- Wzorce projektowe: Repository Pattern, Service Layer

## Funkcjonalności
- Pobieranie i cache’owanie danych z theDogApi
- Wyświetlanie tabeli ras psów z filtrowaniem i sortowaniem po stronie frontendu
- Modal do rozpoznawania rasy na podstawie zdjęcia
- Obsługa błędów i logowanie

## Instalacja
- Stworzyć na podstawie .env.example .env
- Wystarczy dodać Client Id oraz Client Secret https://www.nyckel.com/console/security oraz klucz z https://thedogapi.com/ do .env 
- wejść w folder i wpisać `make start`

# 1. Wzorce projektowe zastosowane w Twoim projekcie

## a) Repository Pattern

- Mamy wyraźną warstwę repozytorium (`DogBreedApiRepository`), która odpowiada za komunikację z zewnętrznym API (theDogApi).
- Repozytorium izoluje dostęp do danych (API + cache + obsługa błędów).
- Dzięki interfejsowi (`DogBreedRepositoryInterface`) możesz łatwo podmienić implementację repozytorium, np. na inne API lub mock do testów.

## b) Service Layer Pattern

- Serwis (`DogBreedService`) odpowiada za logikę biznesową — filtrowanie, sortowanie, przygotowanie danych do użycia.
- Serwis korzysta z repozytorium przez interfejs, więc jest luźno powiązany z warstwą dostępu do danych.
- Umożliwia łatwe dodawanie nowych reguł biznesowych bez modyfikacji repozytorium.

## c) Component-based UI (Vue3)

- UI jest zbudowane w oparciu o komponenty (`Index.vue`, `BreedTable.vue`, `SearchInput.vue` itp).
- Komponenty komunikują się przez propsy i eventy — co odpowiada wzorcowi Presentation Model / MVVM.
- Filtrowanie i sortowanie w Vue (frontend) zapewnia responsywność.

## d) Inertia.js jako mediator

- Łączy frontend (Vue) z backendem (Laravel) bez pełnych przeładowań stron.
- Pozwala na budowę nowoczesnych SPA bez konieczności pisania REST API i oddzielnego frontendowego routera.

---

# 2. Profity (korzyści) z takiego podejścia

## a) Separation of Concerns (Rozdzielenie odpowiedzialności)

- Repozytorium i serwis mają jasno oddzielone zadania — co ułatwia rozwój, testowanie i utrzymanie.
- Frontend jest oddzielony od backendu, ale łatwo ze sobą współpracują dzięki Inertia.

## b) Łatwość testowania

- Możesz testować repozytorium i serwis osobno, mockując warstwę niższą.
- Frontend można testować niezależnie, mając kontrolę nad danymi przekazywanymi przez backend.

## c) Skalowalność

- Dodanie kolejnych API lub zmiana źródła danych jest prosta — wystarczy stworzyć nowe repozytorium implementujące interfejs.
- Logika biznesowa w serwisie nie wymaga zmian, jeśli zmienia się sposób pobierania danych.

## d) Responsywność i UX

- Filtrowanie i sortowanie na froncie działa od razu, bez opóźnień związanych z requestami do backendu.
- Wyszukiwarka w nagłówku tabeli to naturalne i wygodne miejsce dla użytkownika.

## e) Utrzymanie czystości kodu

- Jasna organizacja folderów i plików zgodna z konwencjami Laravel i najlepszymi praktykami PHP.
- Czytelny kod i modularność ułatwiają dalszy rozwój i onboarding nowych programistów.
