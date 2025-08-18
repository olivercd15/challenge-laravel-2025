# 🧪 OlaClick Backend Challenge - Laravel Edition - Oliver Carranza

## 🚀 Instrucciones de entrega de proyecto con Docker

Ejecutar los siguientes comandos para levantar el proyecto con Docker: 

- Clonar el proyecto
```bash
git clone https://github.com/olivercd15/challenge-laravel-2025.git

- Ir a carpeta backend
```bash
cd Backend
```

- Copiar archivo .env
```bash
cp .env.example .env
```

- Construir los contenedores
```bash
docker compose up -d --build
```

- Realizar las migraciones con los seeders
```bash
docker compose exec app php artisan migrate --seed  
```  

- Generar key de laravel
```bash
docker compose exec app php artisan key:generate 
```  

- Habilitar permisos de escritura en Laravel con Nginx
```bash
docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

- Ejecutar los test realizados con PHPUnit
```bash
docker compose exec app php artisan test
```     

- El enlace que dirige al Swagger del proyecto deberia estar habilitado en:
http://localhost:8000/api/documentation 

- En caso de no poder acceder al Swagger, tambien se adicionó al proyecto una coleccion de Postman con las pruebas realizadas, con un entorno listo para hacer pruebas.

Backend/postman/OlaClick Backend.postman_collection.json


## 📌 Requerimientos Funcionales
Sobre los requierimientos funcionales, se desarrollaron todos los endpoints solicitados con sus respectivos criterios, pero ademas se agregó como adicional dos endpoints: Register y Login, con el objetivo de mantener protegidas las rutas con Middleware y JWT.

### 0.1. Registrar usuario
- Endpoint: `POST /api/v1/auth/register` 
- Para mas practicidad, el usuario podra registrarse directamente con un Nombre, Correo y Password. Luego de esto podra iniciar sesión con las credenciales recien creadas.

### 0.2. Iniciar sesión 
- Endpoint: `POST /api/v1/auth/login` 
- El usuario ya registrado en el sistema debera iniciar sesión con su Correo y Contraseña, la respuesta le generara un JSON Web Token, el cual debe usarse para todos los endpoints de los requerimientos funcionales, el tipo de Auth esta trabajado con Bearer Token.

### 1. Listar órdenes
- Endpoint: `GET /api/orders`
- Retorna todas las órdenes activas (`status != 'delivered'`).
- Debe usar Redis para cachear el resultado (TTL: 30s).

