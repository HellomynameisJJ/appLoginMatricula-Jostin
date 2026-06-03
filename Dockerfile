FROM php:8.2-cli

# 1. Instalar herramientas del sistema y Node.js moderno (v20)
RUN apt-get update && apt-get install -y curl libzip-dev zip unzip git \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql zip
    
# 2. Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Preparar la carpeta del proyecto
WORKDIR /app
COPY . .

# 4. Instalar dependencias de Laravel y el diseño
RUN composer install --no-dev --optimize-autoloader
RUN npm install
RUN npm run build

# 5. Dar permisos de seguridad
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# 6. Encender el servidor (Usando el puerto automático de Render)
CMD php artisan serve --host=0.0.0.0 --port=$PORT