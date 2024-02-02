<?php
include 'auth_session.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="index.css">
    <title>University API</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <form>
            <div class="mb-3">
                <button type="button" name="university_api" class="btn btn-primary">University API</button>
            </div>
        </form>

        <table id="myTable" class="table table-bordered border-primary table-striped my-3 table-responsive">
            <thead>
                <tr class="text-center">
                    <th>University</th>
                    <th>Country Code</th>
                    <th>Country</th>
                    <th>Domain</th>
                    <th>Web Page</th>
                </tr>
            </thead>
            <tbody>
                <!-- Leave the tbody empty initially -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            let table = $('#myTable').DataTable();

            $('button[name="university_api"]').click(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'code.php',
                    success: function (response) {
                        updateTable(response);
                    },
                    error: function () {
                        console.error('Error fetching data from the server.');
                    }
                });
            });

            function updateTable(data) {
                if (data && data.length > 0) {
                    // Clear existing rows
                    table.clear();

                    $.each(data, function (index, university) {
                        // Add a new row to DataTable
                        table.row.add([
                            university.name,
                            university.alpha_two_code,
                            university.country,
                            university.domains.join(', '),
                            '<a href="' + university.web_pages[0] + '" target="_blank">' + university.web_pages.join(', ') + '</a>'
                        ]).draw();
                    });
                } else {
                    console.error('Invalid data received from the server.');
                }
            }
        });
    </script>
</body>

</html>
