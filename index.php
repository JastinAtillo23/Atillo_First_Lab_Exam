<!DOCTYPE html>

<html lang="en">

<head>

 <meta charset="UTF-8">

 <title>Student Records Dashboard</title>

 <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="dashboard-container">
  <h2>Student Records</h2>
  <a href="pages/create_SR.php" class="add-btn">Add Student +</a>
  <div class="records-list">
   <div class="student-card">
    <h3>John Doe</h3>
    <p><strong>ID:</strong> 12345</p>
    <p><strong>Email:</strong> john@example.com</p>
    <p><strong>Course:</strong> BSIT</p>
    <a href="pages/edit_SR.php?id=12345" class="edit-btn">Edit</a>
   </div>
  </div>
 </div>
</body>
</html>