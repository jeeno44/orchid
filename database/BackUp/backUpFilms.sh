#! /bin/bash

# echo "" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a /home/jeeno/sites/orchid/database/BackUp/films_
#echo "Резервная копия спика фильмов и сериалов" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru

file="~/jeeno/sites/orchid/public/films_2022*"

if [ -f $file ];
then
    echo "Файл существует";
else
    echo "НЕТ ФАЙЛА";
fi
