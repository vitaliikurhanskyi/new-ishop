<?php

/**
 * @var $errorNumber \wfm\ErrorHandler
 * @var $errorStr \wfm\ErrorHandler
 * @var $errorFile \wfm\ErrorHandler
 * @var $errorLine \wfm\ErrorHandler
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?php echo $errorNumber ?></p>
<p><b>Текст ошибки:</b> <?php echo $errorStr ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?php echo $errorFile ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?php echo $errorLine ?></p>

</body>
</html>
