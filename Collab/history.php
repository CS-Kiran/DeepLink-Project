<?php include("../connection.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Notifications</title>
</head>

<body>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background: #f6f6f7;
            color: #120e16;
        }

        h1 {
            text-align: center;
            font-size: 50px;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
        }

        button {
            padding: 5px;
            color: #f6f6f7;
            background: green;
            border-radius: 5px;
            border: 1px solid #613fe5;
            margin-top: 20px;
            margin-left: 40px;
            display: inline-block;
            font-size: large;
            min-width: max-content;
            cursor: pointer;
        }

        table {
            align-content: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }

        #history {
            margin-left: 5%;
            background: #613fe5;
            padding:10px;
            min-width: max-content;
            font-size: 20px
        }

        #back{
            position: absolute;
            margin-left: 75%;
            background: #613fe5;
            padding:10px;
            min-width: max-content;
            font-size: 20px;
        }
        button:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px 0 #613fe5, 0 5px 5px 0 #613fe5;
        }
        h2{
            padding-top: 50px;
            text-align: center;
            font-size: 30px;
        }

    </style>
    <a href="./notification.php"><button id="back">Back</button></a>
    <h1>Request History</h1>
    <h2 style="color:red;">Received</h2>
    <table class="tab" border='3' cellspacing='0'>
        <thead>
            <tr>
                <th scope="col" style='width:max-content; text-align:center; font-size:18px; border: 2px solid; padding: 10px'>FROM</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>DEPARTMENT NAME</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>PROJECT ID</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>BUDGET(in Lakh)</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>ESTIMATED DATE</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>SUBJECT</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>CONTENT</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>POSTED ON</th>
            </tr>
        </thead>

        <?php

        $dept_id = $_SESSION['dept_id'];
        $query = "SELECT * from collab_req_details where receiver_dept_id = $dept_id ORDER BY posted_on ASC";
        $result = pg_query($conn, $query);
        while ($row = pg_fetch_array($result)) { ?>
            <tbody>
                <tr>
                    <td style='text-align:center;'><?php echo $row['sender_dept_id']; ?></td>
                    <td style='width:max-content; text-align:center;font-weight:600;font-size:larger;'><?php echo $row['from_department_name']; ?></td>
                    <td style='text-align:center'><?php echo $row['project_id']; ?></td>
                    <td style='text-align:center'><?php echo $row['budget_in_lakh']; ?></td>
                    <td style='text-align:center'><?php echo $row['duration']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['subject']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['content']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['posted_on']; ?></td>
                </tr>

            </tbody>
        <?php } ?>
    </table>


    <h2 style="color:green;">Send</h2>
    <table class="tab" border='3' cellspacing='0'>
        <thead>
            <tr>
                <th scope="col" style='width:max-content; text-align:center; font-size:18px; border: 2px solid; padding: 10px'>FROM</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>DEPARTMENT NAME</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>PROJECT ID</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>BUDGET(in Lakh)</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>ESTIMATED DATE</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>SUBJECT</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>CONTENT</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>POSTED ON</th>
            </tr>
        </thead>

        <?php

        $dept_id = $_SESSION['dept_id'];
        $query = "SELECT * from collab_req_details where sender_dept_id = $dept_id ORDER BY posted_on ASC";
        $result = pg_query($conn, $query);
        while ($row = pg_fetch_array($result)) { ?>
            <tbody>
                <tr>
                    <td style='text-align:center;'><?php echo $row['sender_dept_id']; ?></td>
                    <td style='width:max-content; text-align:center;font-weight:600;font-size:larger;'><?php echo $row['from_department_name']; ?></td>
                    <td style='text-align:center'><?php echo $row['project_id']; ?></td>
                    <td style='text-align:center'><?php echo $row['budget_in_lakh']; ?></td>
                    <td style='text-align:center'><?php echo $row['duration']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['subject']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['content']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['posted_on']; ?></td>
                </tr>

            </tbody>
        <?php } ?>
    </table>
</body>

</html>