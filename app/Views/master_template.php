<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<style>
    .topbar {
        display: none !important;
    }

    #swagger-ui {
        max-width: 650px;
    }
</style>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="/">
                <img src="/favicon.ico" alt="Logo" width="30" height="30" class="d-inline-block align-top">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/docs">Docs</a>
                    </li>
                    <li class="nav-item">
                        <select id="langSelect" onchange="search()" class="custom-select">
                            <option value="en" <?= $_SESSION['language'] === 'en' ? 'selected' : '' ?>>English</option>
                            <option value="pt" <?= $_SESSION['language'] === 'pt' ? 'selected' : '' ?>>Português</option>
                        </select>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container" style="margin: 0 auto;">
        <?= $this->section('content') ?>
    </main>

    <footer class="bg-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 text-center text-md-left mb-2 mb-md-0">
                    <p class="mb-0">&copy; <?= date('Y') ?>
                        <a target="_blank" rel="noopener noreferrer" href="https://github.com/JeanCSF" class="text-dark">JeanCSF</a>
                    </p>
                </div>

                <div class="col-12 col-md-6 text-center text-md-right">
                    <a href="/docs" class="btn btn-link text-dark">Docs</a>
                    <a href="https://www.linkedin.com/in/jean-carlos-6149a2232/" target="_blank" rel="noopener noreferrer" class="btn btn-link text-dark ml-3">
                        LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="/assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <?= $this->section('scripts') ?>
</body>

</html>