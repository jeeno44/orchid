#! /bin/bash

# echo "" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a /home/jeeno/sites/orchid/database/BackUp/films_
#echo "Резервная копия спика фильмов и сериалов" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru

file="/home/jeeno/sites/orchid/public/films_2022"*

if [ -f $file ];
then
    echo "Файл существует";
    echo "Резервная копия спика фильмов и сериалов" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a "$file"
else
    echo "НЕТ ФАЙЛА";
fi

