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

### Videografía:
- [App Laravel + Vue CRUD Completo](https://www.youtube.com/watch?v=UzegdHgNEF4&t=1785s)

### Notas:
- No logro hacer funcionar nodejs en el contenedor para lanzar npm run dev de laravel-mix :s
- Despues de lanzar el siguiente comando para eliminar el tracking de **.idea**:
    - `git filter-branch --force --index-filter 'git rm -r --cached --ignore-unmatch ./.idea/' --prune-empty --tag-name-filter cat -- --all`
    - Me aparece lo siguiente:
    ```
    Rewrite afe6b210e5077b0c54c9013a2c83b533d961c83a (78/91) (5 seconds passed, remaining 0 predicted)    
    WARNING: Ref 'refs/heads/master' is unchanged
    WARNING: Ref 'refs/remotes/origin/master' is unchanged
    WARNING: Ref 'refs/remotes/origin/master' is unchanged
    WARNING: Ref 'refs/tags/v0.0.1' is unchanged
    ```
    - Parece que ha funcionado porque ya no veo la carpeta **.idea** en el último commit
- crear migracion de bd existente
    - composer require --dev "xethron/migrations-generator"
    - Error: no tira para laravel 7.26.1
    - php artisan migrate:generate
