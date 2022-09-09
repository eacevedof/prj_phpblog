- antes de migrar a laravel 8

### Laravel Framework 7.26.1
- En este punto ya se ejecuta laravel en docker:
    - [http://localhost:400/](http://localhost:400/)
- Logs:
    - docker logs lv-eduardoaf-be --tail 10
- integracion:
    - **`cd ~/projects/prj_python37/integrator; py main.py`**
    
### Dependencias:
- Instalación en dockerfile de Ghostscript (comando gs)
- `RUN apt-get install -y ghostscript`    

### To-Do:
- historial de horas con alarma
- ~publish_date sin 00:00~
- ~Mejora de hashtags~
- ~Replace de codelan por data-enlighter-language~
- marcar como importante
- botón marcar para revision
- permitir cuestionario a la inversa
- Crear contador de palabras en PostUpdate.vue
- Crear buscador de imágenes en UploadIndex.vue
- Buscador en web
- Cambiar make be-logs ya que no exist var/log/dev.log
- crear listado de preguntas en culumna lateral
- permitir seleccionar rango de preguntas, para que se repitan en random
- guardar historico de resultados para poder seleccionar preguntas más dificiles
- permitir marcar revision de preguntas mal formadas o respuestas incorrectas
- en back permitir en el buscador de subjects que lo haga tambien en todos sus contendidos
- crear buscador general para personalizar cuestionario
- mostrar un loading... cuando se carga la app
- agregar tipo "expresion"
- corregir error: `openssl_encrypt(): A tag should be provided when using AEAD mode` para method aes-128-gcm

### Comandos:
```js
composer require laravel/ui
php artisan ui vue --auth

//crear usuario
php artisan db:seed --class=UsersTableSeeder

//tests:
php ./vendor/bin/phpunit

//si los tests fallan por Container/container.php 879
//hay que configurar .env apuntando a 127.. (no a localhost) y ejecutar
php artisan config:clear

/usr/bin/php8.1-cli artisan config:clear
```
- Para compilar las vistas se ejecuta `npm run dev` y se debería ver algo como:
  - ![](https://resources.theframework.es/eduardoaf.com/20211023/175945-npm-run-dev.png)
- Rutas de --auth: 
    - /vendor/laravel/ui/src/AuthRouteMethods.php
- Crear migraciones a partir de la bd
    - `php artisan migrate:generate app_language,app_subject,app_sentence,app_sentence_images,app_sentence_tags,app_sentence_tr`
- Generar modelos:
```sys
# crea los modelos con un comentario en la cabecera "reliese models"
php artisan vendor:publish --tag=reliese-models
php artisan code:models
```

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
    - instalo: https://github.com/oscarafdev/migrations-generator
    - salta excepcion de pdo por la bd. Tema de docker. cambio .env
    - php artisan migrate:generate Va ok
- Creo recursos para API
    - Route::apiResource("api/post","Api\PostController");
    - php artisan make:controller Api/PostController --api
- Creo seeder    
    - php artisan make:seeder UsersTableSeeder
    - configuro el seeder
    - lo ejecuto: php artisan db:seed no ha hecho nada
    - Error: Class 'UserTableSeeder' does not exist - Laravel 5.0 [php artisan db:seed]
        - composer dumpautoload
        - php artisan db:seed --class=UsersTableSeeder
- Problema con PUT y el token
    - Error 419 status unknown
    - No llegaban los datos con PUT porque los enviaba como formulario y deben ser como JSON    
- No me cargaba el id de usuario en el constructor del controlador. Los middlewares de autenticación se ejecutan despues de los constructores

## Errores:
- Me da `500 Server Error` en docker
    - He probado composer self-update. Nada
    - Faltaba archivo .env
- Class 'Reliese\Coders\CodersServiceProvider' not found
    - Faltaba sincronizar, ejecutar composer update en el contenedor    

- **error**
    ```
    php artisan db:seed --class=AppPostSeeder
    Illuminate\Contracts\Container\BindingResolutionException 
    ```
    - No estaba sincronizado bien con el contenedor. Cambiando la bd en host local tiraba. make restart lo soluciona
- **error deploy**
    - me daba error 500 al navegar por rutas en test, puse logs ionoslog.php y no capturaba nada, descubrí que era el .htacces ya 
    que puse die en index.php mientras navegaba y saltab el error. No llegaba ni a imprimir.
    - En htacces hay que agregar **rewritebase**
    ```
    <IfModule mod_rewrite.c>
      RewriteBase /
      <IfModule mod_negotiation.c>
    ```
- **error email**
```
Connection could not be established with host smtp.googlemail.com :stream_socket_client(): 
SSL operation failed with code 1. OpenSSL Error messages: error:1408F10B:SSL routines:ssl3_get_record:wrong version number
```
- No estaba pasando MAIL_USERNAME correctamente. Debía ser el corre completo MAIL_USERNAME=<username>@gmail.com
```
Swift_TransportException
Failed to authenticate on SMTP server with username "<some-mail>@gmail.com" using 3 possible authenticators. 

Authenticator LOGIN returned Expected response code 235 but got code "535", with message "535-5.7.8 Username and Password not accepted. 
Learn more at 535 5.7.8 https://support.google.com/mail/?p=BadCredentials b1sm19295328wru.54 - gsmtp". 

Authenticator PLAIN returned Expected response code 235 but got code "535", with message "535-5.7.8 Username and Password not accepted. 
Learn more at535 5.7.8 https://support.google.com/mail/?p=BadCredentials b1sm19295328wru.54 - gsmtp". 

Authenticator XOAUTH2 returned Expected response code 250 but got code "535", with message "535-5.7.8 Username and Password not accepted. 
Learn more at 535 5.7.8 https://support.google.com/mail/?p=BadCredentials b1sm19295328wru.54 - gsmtp".
```
- faltaba habilitar https://myaccount.google.com/u/0/lesssecureapps?pli=1
- Es obligatorio: MAIL_FROM_ADDRESS=noreply@eduardoaf.com
****
**error**
```
Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
The GET method is not supported for this route. Supported methods: POST.
```
- hay que tratarloe en app/Exceptions/Handler.php
```php
///app/Exceptions/Handler.php
public function render($request, Throwable $exception)
{
    if($exception instanceof MethodNotAllowedHttpException)
    {
        //no me vale abort pq lanza HttpException(..)
        //abort(501,"Method is not allowed for the requested route");
        return response()->json([
            "error" => 'Method is not allowed for the requested route',
        ], 405 );
    }

    return parent::render($request, $exception);
}
```
**error el json devolvia un error 500 y no mostraba la excepcion del servidor**
```js
...
.then(response => {
    this.issending = false
    this.btnsend = "Enviar"
    console.log("reponse ok",response)

    if(typeof response.error != "undefined"){
        return Swal.fire({
            icon: 'warning',
            title: 'Proceso incompleto (1)',
            html: 'No se ha podido procesar tu mensaje. Por favor inténtalo más tarde. Disculpa las molestias. <br/>'+response.error,
        })
    }
```
- Faltaba aplicar `.then(response => response.json())` en primera linea ya que la primera respuesta es una promesa de estado
**error obtengo undefined despues de setear la variable en vue**
- Pensaba que era el objeto _Observer de vue y que habia que resolverlo como promesa
- Que el fetch no lo hacia correctamente con await
- que necesitaba self en lugar del this
- que data solo admitía un array
- que habia que usar this.$set(..) o this.$data.folders
```vue
//error esto hacía que folders siempre fuera undefined
<select id="sel-folders" v-model="folders" class="form-control" required>
    <option disabled value="">Choose folder</option>
    <option v-for="(folder, i) in folders" :value="folder" :key="i">{{folder}}</option>
</select>

//esta es la forma correcta
<select id="sel-folders" v-model="folder" class="form-control" required>
    <option disabled value="">Choose folder</option>
    <option v-for="(folder, i) in folders" :value="folder" :key="i">{{folder}}</option>
</select>
```
- **error isset()**
```php
isset($data["code_cache"]); //me devuelve false cuando existe

//este metodo devuelve true con key code_cache
private function _has_key(array $data, $key){ return in_array($key,array_keys($data));}
```
- **error en componente sin cierre explicito**
```php
//teniendo una vista del tipo
<micomponente /> en blade. No se  "compila igual" a <micomponente></micomponente>
con la segunda opcion se renderiza el scrumb en el pie con la primera no
```
- **error vue template o render function not defined focus() of undefined**
```js
Porbé varias cosas, pensaba que era rsync, comente todo el componente
puse un componente básico
compilaba sin error pero saltaba el error
finalmente copié un componente que funcionaba PostIndex.vue 
fui separandolo y cuando use el archivo uploadindex.js en <script src=... saltó el error
es muy raro que no compile con ese nombre pero al cambiarlo a updateindex.js volvio a funcioanr
```
- **error al descargar el zip generado con imagenes da 404 en prod**
- Parece que es un tema de windows o el tipo del pdf porque lo he probado en test y prod con mi cv y se convierte bien
- **error conexion sql**
```js
Cuando re-construyo los contenedores no conecta
Si hago un composer-update en el contenedor funciona, esto se debe al fichero .env
no debería construir los contenedores con bd:127 sino con bd: mariadb
```
- **error localhost al ejecutar composer**
- SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for cont-mariadb-univ failed: nodename nor servname provided
```js
hay que cambiar estas lineas dependiendo de donde se ejecute composer

# para composer en maquina host
DB_HOST=127.0.0.1
# para php unit
DB_HOST=localhost
# para composer en contenedor
DB_HOST=cont-mariadb-univ
```

#### Parches
- 20-01-2021 Voy a actualizr laravel de ^7.24 a 7.30
