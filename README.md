## Gestionando la traducción.

1.- Instalo el paquete de laravel
```bash
composer requier laravel-lang/lang
```
2.- Creo un fichero en config para el listado de idiomas disponibles

[fichero config de idiomas](config/languages.php)

# Creandio un  API

1.- instalo el api
``` bash
php artisan install:api
```

2.-creamos un controlador para atender los entrypoint

```bash
php artisan make:controller AlumnoApiController
```

3.- Creo las rutas
dentro de routes/api.php
```php
Route::apiResource('alumnos', AlumnoApiController::class);
```

4.- creamos los resources para personalizar el contenido del json que vamos a retornar ante las solicitudes.
```php
php artisan make:resource AlumnoResource
php artisan make:resource AlumnoCollection --collection
```
5.- Escribimos el contenido 
En AlumnoResource
```bash
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ["data"=>["type"      =>"Alumnos",
                         "id"        =>(string)$this->id,
                         "attributes"=>[
                              "nombre"=>$this->nombre,
                              "edad"  =>$this->edad,
                              "email" =>$this->email
                                      ],
                         "links"     =>["self"=>"http://localhost:8000/api/alumnos/$this->id"]

        ]];
    }
}
```
En AlumnoCollection
```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AlumnoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return    ["data"=>$this->collection];
    }

    public function with($request){
        return ["jsonapi"=>[
            "version"=>"1.0",
        ]];
    }
}

```
Ahora nos queda atender a excepciones, por ejemplo si la base de datos está caída
Recogemos la excepción en el fichero bootstrap/app.php
Observa la línea de exception
```php
<?php

use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\ValidationHeaderMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(LanguageMiddleware::class);
        $middleware->api(append: ValidationHeaderMiddleware::class);
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn(QueryException $e) => response()->json([
            "status" =>"500", //Cada código
            "title"  =>"Database fail", //En función del código
            "details"=>"Access next please"

        ])
        );
    })->create();

```
Igualemnte cuando se realice una solicitud queiro confirmar que en el header esté el elemento de tipo Accept con un valor concreto comdo marca la especificacion Json:API que es (ver apumntes):
> Accept: application/vnd.api+json

Para ello creamos un middleware
```bash
 php artisan make:middleware ValidationHeaderMiddleware 
```

En el middeleware escribimos el siguiente código

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidationHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->get('Accept') !== 'application/vnd.api+json') {
            return response()->json(['status'=>406,
                                     "title" =>"Not Acceptable",
                                     "datail"=>" Accept not correct in header"], 406);
        }
        return $next($request);
    }
}
```
Observa cómo hemos asociado este middleware a las rutas que tengamos en el fichero api.php. Esto se hace en bootstrap/app.php cuyo contenido está mostrado anteriormente.

-----------------------------------------------------

# Proyecto de Gestión de Proyectos Avanzado

## Implementación de Gestión de Proyectos

### 1.- Estructura del Proyecto
```bash
# Creación de modelos y controladores
php artisan make:model Project
php artisan make:controller ProjectController
php artisan make:policy ProjectPolicy
2.- Relaciones de Datos
Usuarios y Proyectos: Relación uno a muchos
Proyectos y Estudiantes: Relación many-to-many
Ejemplo de Implementación de Relaciones
php
// Modelo Project
class Project extends Model
{
    protected $fillable = [
        'title', 
        'estimated_hours', 
        'start_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_project');
    }
}
3.- Políticas de Autorización
php
// Ejemplo de política de proyectos
class ProjectPolicy
{
    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}
4.- Características Técnicas
Autenticación: Sistema basado en Laravel Breeze
Validación de Datos: Validación exhaustiva en controladores
Manejo de Fechas: Conversión flexible de fechas
Control de Acceso: Autorización granular por usuario
5.- Funcionalidades Implementadas
Creación de proyectos personalizados
Listado de proyectos por usuario autenticado
Edición detallada de proyectos
Eliminación de proyectos
Asignación de estudiantes a proyectos
Validación de permisos de usuario
6.- Comandos de Gestión
bash
CopyInsert
# Migraciones y configuración
php artisan migrate
php artisan make:request ProjectStoreRequest
php artisan make:request ProjectUpdateRequest
7.- Mejoras de Seguridad
Restricción de acceso a proyectos
Validación de pertenencia de proyectos
Protección contra modificaciones no autorizadas
8.- Próximas Mejoras
Implementación de filtros avanzados
Sistema de comentarios en proyectos
Integración de notificaciones