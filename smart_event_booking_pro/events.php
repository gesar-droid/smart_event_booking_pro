<?php 
require_once 'config/auth.php'; 
require_login(); 
require_once 'config/db.php'; 
include 'header.php'; 
$q=trim($_GET['q']??''); 
$category=$_GET['category']??''; 
$sql='SELECT * FROM events WHERE 1'; 
$params=[]; if($q){$sql.=' AND (title LIKE ? OR venue LIKE ? OR description LIKE ?)'; 
$params=["%$q%","%$q%","%$q%"]; } if($category){$sql.=' AND category=?'; 
$params[]=$category;} 
$sql.=' ORDER BY event_date ASC'; 
$stmt=$pdo->prepare($sql); 
$stmt->execute($params); 
$events=$stmt->fetchAll(PDO::FETCH_ASSOC); 
?>
<h1>Events Catalogue</h1>
<p class="muted">Search, filter and view upcoming community events.</p>
<form class="searchbar">
    <input name="q" placeholder="Search event or venue" value="
    <?php echo e($q); ?>">
    <select name="category">
        <option value="">All categories</option>
        <?php foreach(['Music','Workshop','Sport','Networking','Food'] as $c): ?>
            <option <?php if($category==$c) echo 'selected'; ?>><?php echo $c; ?></option>
            <?php endforeach; ?></select>
            <button class="btn btn-primary">Search</button>
        </form><?php if(is_admin()): 
            ?><p>
                <a class="btn btn-primary" href="event_form.php">+ Add New Event</a>
            </p><?php endif; ?>
            <div style="display:grid;gap:16px"><?php foreach($events as $ev): ?>
                <div class="card event-card"><div class="event-img">🎟️</div><div>
                    <h2><?php echo e($ev['title']); ?> 
                    <span class="badge <?php echo $ev['status']=='Open'?'badge-open':'badge-sold'; ?>"><?php echo e($ev['status']); ?></span>
                </h2>
                <p class="muted"><?php echo e($ev['category']); ?> • <?php echo e($ev['venue']); ?> • <?php echo e($ev['event_date']); ?></p>
                <p><?php echo e(substr($ev['description'],0,180)); ?>...</p>
                <a class="btn btn-light" href="view_event.php?id=<?php echo $ev['id']; ?>">View Details</a>
                <?php if(is_admin()): 
                    ?> <a class="btn btn-warning" href="event_form.php?id=<?php echo $ev['id']; ?>">Edit</a> 
                    <a onclick="return confirmDelete()" class="btn btn-danger" href="delete_event.php?id=<?php echo $ev['id']; ?>">Delete</a>
                    <?php endif; ?>
                </div></div><?php endforeach; ?></div>
                <?php include 'footer.php'; ?>