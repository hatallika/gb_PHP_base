<?php
/* Задача 1.
____________________________________________________________*/
$i = 0;
$answ1 = ''; // переменная вывода задачи 1

while ($i <= 100) {
    if ($i % 3 === 0 ) {
    $answ1 .= " {$i} ";
    }
    $i++;
}

/* Задача 2.
____________________________________________________________*/
function parityCheck(){
    $i = 0;
    $answ = $i . " - ноль. <br>";

    do {
        $i++;
        switch($i & 1) {
            case 0: $answ .=  $i . " - четное число. <br>"; break;
            case 1: $answ.=  $i . " - нечетное число. <br>"; break;
        }
    } while ($i<=9);
    return $answ;
}
$answ2 = parityCheck();// вывод задачи 2

// вариант разбора преподавателя
function parityCheck_(){
    $i = 0;
    do {
        if ($i === 0) {
            $answ = $i . " - ноль. <br>";
        } elseif ($i & 1 !== 0){
            $answ.=  $i . " - нечетное число. <br>";
        } else {
            $answ .=  $i . " - четное число. <br>";
        }
        $i++;
    } while ($i<=10);
    return $answ;
}
$answ2_ = parityCheck_();


/*Задача 3
____________________________________________________________*/
$region = [
        'Московская область' => ['Москва', 'Королев','Зеленоград', 'Клин'],
        'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
        'Рязанская область' => ['Рязань', 'Скопин','Сасово', 'Ряжск']
        ];
/*Первый способ из массива в строку с разделителями*/
$answ3 = "";
foreach ($region as $key => $value) {
    $answ3 .= $key . ":<br>";
    $answ3 .= implode(', ', $value) . '.<br>';
}

/*Второй способ перебор в массиве*/
$answ3_ = "";
foreach ($region as $key => $value) {
    $answ3_ .= $key .":<br>";
    foreach ( $value as $item) {
        $answ3_ .= $item . ", ";
    }
    $answ3_ .= ".<br>";
    $answ3_ = str_replace(", .",".",$answ3); // Заменили в конце ,. на .
}
// Способ в разборе
$answ3__ = "";
foreach ($region as $key => $value){
    $answ3__ .= $key .":<br>";
    foreach ($value as $item){
        $answ3__ .= $item . ", ";
    }
    $answ3__ = substr_replace($answ3__, '.', -2, 2);
    $answ3__ .= "<br>";
}


/*Задача 4
____________________________________________________________*/
$alfabet = [
    'а' => 'a',   'б' => 'b',   'в' => 'v',
    'г' => 'g',   'д' => 'd',   'е' => 'e',
    'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
    'и' => 'i',   'й' => 'y',   'к' => 'k',
    'л' => 'l',   'м' => 'm',   'н' => 'n',
    'о' => 'o',   'п' => 'p',   'р' => 'r',
    'с' => 's',   'т' => 't',   'у' => 'u',
    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
    'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
    'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
    'э' => 'e',   'ю' => 'yu',  'я' => 'ya'
];

$answ4 = "Щегол - роман американской писательницы Донны Тартт";

function translit($string, $alfabet) // почему-то не видит через global &alfabet
{
    //return mb_strtolower($string),($alfabet);// спопоб с готовой функцией
    $str = "";
    for($i = 0; $i < mb_strlen($string); $i++){
        $letter = mb_substr($string, $i, 1, "UTF-8");
        $small_letter = mb_strtolower($letter);

        if (isset($alfabet[$small_letter])) { // если существует значение в массиве
            if ($small_letter == $letter) {
                $str .= $alfabet[$small_letter];
            } else {
                $str .= ucfirst($alfabet[$small_letter]);
            }

        } else {
           $str .= $small_letter;
        }

    }
    return $str;
}
$answ4 .= "<br>". translit($answ4,$alfabet);// Вывод задачи 4

/*Задача 5
____________________________________________________________*/
$answ5 = "Это строка с пробелами. Надо их заменить на подчеркивание.";
$smb = "_";// на что меняем.

function replaceSpaces($str,$smb="_"){
   return str_replace(" ", $smb, $str);
}

$answ5 .= "<br>" . replaceSpaces($answ5,$smb); // Вывод задачи 5

/*Задача 6 в меню фреймворка  menu.php menu2.php: рекурсия
/*Задача 7
____________________________________________________________*/
ob_start();
for ($i = 0; $i<=9; print $i++); //echo нельзя так как не функция.
$answ7 = ob_get_clean();

