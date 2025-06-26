
## Функциональность

### Продукты (Products)
- `GET /api/products` — список продуктов (с пагинацией и фильтрацией min, max, perPage.)
- (GET /api/products?category_id=5&price_min=100&price_max=1000&per_page=20)
- `GET /api/products/{id}` — информация о продукте

### Корзина (Cart)
- `GET /api/cart` — текущая корзина пользователя (в сессии)
- `POST /api/cart` — добавить товар в корзину
- `PUT /api/cart/{product_id}` — изменить количество
- `DELETE /api/cart/{product_id}` — удалить товар из корзины

> Корзина хранится в сессии и поддерживает валидацию: `min_qty`, `in_stock`, UUID.

### Авторизация (Laravel Sanctum)
- `POST /api/register` — регистрация
- `POST /api/login` — вход
- `POST /api/logout` — выход

---

## Установка

```
git clone https://github.com/R1deNn/testovoe_api.git
cd testovoe_api
cp .env.example .env
composer install
php artisan key:generate
```

### Запуск Sail:
```
./vendor/bin/sail up -d
```

### Миграции и сиды:
```
./vendor/bin/sail artisan migrate --seed
```

---

## Тесты

```
./vendor/bin/sail artisan test
```

Покрыты:
- CRUD продуктов
- Добавление, изменение и удаление из корзины

---

## Стек

- Laravel 12
- PHP 8.2+
- Session-based корзина
- Laravel Sail
- Postman/Swagger — ручное тестирование

---

## Дополнительно реализовано

- Обработка исключений в формате JSON через кастомный middleware
- Валидация на уровне FormRequest'ов
- API-ресурсы для форматирования ответов
- Пагинация + фильтрация по названию и цене
