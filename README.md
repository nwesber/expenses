# Installation

##### Laravel Dependencies
1. composer install
2. npm install && npm run dev
3. php artisan migrate --seed
4. php artisan optimize

##### API Dependencies
1. php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
2. php artisan jwt:secret