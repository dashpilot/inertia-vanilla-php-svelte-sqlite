<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Inertia Svelte Blog</title>
    
    <?php
    // Check if we're in a production environment
    // Default to production for live server
    include("../config.php");
    
    // You can use ENV vars if you have them set up
    // $isProduction = getenv('APP_ENV') !== 'local';
    
    if (!$isProduction): // Development mode
    ?>
        <script type="module" src="http://localhost:3000/@vite/client"></script>
        <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
    <?php else: // Production mode ?>
        <link rel="stylesheet" href="/assets/app.css">
        <script type="module" src="/assets/app.js"></script>
    <?php endif; ?>
</head>
<body>
    <div id="app" data-page='<?php echo $jsonPage; ?>'></div>
</body>
</html>