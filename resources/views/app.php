<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Inertia Svelte Blog</title>
    
    <?php if (true): /* Always use dev server during development */ ?>
        <script type="module" src="http://localhost:3000/@vite/client"></script>
        <script type="module" src="http://localhost:3000/resources/js/app.js"></script>
    <?php else: ?>
        <link rel="stylesheet" href="/assets/app.css">
        <script type="module" src="/assets/app.js"></script>
    <?php endif; ?>
    
    <style>
        /* Minimal CSS reset and base styles */
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
    </style>
</head>
<body>
    <div id="app" data-page='<?php echo $jsonPage; ?>'></div>
</body>
</html>