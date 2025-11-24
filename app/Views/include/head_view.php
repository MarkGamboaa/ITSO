<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <title><?= esc($title ?? 'ITSO') ?></title>

    <style>
        :root{
            --feu-green: #007a3d;
            --feu-yellow: #ffd400;
            --muted: #f5f8f6;
            --text-dark: #08321a;
        }

        html, body { height: 100%; }
        body { display: flex; flex-direction: column; }
        main { flex: 1 0 auto; }
        footer { flex-shrink: 0; }

        .itso-container{max-width:1100px;margin:0 auto;padding:3rem 1rem}
        .itso-card{background:white;border-radius:8px;padding:1.25rem;box-shadow:0 6px 18px rgba(3,27,15,.08)}
        .itsh-badge{display:inline-block;background:var(--feu-yellow);color:var(--text-dark);padding:.35rem .6rem;border-radius:999px;font-weight:700}
        .itso-cta{background:var(--feu-yellow);color:var(--text-dark);border:0;padding:.75rem 1.1rem;border-radius:6px;font-weight:700}
        .itso-footer{background: linear-gradient(90deg,var(--feu-green),var(--feu-yellow));color:var(--text-dark);padding:1.5rem 0;margin-top:2rem}
    </style>
</head>
<body>