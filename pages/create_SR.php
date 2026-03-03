<?php
include "../db.php";

$error = "";

if(isset($_POST['save'])) {

    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $fullname   = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $course     = mysqli_real_escape_string($conn, $_POST['course']);

    if(empty($student_id) || empty($fullname) || empty($email) || empty($course)) {
        $error = "All fields are required!";
    } else {

        $query = "INSERT INTO student (ID_number, full_name, Email, course) 
          VALUES ('$student_id', '$fullname', '$email', '$course')";

        if(mysqli_query($conn, $query)) {
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --accent: #2563eb;
    --accent2: #e87c5a;
    --text: #1e293b;
    --muted: #64748b;
    --border: rgba(0,0,0,0.08);
    --input-bg: #ffffff;
    --card: #ffffff;
  }

  body {
    background: radial-gradient(ellipse at 30% 20%, #dbeafe 0%, #f0f4ff 50%, #f8fafc 100%);
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 24px;
  }

  body::before {
    content: '';
    position: fixed;
    bottom: -150px; right: -150px;
    width: 500px; height: 500px;
    background: radial-gradient(circle, rgba(196,219,255,0.7) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
  }

  body::after {
    content: '';
    position: fixed;
    top: -100px; left: -100px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(199,210,254,0.5) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
  }

  .wrapper {
    width: 100%;
    max-width: 520px;
    position: relative;
    z-index: 1;
    animation: fadeUp 0.5s ease both;
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--muted);
    text-decoration: none;
    font-size: 0.8rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 32px;
    transition: color 0.2s;
  }
  .back-link:hover { color: var(--accent); }
  .back-link::before { content: '←'; }

  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 44px 40px;
    box-shadow: 0 4px 32px rgba(0,0,0,0.08);
  }

  .card-header {
    margin-bottom: 36px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
  }

  .card-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    letter-spacing: -0.02em;
    color: var(--text);
  }

  .card-header p {
    margin-top: 6px;
    color: var(--muted);
    font-size: 0.8rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  .error-msg {
    background: rgba(232,124,90,0.08);
    border: 1px solid rgba(232,124,90,0.3);
    color: var(--accent2);
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 0.85rem;
    margin-bottom: 24px;
  }

  .field {
    margin-bottom: 24px;
  }

  .field label {
    display: block;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 8px;
  }

  .field input, .field select {
    width: 100%;
    background: var(--input-bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.95rem;
    font-weight: 300;
    padding: 12px 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .field input:focus, .field select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
  }

  .field input::placeholder { color: rgba(100,116,139,0.4); }

  .actions {
    display: flex;
    gap: 12px;
    margin-top: 36px;
    padding-top: 24px;
    border-top: 1px solid var(--border);
  }

  .btn-save {
    flex: 1;
    background: var(--accent);
    color: #ffffff;
    border: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 13px 24px;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .btn-save:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(37,99,235,0.3);
  }
  .btn-save:active { transform: translateY(0); }

  .btn-cancel {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    color: var(--muted);
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 13px 24px;
    border-radius: 8px;
    transition: border-color 0.2s, color 0.2s;
  }
  .btn-cancel:hover { border-color: var(--muted); color: var(--text); }

  @media (max-width: 480px) {
    .card { padding: 32px 24px; }
    .actions { flex-direction: column; }
  }
</style>
</head>
<body>

<div class="wrapper">
  <a href="../index.php" class="back-link">Back to Records</a>

  <div class="card">
    <div class="card-header">
      <h1>Add Student</h1>
      <p>New enrollment entry</p>
    </div>

    <?php if(!empty($error)): ?>
      <div class="error-msg"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="field">
        <label for="student_id">Student ID</label>
        <input type="text" id="student_id" name="student_id" placeholder="e.g. 2024-0001"
               value="<?php echo isset($_POST['student_id']) ? htmlspecialchars($_POST['student_id']) : ''; ?>">
      </div>

      <div class="field">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="e.g. Juan dela Cruz"
               value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
      </div>

      <div class="field">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="e.g. juan@email.com"
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
      </div>

      <div class="field">
        <label for="course">Course</label>
        <input type="text" id="course" name="course" placeholder="e.g. BSIT"
               value="<?php echo isset($_POST['course']) ? htmlspecialchars($_POST['course']) : ''; ?>">
      </div>

      <div class="actions">
        <button type="submit" name="save" class="btn-save">Save Student</button>
        <a href="../index.php" class="btn-cancel">Cancel</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>




