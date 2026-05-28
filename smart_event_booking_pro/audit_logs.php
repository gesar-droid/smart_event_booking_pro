<?php 
require_once 'config/auth.php'; 
require_admin(); 
require_once 'config/db.php'; 
include 'header.php'; 
$rows=$pdo->query('SELECT l.*,u.name FROM audit_logs l LEFT JOIN users u ON l.user_id=u.id ORDER BY l.created_at DESC LIMIT 50')->fetchAll(PDO::FETCH_ASSOC); ?>
<h1>Audit Logs</h1>
<p class="muted">Shows created/updated activities for accountability.</p>
<table class="table"><tr>
    <th>User</th>
    <th>Action</th>
    <th>Details</th>
    <th>Time</th></tr>
    <?php foreach($rows as $r): 
        ?><tr><td>
            <?php echo e($r['name']); ?>
        </td><td><?php echo e($r['action']); ?></td>
        <td><?php echo e($r['details']); ?></td>
        <td><?php echo e($r['created_at']); ?></td>
    </tr><?php endforeach; ?>
</table><?php include 'footer.php'; 
?>