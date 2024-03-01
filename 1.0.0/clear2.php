<html>
<head>
    <style>
        .floatLeft {
        float:left;
        width:100px;
        height:100px;
        margin:2px;
        background-color:#A4C739;
        text-align:center;
        line-height: 100px;
        }
        .clear {
        clear:both;
        }
    </style>
</head>
<body>
<?php
        $alphabets = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $num_column = 4; 
?>
<head>
<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <?php
        $array_length = count($alphabets);
        for($i=0;$i<$array_length;$i++) {
    ?>
    <div>
            <?php
                for($j=$i;$j<$i+$num_column;$j++) {
                if(!empty($alphabets[$j])) {
                if($j%$num_column==0) $clearFloat = "clear";
            ?>
                <div class="floatLeft <?php echo $clearFloat; ?>">
                <?php echo $alphabets[$j]; ?>
                </div>
            <?php
            $clearFloat ="";
            }
            }
            $i=$j-1;
            ?>
    </div>
        <?php
        }
        ?>
</body>
</html>