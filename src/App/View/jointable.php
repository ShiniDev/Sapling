<html>

<head>
    <meta charset="utf-8">
    <meta lang="en-US">
    <title>Test Table</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Language</th>
                <th>Hobby</th>
                <th>Birthday</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['table'] as $row) :
                print '<tr>';
                print '<td>' . ($row['test_id'] ?? "") . '</td>';
                print '<td>' . ($row['name'] ?? "") . '</td>';
                print '<td>' . ($row['phone'] ?? "") . '</td>';
                print '<td>' . ($row['address'] ?? "") . '</td>';
                print '<td>' . ($row['language'] ?? "") . '</td>';
                print '<td>' . ($row['hobby'] ?? "") . '</td>';
                print '<td>' . ($row['birthday'] ?? "") . '</td>';
                print '</tr>';
            endforeach
            ?>
        </tbody>
    </table>
</body>

</html>