### 2. Crear una nueva orden
- Endpoint: `POST /api/orders`
- Crea una nueva orden con estado inicial `initiated`.
- Estructura esperada:
  ```json
  {
    "client_name": "Carlos Gómez",
    "items": [
      { "description": "Lomo saltado", "quantity": 1, "unit_price": 60 },
      { "description": "Inka Kola", "quantity": 2, "unit_price": 10 }
    ]
  }

### 3. Avanzar estado de una orden
Endpoint: `POST /api/orders/{id}/advance`

Transición:

initiated → sent → delivered

Si llega a delivered, la orden debe ser eliminada de la base de datos y del caché.

### 4. Ver detalle de una orden
Endpoint: `GET /api/orders/{id}`

Muestra datos completos incluyendo items, totales y estado actual.



## 🧱 Consideraciones Técnicas
Sobre las consideraciones tecnicas y el stack de desarrollo se tiene lo siguiente: 
- Laravel 12 - PHP 8.2
- Base de datos: PostgreSQL
- Cache - Redis en: 
  - Inicio Sesion
  - Listar Ordenes
  - Obtener Orden
- Arquitectura:
  - Hexagonal
  - DDD
  - CQRS
  - API Rest
- Principios SOLID aplicados: 
  - Single Responsability 
  - Open/Closed Principle, 
  - Interface Segregation 
  - Dependency Inversion
- Modelado con Eloquent ORM
- Validaciones robustas con Form Requests en:
  - Register User
  - Create Order
- Tests realizados:
  - Registro exitoso
  - Inicio sesion exitoso
  - Listar ordenes
  - Crear orden exitosa
  - Avanzar con la orden
  - Obtener detalles de la orden
- Contenerización con Docker + Docker Compose

## 📦 Estructura principal
```
app/
├── Application/
│   ├── Auth/
│   │   ├── Commands/
│   │   ├── DTOs/
│   │   ├── Validators/
│   ├── Orders/
│   │   ├── Commands/
│   │   ├── DTOs/
│   │   ├── Queries/
├── Domain/
│   ├── Interfaces/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   ├── Swagger/
├── Infrastructure/
│   ├── Repositories/
│   ├── Services/
├── Models/
├── Providers/
routes/
├── api.php
tests/
├── Feature/
```

Explicación: Se eligió la arquitectura Hexagonal + DDD por la alta escalabilidad que proporciona trabajar con este diseño (Application, Domain, Infrastructure), ademas que incluye directamente algunos Principios SOLID como Segregacion de Interfaces o Inyeccion de Dependencias, con lo cual apostamos fuertemente por el desacoplamiento de código, direccionando a un codigo legible, estructurado y altamente escalable.
Adicionalmente también se eligió aplicar el patrón CQRS (Command Query Responsibility Segregation) en la capa de Application para poder separar las acciones de lectura y escritura en la base de datos de los distintos metodos, esto contribuye de gran manera al desacoplamiento y nos permite escalar nuestro proyecto de manera exponencial, asi tambien como el rendimiento del mismo bajo consultas mejor trabajadas. 

## 🧪 Extra Points
- Documentación en Swagger o Postman: Se tiene documentación en Swagger y Postman
- Seeders y factories para testeo rápido: Se realizaron los seeders para el inicio de sesión y tambien se tiene factories para los Test Unitarios
- Logs de cambios de estado con timestamps: Se agrego una tabla en la base de datos, llamada "OrderStatusLogs", esta tabla guarda el estado actual y el estado siguiente cuando se ejecuta el servicio de Advance Order, cuando se elimina, este dato persiste como un historial. 


## ❓ Preguntas opcionales para explicar
- ¿Cómo asegurarías que esta API escale ante alta concurrencia?
  - Justamente el patron CQRS aplicado en el proyecto nos permite escalar de esta manera, ya que podemos explotar al maximo la optimizacion de consultas pesadas, vistas o procedimientos almacenados, en nuestras llamadas "Queries" podemos dejar de aplicar Eloquent para acceder con DB o Query Builder si fuera necesario. La integracion con Redis tambien nos permite ser veloces ante consultas repetitivas, tambien se puede aplicar colas de trabajo (Queues) para gestion de respuestas. Por último, con el mismo Docker podemos realizar algunas replicas de la aplicacion y distribuir la carga (Load Balancer).

- ¿Qué estrategia seguirías para desacoplar la lógica del dominio de Laravel/Eloquent?
  - Justamente la arquitectura elegida (Hexagonal) nos permite seguir esta estrategia, bajo una logica de codigo limpio y desacoplado. En nuestra Infrastructure donde alojamos nuestros servicios de JWT, Redis y Eloquent haremos lectura y escritura mediante nuestro Patron Repositorio, sin involucrar la logica que se mantiene en la Application y en los Handlers (CQRS). Estos repositorios de los Eloquent Models son inyectados a traves de interfaces definidas en el dominio

- ¿Cómo manejarías versiones de la API en producción?
  - Realizando un versionamiento "/api/v1", como se hizo en los Auth Endpoints, manteniendo la cultura de documentacion con Swagger o Postman, y por ultimo algo que considero una opinion tecnica mas personal, siempre prefiero mantener los endpoint legacy, claro que para esto deben estar en una estructura bastante desacoplada, pero al mantener los endpoints anteriores se evita romper funcionalidad en producción, asi que cada actualizacion de version de cada API la manejaria como una funcionalidad independiente y preferiblemente que se encuentre fuertemente desacoplada.

**¡Saludos!** 💡
