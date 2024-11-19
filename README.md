# sgRestaurante

Este documento describe los pasos necesarios para ejecutar el software `sgRestaurante` en otro equipo.

## Requisitos Previos

1. **Sistema Operativo**: Asegúrese de que el equipo destino tenga un sistema operativo compatible (Windows, macOS, Linux).
2. **PHP**: Instale PHP desde [apachefriends.org](https://www.apachefriends.org/es/index.html).
3. **Composer**: Instale Composer desde [getcomposer.org](https://getcomposer.org/).
4. **Git**: Asegúrese de tener Git instalado. Puede descargarlo desde [git-scm.com](https://git-scm.com/).

## Pasos para la Instalación

1. **Clonar el Repositorio**:
    ```bash
    git clone https://github.com/tu-usuario/sgRestaurante.git
    cd sgRestaurante
    ```

2. **Instalar Dependencias**:
    ```bash
    composer install
    ```

3. **Configurar Variables de Entorno**:
    Copie el archivo `.env.example` a `.env` y configure las variables necesarias:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configurar Base de Datos**:
    Edite el archivo `.env` para configurar las credenciales de la base de datos:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_datos //Agrega el nombre que le quieres dar a la base de datos
    DB_USERNAME=usuario //Por lo general se debe utilzar el usuario root
    DB_PASSWORD=contraseña //Por lo general se deja vacío
    ```

5. **Ejecutar Migraciones de Base de Datos**:
    ```bash
    php artisan migrate
    ```
    En caso de preguntar si desea crear la base de datos responder con yes

6. **Iniciar el Servidor**:
    ```bash
    php artisan serve
    ```

## Uso

Abra su navegador y vaya a `http://localhost:8000/admin` para acceder a la aplicación.

## Solución de Problemas

- **Error de Conexión a la Base de Datos**: Verifique las credenciales en el archivo `.env`.
- **Dependencias Faltantes**: Asegúrese de haber ejecutado `composer install`.
