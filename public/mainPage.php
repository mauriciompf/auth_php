<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>

    <style>
        table {
            border-collapse: collapse;
        }

        tr th,
        tr td {
            border: 1px solid black;
            padding: 1rem;
            text-align: center;
        }
    </style>

</head>


<body>
    <h1>Main Page</h1>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Register Date</th>
            </tr>
        </thead>

        <tbody>
            <?php
            require_once "../inc/fetchData.php";

            $users = fetchData();

            if (!empty($users)) {
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($user["email"]) . "</td>";
                    echo "<td>" . $user["reg_date"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>


</body>

</html>