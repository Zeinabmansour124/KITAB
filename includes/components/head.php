
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'KITAB'; ?></title>
    <link rel="shortcut icon" href="../photos/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="../photos/favicon.ico" type="image/x-icon" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="/projet_web/KITAB/assets/css/<?= htmlspecialchars($pageCSS ?? 'details.css') ?>" />
  <?php if (!empty($pageChatbot)): ?>
  <link rel="stylesheet" href="/projet_web/KITAB/assets/css/chatbot.css" />
  <?php endif; ?>
</head>