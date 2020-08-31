### Laravel Framework 7.26.1
- En este punto ya se ejecuta laravel en docker:
    - [http://localhost:400/](http://localhost:400/)
- Logs:
    - docker logs sf-eduardoaf-be --tail 10

### To-Do:
- Cambiar make be-logs ya que no exist var/log/dev.log

### Errores:
- Me da `500 Server Error` en docker
    - He probado composer self-update. Nada
    - Faltaba archivo .env
- Class 'Reliese\Coders\CodersServiceProvider' not found
    - Faltaba sincronizar, ejecutar composer update en el contenedor    

### Comandos:
```js
composer require laravel/ui
php artisan ui vue --auth
```
- Rutas de --auth: 
    - /vendor/laravel/ui/src/AuthRouteMethods.php
