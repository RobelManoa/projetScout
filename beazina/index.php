<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beazina</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <h2 class="text-center mt-5 mb-3">Beazina</h2>
            <div class="col-md-6 float-end ps-5">
                <a class="btn btn-light p-5 float-end" href="./add.php" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Ampiditra Beazina">
                    <h1><i class="fa-solid fa-user-plus"></i></h1>
                </a>
            </div>
            <div class="col-md-6">
                <a class="btn btn-light p-5" href="./list.php" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Listry ny beazina">
                    <h1><i class="fa-solid fa-clipboard-list"></i></h1>
                </a>
            </div>
        </div>
    </div>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>