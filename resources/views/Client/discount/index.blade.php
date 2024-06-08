<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Codes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<style>
    .discount-item {
    border: 1px solid #ddd;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
}

.discount-item:hover {
    transform: translateY(-5px);
}

.discount-item h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
}

.discount-item p {
    margin-bottom: 10px;
    color: #555;
}

.copy-button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.2s ease-in-out;
}

.copy-button:hover {
    background-color: #218838;
}

</style>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Current Discounts</h1>
        <div class="row">
            <!-- Discount Item -->
            <div class="col-md-4">
                <div class="discount-item">
                    <h2>Code: <strong>SUMMER20</strong></h2>
                    <p>Type: Percent</p>
                    <p>Value: 20%</p>
                    <p>Expires At: 2024-12-31</p>
                    <button class="copy-button" data-code="SUMMER20">Copy Code</button>
                </div>
            </div>
            <!-- More discount items can be added here -->
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.querySelectorAll('.copy-button').forEach(button => {
            button.addEventListener('click', () => {
                const code = button.getAttribute('data-code');
                navigator.clipboard.writeText(code).then(() => {
                    alert('Discount code copied to clipboard: ' + code);
                });
            });
        });
    </script>
</body>
</html>