/*Задача 8
____________________________________________________________*/
$answ8 = "";
foreach ($region as $key => $value) {
    $answ8 .= $key .":<br>";
    foreach ( $value as $item) {
        $smb = (mb_substr($item, 0, 1)); // первый символ города
        if ($smb == 'К'){
            $arr =[];
            array_push($arr,$item);
            $answ8 .= (implode(', ',$arr));
            $answ8 .= '.<br>';
        }
    }
}
// Способ в разборе. Выводим города на К
$answ8__ = "";
foreach ($region as $key => $value){
    $answ8__ .= $key .":<br>";
    $str = '';
    foreach ($value as $item){
        if(mb_substr($item, 0, 1) === 'К'){
            $str .= $item . ", ";
        }
    }
    if (!empty($str)){
        $str = substr_replace($str, '.', -2, 2);
        $answ8__ .= $str . '<br>';
    }
}


/*Задача 9
____________________________________________________________*/
$answ9 = 'Заголовок случайной публикации';

function rusToLat($string, $alfabet){ // с глобал так и не вышло
    $s = translit($string, $alfabet);
    var_dump($s);
    return replaceSpaces($s);

}
$answ9 = rusToLat($answ9, $alfabet);

// Разбор 9
$answ9_ = 'А это второй заголовок случайной публикации';
function rusToLat_($string, $alfabet){ // с глобал так и не вышло

    return replaceSpaces(translit($string, $alfabet));

}
$answ9_ = rusToLat_($answ9_, $alfabet);

?>
<h1 id="1">Упражнения</h1>
<h2 class="task_title">Задача1:</h2>
<p>С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка</p>
<h3>Вывод:</h3>
<p><?=$answ1?></p>
<h2 id="2" class="task_title">Задача 2:</h2>
<p>2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так: <br>
    0 – ноль.<br>
    1 – нечетное число.<br>
    2 – четное число.<br>
    3 – нечетное число.<br>
    … <br>
    10 – четное число.</p>
<h3>Вывод:</h3>
<p><?=$answ2?> <br>
    <?=$answ2_?>
</p>
<h2 id="3" class="task_title">Задача 3:</h2>
<p>3. Объявить массив, в котором в качестве ключей будут использоваться названия областей,
    а в качестве значений – массивы с названиями городов из соответствующей области.<br>
    Вывести в цикле значения массива, чтобы результат был таким:<br>
    Московская область:<br>
    Москва, Зеленоград, Клин.<br>
    Ленинградская область:<br>
    Санкт-Петербург, Всеволожск, Павловск, Кронштадт.<br>
    Рязанская область … <br>
    (названия городов можно найти на maps.yandex.ru) строго соблюдать формат вывода выше,
    т.е. двоеточие и точка в конце</p>
<h3>Вывод:</h3>
<p>Способ 1 <br><?=$answ3?><br>
    Способ 2 <br><?=$answ3_?><br>
    Разбор: <br><?=$answ3__?><br>
</p>
<h2 id="4" class="task_title">Задача 4:</h2>
<p>4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские<br>
    буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).<br>
    Написать функцию транслитерации строк. Она должна учитывать и заглавные буквы.
</p>
<h3>Вывод:</h3>
<p><?=$answ4?></p>
<h2 id="5" class="task_title">Задача 5:</h2>
<p>5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.
    Можно через str_replace.
</p>
<h3>Вывод:</h3>
<p><?=$answ5?></p>
<h2 id="6" class="task_title">Задача 6:</h2>
<p> В имеющемся шаблоне сайта заменить статичное меню (ul – li) на генерируемое через PHP.
    Необходимо представить пункты меню как элементы массива и вывести их циклом.
    Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.
    Важное, при желании можно сделать на движке 3.
</p>
<h3>Вывод:</h3>
<p>Организовано в Меню данного движка menu2.php (рекурсия) и menu.php (генерация ссылок из имен страниц)</p>
<h2 id="7" class="task_title">Задача 7:</h2>
<p>  *Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:<br>
    for (…){ // здесь пусто}
</p>
<h3>Вывод:</h3>
<p><?=$answ7?></p>
<h2 id="8" class="task_title">Задача 8:</h2>
<p>  Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
</p>
<h3>Вывод:</h3>
<p><?=$answ8?><br>
   Разбор:  <?=$answ8__?>
</p>
<h2 id="9" class="task_title">Задача 9:</h2>
<p> Объединить две ранее написанные функции в одну, которая получает строку на русском языке,<br>
    производит транслитерацию и замену пробелов на подчеркивания <br>
    (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).
</p>
<h3>Вывод:</h3>
<p><?=$answ9?><br>
    <?=$answ9_?>
</p>