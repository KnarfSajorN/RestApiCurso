<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['page_tag']; ?></title>
</head>
<body>
    <h1><?php echo $data['page_title']; ?></h1>
    <p>Welcome to the home page!</p>
    <p>Current page name: <?php echo $data['page_name']; ?></p>
    <p>Base URL: <?php echo BASE_URL; ?></p>
    <p>Media URL: <?php echo media(); ?></p>
    <p>Data: <?php echo dep($data); ?></p>
    <p>Cleaned String: <?php echo strClean("<script>alert('Hello');</script>"); ?></p>
</body>
</html>