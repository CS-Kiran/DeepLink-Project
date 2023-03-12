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
            border: 1px solid transparent;
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
            padding: 10px;
            min-width: max-content;
            font-size: 20px
        }

        #back {
            position: absolute;
            margin-left: 75%;
            background: #613fe5;
            padding: 10px;
            min-width: max-content;
            font-size: 20px;
        }

        #back:hover,
        #history:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px 0 #613fe5, 0 5px 5px 0 #613fe5;
        }

        button:hover {
            transform: scale(1.2);
            box-shadow: 0 0 20px 0 #b5b5b5, 0 5px 5px 0 #120e16;
        }
    </style>
    <a href="./history.php"><button id="history">History</button></a>
    <a href="../Dashboard/dashboard.php"><button id="back">Back</button></a>
    <h1>New Request</h1>
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
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>RECEIVED ON</th>
                <th scope="col" style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'>ACTION</th>
            </tr>
        </thead>

        <?php

        $dept_id = $_SESSION['dept_id'];
        $query = "SELECT * from collab_req_details where receiver_dept_id = $dept_id AND req_status='f' ORDER BY posted_on ASC";
        $result = pg_query($conn, $query);
        while ($row = pg_fetch_array($result)) {
        ?>
            <tbody>
                <tr>
                    <?php $id = $row['request_id']; ?>
                    <td style='text-align:center;'><?php echo $row['sender_dept_id']; ?></td>
                    <td style='width:max-content; text-align:center;font-weight:600;font-size:larger;'><?php echo $row['from_department_name']; ?></td>
                    <td style='text-align:center'><?php echo $row['project_id']; ?></td>
                    <td style='text-align:center'><?php echo $row['budget_in_lakh']; ?></td>
                    <td style='text-align:center'><?php echo $row['duration']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['subject']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['content']; ?></td>
                    <td style='width:max-content;text-align:center'><?php echo $row['posted_on']; ?></td>
                    <td style="width:10rem;height:10rem;">
                        <form action="status.php?id=<?php echo $id; ?>" method="post">
                            <button name="approve">ACCEPT</button><br>
                            <button name="decline" style="background: #850f0f;">DECLINE</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</body>

</html>