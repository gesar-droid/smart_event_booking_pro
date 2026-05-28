<?php 
require_once 'config/auth.php'; 
require_login(); 
require_once 'config/db.php'; 
$id=$_GET['id']??0; 
$stmt=$pdo->prepare('SELECT * FROM events WHERE id=?');
$stmt->execute([$id]);$event=$stmt->fetch(PDO::FETCH_ASSOC); 
if(!$event){die('Event not found');} 
$msg=''; 
if($_SERVER['REQUEST_METHOD']==='POST'){ $tickets=max(1,(int)$_POST['tickets']); 
$stmt=$pdo->prepare('INSERT INTO bookings(user_id,event_id,tickets,total_price,status) VALUES(?,?,?,?,"Confirmed")'); 
$stmt->execute([$_SESSION['user_id'],$id,$tickets,$tickets*$event['price']]); 
$pdo->prepare('INSERT INTO audit_logs(user_id,action,details) VALUES(?,?,?)')->execute([$_SESSION['user_id'],'Created booking',$event['title']]); $msg='Booking confirmed successfully.';} 
include 'header.php'; 
?><div class="card"><div class="event-img" style="height:180px">🎫</div>
<h1><?php echo e($event['title']); ?></h1>
<p>
    <span class="badge badge-open"><?php echo e($event['status']); ?></span>
     <span class="badge badge-ai"><?php echo e($event['category']); ?></span>
    </p>
    <p class="muted">Venue: <?php echo e($event['venue']); ?> | Date: <?php echo e($event['event_date']); ?> | Price: $<?php echo e($event['price']); ?></p>
    <p><?php echo nl2br(e($event['description'])); ?></p>
    <?php if($msg): 
        ?><div class="alert alert-success"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form method="post" class="form">
            <label>Number of Tickets</label>
            <input type="number" name="tickets" min="1" max="10" value="1">
            <button class="btn btn-success" style="margin-top:15px">Book Tickets</button>
        </form>
    </div>
    <?php include 'footer.php'; 
    ?>