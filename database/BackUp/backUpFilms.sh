#! /bin/bash

# echo "" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a /home/jeeno/sites/orchid/database/BackUp/films_
echo "Резервная копия спика фильмов и сериалов" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru


if [];
then
    echo "GOOD";
else
    echo "BAD";
fi
