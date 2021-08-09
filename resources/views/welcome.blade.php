<?php

        
    $dates =File::get(storage_path('app/secret.txt')); //Возмем все содержание с файла secret.txt
    
    $sliceddates = explode(" ", $dates); //Эта функция разделяет тексты с помощью пробелов и конвертирует их в массив. Например было ("4 5 3 1") стало ("4","5","3","1");   
    
    $fl = array();// В этот массив добавляются какие операции выполнились. Например здесь добавятся: 6+4
    $all  = array();// А в этот массив добавляются все ответы операции но только ответы. например : 10. 
    
    $negatives= array();
    $positives= array();
    
        for ($i=0; $i<count($sliceddates); $i+=2) {
            //Тут происходит операция с помощью цикла. i будет увеличивается с 0 до длинны slicedates. и с каждым увелечением операция повторяеться

                        //Сложение
             array_push($fl, $sliceddates[$i]."+".$sliceddates[$i+1]."=");//Это функция берет только операцию и добавляет их в массив $fl  
             array_push($all,$sliceddates[$i]+$sliceddates[$i+1]);//А это функция берет результат и добавляет их в массив $fl
             
                        //Вычитание
             array_push($fl, $sliceddates[$i]."-".$sliceddates[$i+1]."=");
             array_push($all,$sliceddates[$i]-$sliceddates[$i+1]);
                        //Умножение
             array_push($fl, $sliceddates[$i]."*".$sliceddates[$i+1]."=");
             array_push($all,$sliceddates[$i]*$sliceddates[$i+1]);
                        //Деление
             array_push($fl, $sliceddates[$i].":".$sliceddates[$i+1]."=");
             array_push($all,$sliceddates[$i]/$sliceddates[$i+1]);

        }

        for ($j=0; $j<count($all); $j++) { //этот цикл проверяет результаты всех операции добавленных в массив $all 
                if ($all[$j]>0) {//если результат операции больше чем 0 то добавляет его в массив $positives
                    
                array_push($positives,$fl[$j].$all[$j]."
");         
                }else{//Иначе  добавляет его в массив $negatives
                array_push($negatives, $fl[$j].$all[$j]."
");
                }
            
                        //Показывает результат этого кода в веб-браузере а также в консоле.

        }
        echo "POSiTIVE ANSWERS HERE:
";
            for ($o=0; $o<count($positives); $o++) { 
                echo $positives[$o];
            }
        echo "NEGATIVE ANSWERS HERE:
";
            for ($o=0; $o<count($negatives); $o++) { 
                echo $negatives[$o];
            }
        echo "LOOK AT FILES Positive and Negative.txt in directory <b>storage\app</b>";
        

                //Добавление всех результатов в файлы с позитивными и негативными ответами
        
        Storage::disk('local')->put('positives.txt', $positives);//Добавляет сожержимое массива positives в файл positives.txt

        Storage::disk('local')->put('negatives.txt', $negatives); //Добавляет сожержимое массива negatives в файл negatives.txt
    ?>
