!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Login - Student Management System</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="login-container">

  <h2>Welcome to Student Management System</h2>

  <p>Enter your Credentials to Login!</p>

  <form action="login.php" method="POST">
   <label for="username">Username</label>
   <input type="text" id="username" name="username" required>
   <label for="password">Password</label>
   <input type="password" id="password" name="password" required>
   <button type="submit">Login ➔</button>
  </form>
 </div>
</body>
</html>