<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .outer-box {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .logout-container {
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logout-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .logout-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .logout-container form {
            display: flex;
            justify-content: center;
        }

        .logout-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="outer-box">
        <div class="logout-container">
            <h1>Logout</h1>
            <p>Are you sure you want to logout?</p>
            <form action="logout_process.php" method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
