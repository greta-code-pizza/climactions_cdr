<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>page forgot_password</title>
</head>

<body>
    <h1>page forgot_password</h1>
    <form action="indexAdmin.php?action=emailPost" method="POST">
        <div class="container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>
            <button type="submit">Send me a random password</button>
        </div>
    </form>
</body>

</html>