<!DOCTYPE html>
<html lang="cs-cz">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" href="data:,">
        <title>Home</title>
    </head>
    <body>
 <h1>Welcome</h1>
 <p>from the view!</p>

 <div>
 <p>Hello <?php echo htmlspecialchars($name); ?>!</p>
 <ul>
     <?php foreach ($colours as $colour): ?>
     <li><?php echo htmlspecialchars($colour); ?></li>
     <?php endforeach; ?>
 </ul>
 </div>

    </body>
</html>