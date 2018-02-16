# Portabilis

Projeto Teste com Symfony 4.

## Install

1 - Install dependencies

```console
composer.phar install
```

2 - Create database

```console
./bin/console doctrine:schema:create
```

## Running

```console
./bin/console server:start
```

## Stoping

```console
./bin/console server:stop
```

## Importing Courses

```console
./bin/console app:import:courses content/courses_file.csv
```

## Importing Students

```console
./bin/console app:import:students content/students_file.csv
```

## Testing

1 - Create database structure

```console
DATABASE_URL="sqlite:///%kernel.project_dir%/var/test.db" ./bin/console doctrine:schema:create
```

2 - Run tests

```console
./bin/phpunit
```
