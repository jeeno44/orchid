#! /bin/bash

# echo "" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a /home/jeeno/sites/orchid/database/BackUp/films_
#echo "Резервная копия спика фильмов и сериалов" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru

file="/home/jeeno/sites/orchid/public/films.json"

dt=`date +"%Y.%m.%d_%H:%M"`

if [ -f $file ];
then
    echo "Файл существует/делаем оправку ${dt}";
    echo "Резервная копия спика фильмов и сериалов (${dt})" | mutt -s "Добавлен фильм или сериал" jeep456@yandex.ru -a "$file";
    #rm ${file};
    mv $file "/home/jeeno/sites/orchid/database/BackUp/done/"
    mv "/home/jeeno/sites/orchid/database/BackUp/done/films.json" "/home/jeeno/sites/orchid/database/BackUp/done/films_done_${dt}.json"
else
    echo "НЕТ ФАЙЛА ${dt}";
fi

