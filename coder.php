<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 20px;
            height: 100vh;
        }
        div {
            display: flex;
            gap: 8px;
            width: 300px;
        }
        input { 
            padding: 4px;
        }
        button {
            padding: 4px;
            margin: 10px 0;
        }
        p {
            color: rgb(255,0,0);
            margin: 0;
        }
  </style>
</head>
<body>    
    <h1>Закодировать</h1>
    <form action="coder.php" method="get">
        <div>
            <input placeholder="Слово" type="text" name="word1"><br>
            <input placeholder="Чётное" type="text" name="even1"><br>
            <input placeholder="Нечётное" type="text" name="odd1"><br>
        </div>
        <button>Закодировать</button>
        <?php echo '<p>' . $result1 . '</p>'; ?>
        <!-- <p><?echo $result1?></p> -->
    </form>
    <hr>
    <h1>Раскодировать</h1>
    <form action="coder.php" method="get">
        <div>
            <input placeholder="Слово" type="text" name="word2"><br>
            <input placeholder="Чётное" type="text" name="even2"><br>
            <input placeholder="Нечётное" type="text" name="odd2"><br>
        </div>
        <button>Раскодировать</button>
        <?php if ($result2 != "") : ?>
            <p class="result2"><?php echo $result2; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>

<?
    $word1 = $_REQUEST["word1"];
    $even1 = $_REQUEST["even1"]; //для чётных
    $odd1 = $_REQUEST["odd1"];   //для нечётных

    $word2 = $_REQUEST["word2"];
    $even2 = $_REQUEST["even2"]; //для чётных
    $odd2 = $_REQUEST["odd2"];   //для нечётных  


    $rus_abc_upper = "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ";
    $rus_abc_lower = "абвгдеёжзиклмнопрстуфхцчшщъыьэюя";
    $en_abc_upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $en_abc_lower = "abcdefghijklmnopqrstuvwxyz";
    $result1 = '';
    $result2 = '';
    if($word1 != "") {
        if(preg_match("/^[a-zA-Za-яА-Я]+$/u", $word1)) {
            for($i = 0; $i < strlen($word1); ++$i) {
                $position = stripos($en_abc_upper, $word1[$i]);
                if($position !== false) {
                    $new_position = ($position % 2 === 0) ? ($position + $even1) % strlen($en_abc_upper) : ($position + $odd1) % strlen($en_abc_upper);
                    $result1 .= $en_abc_upper[$new_position];
                }  else {
                    $position = stripos($en_abc_lower, $word1[$i]);
                    if($position !== false) {
                        $new_position = ($position % 2 === 0) ? ($position + $even1) % strlen($en_abc_lower) : ($position + $odd1) % strlen($en_abc_lower);
                        $result1 .= $en_abc_lower[$new_position];
                    }  else {
                        $position = stripos($rus_abc_upper, $word1[$i]);
                        if($position !== false) {
                            $new_position = ($position % 2 === 0) ? ($position + $even1) % strlen($rus_abc_upper) : ($position + $odd1) % strlen($rus_abc_upper);
                            $result1 .= $rus_abc_upper[$new_position];
                        }  else { 
                            $position = stripos($rus_abc_lower, $word1[$i]);
                            if($position !== false) {
                                $new_position = ($position % 2 === 0) ? ($position + $even1) % strlen($rus_abc_lower) : ($position + $odd1) % strlen($rus_abc_lower);
                                $result1 .= $rus_abc_lower[$new_position];
                            }
                        }
                    }
                }
                
            }
        }
        echo $result1;
    }
    if($word2 != "") {
        if(preg_match("/^[a-zA-Za-яА-Я]+$/u", $word2)) {
            for($i = 0; $i < strlen($word2); ++$i) {
                $position = stripos($en_abc_upper, $word2[$i]);
                if($position !== false) {
                    $new_position = ($position % 2 === 0) ? ($position - $even2) % strlen($en_abc_upper) : ($position - $odd2) % strlen($en_abc_upper);
                    $result2 .= $en_abc_upper[$new_position];
                }  else {
                    $position = stripos($en_abc_lower, $word2[$i]);
                    if($position !== false) {
                        $new_position = ($position % 2 === 0) ? ($position - $even2) % strlen($en_abc_lower) : ($position - $odd2) % strlen($en_abc_lower);
                        $result2 .= $en_abc_lower[$new_position];
                    }  else {
                        $position = stripos($rus_abc_upper, $word2[$i]);
                        if($position !== false) {
                            $new_position = ($position % 2 === 0) ? ($position - $even2) % strlen($rus_abc_upper) : ($position - $odd2) % strlen($rus_abc_upper);
                            $result2 .= $rus_abc_upper[$new_position];
                        }  else { 
                            $position = stripos($rus_abc_lower, $word2[$i]);
                            if($position !== false) {
                                $new_position = ($position % 2 === 0) ? ($position - $even2) % strlen($rus_abc_lower) : ($position - $odd2) % strlen($rus_abc_lower);
                                $result2 .= $rus_abc_lower[$new_position];
                            }
                        }
                    }
                }
                
            }
        }
        echo $result2;
    }

//Encrypt(mn) = (Q + mn + k) % Q
// Decrypt(cn) = (Q + cn - k) % Q
?>


