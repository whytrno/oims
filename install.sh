sudo chmod -R ugo+rw storage
&& composer install 
&& npm install
&& npm run build
&& cp .env.example .env
&& php artisan key:generate
&& php artisan migrate --seed
&& php artisan storage:link