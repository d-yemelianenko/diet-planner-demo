# CakePHP Diet Planner – Demo Aplikacji

**Diet Planner** to aplikacja webowa stworzona w ramach pracy inżynierskiej, której celem było opracowanie narzędzia do planowania posiłków z uwzględnieniem indywidualnego zapotrzebowania kalorycznego.

Ten repozytorium zawiera **przykładowy kod źródłowy aplikacji** napisanej w frameworku **CakePHP 4**. Działająca wersja aplikacji jest **prywatna i niedostępna publicznie**, ale poniżej przedstawiono jej funkcjonalności oraz sposób lokalnego uruchomienia.

## Główne funkcje aplikacji

-**System rejestracji i logowania użytkowników**
- ⚖**Obliczanie indywidualnego zapotrzebowania kalorycznego** na podstawie wieku, wzrostu, masy ciała i poziomu aktywności
- **CRUD przepisów** – tworzenie, edycja, usuwanie przepisów
- 👥 **Role użytkowników**:
  - **Admin** – pełen dostęp do zarządzania użytkownikami, przepisami i systemem
  - **User** – dostęp do planowania diety i własnych przepisów
  - **Gość** – ograniczony dostęp tylko do autoryzacji oraz przukładowej strony glównej

## Screenshoty aplikacji

> Poniżej przykładowe zrzuty ekranu działającej aplikacji (wersja prywatna):

![Zrzut ekranu - panel logowania](screenshots/login.png)
![Zrzut ekranu - strona glówna](screenshots/main.png)
![Zrzut ekranu - formularz kalkulatora](screenshots/calculator.png)

### ✅ Wymagania:
- PHP >= 7.4
- Composer
- MySQL lub MariaDB
- CakePHP 4

### Instalacja:

```bash
# Sklonuj repozytorium
git clone https://github.com/d-yemelianenko/diet-planner-demo.git
cd diet-planner-demo

# Zainstaluj zależności
composer install


## Configuration

Read and edit the environment specific `config/app_local.php` and set up the
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.


