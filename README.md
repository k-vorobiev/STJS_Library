
# Scrimmy Render JavaScript Object Library

Данная библиотека позволяет выбрасывать любые данные скалярного типа в виде JavaScript объектов из PHP
## Установка

Добавьте в свой composer.json репозиторий скрипта:

```
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/k-vorobiev/STJS_Library.git"
    }
],
```

А затем выполните команду:

```
composer require scrimmy/tjs:dev-master
```
## Использование

Создаем экзепляр класса `ScrimmyRenderJsObject()`, а затем вызываем метод `renderJSObject`, в который передаём: имя объекта, массив значений объекта.

Пример:

```
$STJS = new ScrimmyRenderJsObject();

$args = array(
    'example' => 'exampleValue',
    'example2' => 10,
);

$script = $STJS->renderJSObject('my_object', $args);
```

Выводим переменную `$script` в `<head>` или любом другом месте и получаем следующую HTML-разметку

```
<script>/* <![CDATA[ */ let my_object = {"example":"exampleValue","example2":"10"}; /* ]]> */</script>
```

Теперь нам доступен объект `my_object` со свойствами `example` и `example2`
