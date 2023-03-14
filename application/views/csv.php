<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="<?php bu('CSV/export')?>" method="post">
            <p>Export data from table <select name="table" id="">
                <?php
                    for ($i=0; $i < count($tables); $i++) { 
                        ?>
                            <option value="<?php echo $tables[$i]?>"><?php echo $tables[$i]?></option>
                        <?php
                    }
                ?>
            </select></p>
            <p>Separator <select name="separator" id="">
                <option value=",">virgule</option>
                <option value=";">point-virgule</option>
            </select></p>
            <p><button type="submit">Export</button></p>
        </form>
    </div>
    <div>
        <p><?php echo $error?></p>
        <form action="<?php bu('CSV/import')?>" method="post" enctype="multipart/form-data">
            <p>Import data into table <select name="table" id="">
                <?php
                    for ($i=0; $i < count($tables); $i++) { 
                        ?>
                            <option value="<?php echo $tables[$i]?>"><?php echo $tables[$i]?></option>
                        <?php
                    }
                ?>
            </select></p>
            <p>CSV: <input type="file" name="csv" id=""></p>
            <p><button type="submit">Export</button></p>
        </form>
    </div>
</body>
</html>