
<!-- ABOUT THE PROJECT -->
## Introduction
A client has asked for an application capable of reporting 5 day weather forecasts. </br>
It will require a web UI with a dropdown to select from a list of cities which would then render the forecast. </br>
Additionally, a report needs to be prepared which can be automatically generated each day. </br>
 
 <p>Summary</br>
 This project use API from https://www.weatherbit.io/api to request data.
 
 #### 1. Web Application
 
 - Single Page, no authentication required
 
 - List of 3 cities is fixed
 
 - Changing city, request data from API, render table.
 
 - If no city is selected, table display text "No city selected"
 
 #### 2. Console Command
 
 - List of cities must be separated by space. In another case, if city name is "New York", it should be changed to "New_York"
 
 - If there is no city, a prompt will ask for cities

### Built With
* [![Laravel][Laravel.com]][Laravel-url]
* [![Vue][Vue.com]][Vue-url]
* [![TailwindCss][Tailwindcss.com]][Tailwind-url]

### Installation

1. Clone the repo
   ```sh
   git clone git@github.com:nganlong0510/R6-test.git
   ```
2. Jump in folder cloned
   ```sh
   cd R6-test/
   ```
3. Composer install
   ```sh
   composer install
   ```
4. Install packages
    ```sh
    npm install
    ```
5. Create `.env` file (can copy from .env.example). Insert 2 keys to the file created, you can change the value of API Key
    ```sh
    WEATHER_API_KEY='123563ccd90c45388c2a94ca10ea914a'
    VITE_WEATHER_API_KEY='123563ccd90c45388c2a94ca10ea914a'
    ```
6. Generate app key
    ```sh
    php artisan key:generate
    ```
7. Run command to compile assets
    ```sh
    npm run dev
    ```
8. Keep the terminal running, open a new terminal tab and run
   ```sh
    php artisan serve
    ```
9. Open browser and use link to open web application
    ```sh
    http://localhost:8000/
    ```
10. To execute console command, open a new terminal and run command. **Note: cities must be separated by space, if city name has 2 words, it must be separated by "_" like "New_York", "Gold_Coast", or "Sunshine_Coast"
    ```sh
    php artisan forecast Brisbane Gold_Coast Sunshine_Coast
    ```
    OR
    ```sh
    php artisan forecast
    > Enter cities (separated by space): Brisbane Gold_Coast Sunshine_Coast
    ```

<!-- CONTACT -->
## Contact

Long Ngan Nguyen - nganlong0510@gmail.com - 0450490510

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Tailwindcss.com]: https://img.shields.io/badge/TailwindCss-563D7C?style=for-the-badge&logo=TailwindCss&logoColor=blue
[Tailwind-url]:https://tailwindcss.com/
[Vue.com]: https://img.shields.io/badge/VueJs-32a852?style=for-the-badge&logo=VueJs&logoColor=green
[Vue-url]: https://vuejs.org/
