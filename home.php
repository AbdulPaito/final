<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Webpage Title</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light background color for contrast */
        }

        #home-section {
            background-image: url('exact.jpg');
            margin-top: -20px;
            margin-left: -20px;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column; /* Stacks children vertically */
            justify-content: flex-start; /* Aligns items to the start (top) */
            align-items: center;
            color: white;
            text-align: center;
            padding: 2em; /* Adjust padding as needed */
            box-sizing: border-box;
            position: relative;
        }

        header {
            background-color: #2575fc;
            padding: 1em 2em;
            border-radius: 20px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            backdrop-filter: blur(5px); /* Blurs the background under the header */
            width: 100%;
            max-width: 201300px;
            margin-top: -20px; /* Space from the top */
        }

        h1 {
            font-size: 2em; /* Adjust font size as needed */
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Text shadow for better readability */
        }

        p {
            font-size: 1.5em;
            margin: 10px 0 0 0; /* Space between heading and subheading */
        }

    </style>
</head>
<body>

<section id="home-section">
    <header>
        <h1>Welcome Admin</h1>
    </header>
</section>

</body>
</html>
