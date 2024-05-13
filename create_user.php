<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        <select id="rolle" name="rolle" required>
        <option value="" disabled selected>Select a roll</option>
            <option value="niedrig">User</option>
            <option value="mittel">Support</option>
            <option value="hoch">Admin</option>
        </select>
        
        <input type="submit" value="Submit">
    </form>

        

</body>
</html>


