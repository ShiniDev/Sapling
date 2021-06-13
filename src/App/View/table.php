<?php

use Sapling\Functions\Url;
?>
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
                print '</tr>';
            endforeach
            ?>
        </tbody>
    </table>
</body>

</html>