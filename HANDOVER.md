# Передача проекта AF Compressors

## 1. Передать доступ к GitLab

1. Получить GitLab username нового разработчика и добавить его в проект `CasperDev394/afcompressors` с ролью **Maintainer**.
2. Не передавать пароль от старого аккаунта. Если нужно сменить владельца проекта — использовать штатный Transfer project/group в GitLab.
3. Передать секреты через менеджер паролей, не через репозиторий или обычный чат.

Клонирование проекта:

```bash
git clone git@gitlab.com:CasperDev394/afcompressors.git
cd afcompressors
git checkout main
```

Основная и production-ветка — `main`.

## 2. Передать GitLab CI/CD Variables

Переменные находятся в **GitLab → Settings → CI/CD → Variables**.

Обязательные пользовательские переменные:

| Переменная | Назначение |
|---|---|
| `SSH_PRIVATE_KEY` | Приватный ключ для подключения CI к VPS |
| `SERVER_HOST` | `139.100.237.28` |
| `SERVER_USER` | Пользователь SSH, сейчас `root` |

`CI_REGISTRY`, `CI_REGISTRY_IMAGE`, `CI_REGISTRY_USER` и `CI_REGISTRY_PASSWORD` предоставляет GitLab автоматически.

Лучше создать новому разработчику и CI отдельные SSH-ключи. Публичные ключи добавить на VPS в `~/.ssh/authorized_keys`, приватные ключи хранить только в GitLab Variables/менеджере паролей. Секретные CI-переменные должны быть **Masked** и **Protected**.

## 3. Production-сервер

- VPS: `139.100.237.28`
- Подключение: `ssh root@139.100.237.28`
- Рабочая директория инфраструктуры: `/srv`
- Docker Compose: `/srv/compose.yaml`
- Production-переменные: `/srv/.env`

`/srv/.env` — главный production env. Он подключается к контейнеру `app` через `env_file` в `/srv/compose.yaml`. Сам файл и его значения нельзя добавлять в Git.

Основные сервисы:

| Сервис | Назначение |
|---|---|
| `app` | Laravel + встроенные Nginx, PHP-FPM, queue worker и scheduler |
| `pgsql` | PostgreSQL 18 |
| `proxy` | Nginx Proxy Manager и Let's Encrypt |

Постоянные данные:

- `/srv/afcompressors/storage` — файлы Laravel;
- `/srv/pgsql` — база PostgreSQL;
- `/srv/proxy/data` — настройки Nginx Proxy Manager;
- `/srv/proxy/letsencrypt` — сертификаты.

Перед изменением БД, volumes или proxy обязательно сделать резервную копию этих данных.

## 4. Домен и reverse proxy

- Production-домен: `https://afcompressors.ru`
- DNS управляется через REG.RU.
- A-запись домена должна указывать только на `139.100.237.28`.
- Nginx Proxy Manager доступен на порту `81` VPS.
- Proxy Host направляет `afcompressors.ru` на контейнер `app`, порт `80`.
- Контейнеры работают в Docker-сети `af_net`.

Доступ к панели REG.RU и Nginx Proxy Manager также передать через менеджер паролей.

## 5. Сборка и деплой

CI/CD описан в `.gitlab-ci.yml`. Обе задачи запускаются вручную:

1. Изменения принимаются в `main`.
2. В GitLab открыть **Build → Pipelines**.
3. Запустить manual job `build` — образ будет собран и отправлен в GitLab Container Registry.
4. После успешной сборки запустить manual job `deploy`.
5. Deploy скачивает образ конкретного commit SHA, пересоздаёт `app`, выполняет миграции и Laravel cache-команды.
6. В конце проверяются `http://127.0.0.1/up` внутри контейнера и `https://afcompressors.ru/up` снаружи.

Полезные команды на VPS:

```bash
cd /srv
docker compose ps
docker compose logs --tail=200 app
docker compose logs --tail=200 proxy
docker compose exec -T app php artisan about
```

## 6. Почтовая отправка

Формы контактов, запроса цены и подписки уже используют общий почтовый механизм, но production SMTP ещё нужно настроить. Переменные добавляются в `/srv/.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_SCHEME=smtp
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@afcompressors.ru
MAIL_FROM_NAME="AF Compressors"
WEBSITE_FORMS_MAIL_TO=office-afrus@afcompressors.com
```

Точные `MAIL_SCHEME` и `MAIL_PORT` взять у SMTP-провайдера. После изменения `/srv/.env` контейнер `app` необходимо пересоздать или выполнить очередной deploy. Пока SMTP не настроен, production намеренно возвращает форме ошибку вместо ложного сообщения об успешной отправке.

## 7. Локальный запуск

Требуются PHP 8.3+, Composer, Node.js 20+ и Docker. Базовый запуск:

```bash
cp .env.example .env
composer install
php artisan key:generate
npm install
npm run build
php artisan migrate
php artisan serve
```

Перед передачей убедиться, что новый разработчик может:

- клонировать и отправлять изменения в GitLab;
- открыть GitLab Container Registry и Pipelines;
- подключиться к VPS своим SSH-ключом;
- найти `/srv/.env` и `/srv/compose.yaml`;
- войти в REG.RU и Nginx Proxy Manager;
- запустить ручные jobs `build` и `deploy`.
