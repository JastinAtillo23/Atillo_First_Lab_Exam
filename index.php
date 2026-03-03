<?php
include "db.php";
$result = mysqli_query($conn, "SELECT * FROM student");
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Records</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --accent: #2563eb;
    --accent2: #e87c5a;
    --text: #1e293b;
    --muted: #64748b;
    --border: rgba(0,0,0,0.08);
    --card: #ffffff;
  }

  body {
    background: radial-gradient(ellipse at 30% 20%, #dbeafe 0%, #f0f4ff 50%, #f8fafc 100%);
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding: 0;
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

  .container {
    max-width: 780px;
    margin: 0 auto;
    padding: 60px 24px;
    position: relative;
    z-index: 1;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 52px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--border);
  }

  header .title-block h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    letter-spacing: -0.02em;
    line-height: 1;
    color: var(--text);
  }

  header .title-block p {
    margin-top: 6px;
    color: var(--muted);
    font-size: 0.85rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  .add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--accent);
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.85rem;
    padding: 10px 20px;
    border-radius: 8px;
    letter-spacing: 0.04em;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .add-btn:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(37,99,235,0.3);
  }
  .add-btn::before { content: '+'; font-size: 1.1rem; font-weight: 300; }

  /* Student cards */
  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 28px 32px;
    margin-bottom: 16px;
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 0 28px;
    align-items: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s, transform 0.2s;
    animation: slideUp 0.4s ease both;
  }
  .card:hover {
    box-shadow: 0 8px 32px rgba(0,0,0,0.10);
    transform: translateY(-2px);
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .card:nth-child(2) { animation-delay: 0.05s; }
  .card:nth-child(3) { animation-delay: 0.10s; }
  .card:nth-child(4) { animation-delay: 0.15s; }
  .card:nth-child(5) { animation-delay: 0.20s; }

  .card-id {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: var(--accent);
    min-width: 90px;
    letter-spacing: -0.01em;
  }

  .card-info h3 {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text);
    margin-bottom: 4px;
  }
  .card-info p {
    font-size: 0.8rem;
    color: var(--muted);
    line-height: 1.8;
  }

  .card-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .btn-edit, .btn-delete {
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 6px;
    text-align: center;
    transition: all 0.2s;
  }
  .btn-edit {
    border: 1px solid var(--accent);
    color: var(--accent);
  }
  .btn-edit:hover {
    background: var(--accent);
    color: #ffffff;
  }
  .btn-delete {
    border: 1px solid rgba(232,124,90,0.4);
    color: var(--accent2);
  }
  .btn-delete:hover {
    background: var(--accent2);
    color: #fff;
  }

  .empty {
    text-align: center;
    padding: 80px 0;
    color: var(--muted);
  }
  .empty h3 { font-size: 1.1rem; font-weight: 500; color: var(--text); }
  .empty p { font-size: 0.9rem; margin-top: 8px; }

  @media (max-width: 560px) {
    .card { grid-template-columns: 1fr; gap: 16px; }
    .card-actions { flex-direction: row; }
    header { flex-direction: column; align-items: flex-start; gap: 20px; }
  }
</style>
</head>
<body>

<div class="container">
  <header>
    <div class="title-block">
      <h1>Student Records</h1>
      <p>Academic Registry</p>
    </div>
    <a href="pages/create_SR.php" class="add-btn">Add Student</a>
  </header>

  <?php if(mysqli_num_rows($result) == 0): ?>
    <div class="empty">
      <h3>No students yet</h3>
      <p>Click "Add Student" to get started.</p>
    </div>
  <?php else: ?>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="card">
      <div class="card-id"><?php echo htmlspecialchars($row['ID_number']); ?></div>
      <div class="card-info">
        <h3><?php echo htmlspecialchars($row['full_name']); ?></h3>
        <p><?php echo htmlspecialchars($row['Email']); ?></p>
        <p><?php echo htmlspecialchars($row['course']); ?></p>
      </div>
      <div class="card-actions">
        <a href="pages/edit_SR.php?id=<?php echo $row['ID_number']; ?>" class="btn-edit">Edit</a>
        <a href="pages/delete_SR.php?id=<?php echo $row['ID_number']; ?>" class="btn-delete">Delete</a>
      </div>
    </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>

</body>
</html>








