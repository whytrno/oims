sudo chmod -R ugo+rw storage
&& composer install 
&& npm install
&& npm run build
&& php artisan key:generate
&& php artisan migrate --seed