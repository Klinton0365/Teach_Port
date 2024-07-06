<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>| Teacher Portal |</title>
    <link rel="stylesheet" type="text/css" href="assets/css/index.css" />
    <link rel="shortcut icon" type="image/png" href="image/logo.png" />
    <style type="text/css">
        body {
            width: 100%;
            background: url(assets/teach-1968076_1280.jpg);
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
    <script>
        // Initialize the agent at application startup.
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
            .then(FingerprintJS => FingerprintJS.load())
        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                const visitorId = result.visitorId
                document.cookie = "fingerprint = " + visitorId;
                //console.log(visitorId)
            })
    </script>
</head>

<body>
    <center>
        <div class="intro">
            <h1> Teacher Portal </h1>
            <a href="login.php" class="btn"> login </a> &emsp;
            <!-- <a href="register.php" class="btn"> register </a> -->
            <h2> Happy Learning </h2>
        </div>
    </center>
</body>

</html>