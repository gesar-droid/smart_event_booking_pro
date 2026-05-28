<?php 
require_once 'config/auth.php'; 
require_admin(); 
require_once 'config/db.php'; 
$id=$_GET['id']??null; 
$event=['title'=>'','category'=>'Music','venue'=>'','event_date'=>'','price'=>'','capacity'=>'','status'=>'Open','description'=>'','ai_log'=>'']; 
if($id){$stmt=$pdo->prepare('SELECT * FROM events WHERE id=?');
$stmt->execute([$id]);$event=$stmt->fetch(PDO::FETCH_ASSOC);} 
if($_SERVER['REQUEST_METHOD']==='POST'){ $data=[trim($_POST['title']),$_POST['category'],trim($_POST['venue']),$_POST['event_date'],$_POST['price'],$_POST['capacity'],$_POST['status'],trim($_POST['description']),trim($_POST['ai_log']),$_SESSION['user_id']]; 
if($id){$stmt=$pdo->prepare('UPDATE events SET title=?,category=?,venue=?,event_date=?,price=?,capacity=?,status=?,description=?,ai_log=?,updated_by=?,updated_at=NOW() WHERE id=?');
$stmt->execute([...$data,$id]); 
$pdo->prepare('INSERT INTO audit_logs(user_id,action,details) VALUES(?,?,?)')->execute([$_SESSION['user_id'],'Updated event',$_POST['title']]);}else{$stmt=$pdo->prepare('INSERT INTO events(title,category,venue,event_date,price,capacity,status,description,ai_log,created_by,updated_by) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
$stmt->execute([...$data,$_SESSION['user_id']]); $pdo->prepare('INSERT INTO audit_logs(user_id,action,details) VALUES(?,?,?)')->execute([$_SESSION['user_id'],'Created event',$_POST['title']]);
} 
header('Location: events.php'); 
exit;} 
include 'header.php'; 
?><h1><?php echo $id?'Edit Event':'Create Event'; ?></h1>
<form class="form" method="post">
    <div class="row"><div>
        <label>Title</label>
        <input id="title" name="title" required value="<?php echo e($event['title']); 
        ?>"></div><div>
            <label>Category</label>
            <select id="category" name="category"><?php foreach(['Music','Workshop','Sport','Networking','Food'] as $c): 
                ?><option <?php if($event['category']==$c) echo 'selected'; ?>><?php echo $c; 
                ?></option><?php endforeach; 
                ?></select></div></div><div class="row"><div>
                    <label>Venue</label>
                    <input id="venue" name="venue" required value="<?php echo e($event['venue']); 
                    ?>"></div><div>
                        <label>Date & Time</label>
                        <input type="datetime-local" name="event_date" required value="<?php echo str_replace(' ','T',substr($event['event_date'],0,16)); ?>">
                    </div></div>
                    <div class="row"><div>
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" value="<?php echo e($event['price']); 
                        ?>"></div><div>
                            <label>Capacity</label>
                            <input type="number" name="capacity" value="<?php echo e($event['capacity']); 
                            ?>"></div></div>
                            <label>Status</label>
                            <select name="status">
                                <option>Open</option>
                                <option>Sold Out</option>
                                <option>Cancelled</option></select>
                                <label>Description <span class="badge badge-ai">AI assisted</span></label>
                                <textarea id="description" name="description" rows="6" required><?php echo e($event['description']); 
                                ?></textarea><input type="hidden" id="ai_log" name="ai_log" value="<?php echo e($event['ai_log']); 
                                ?>"><p>
                                    <button type="button" class="btn btn-light" onclick="makeDescription()">Generate AI Suggestion</button> 
                                    <span class="muted">Human review required before saving.</span>
                                </p>
                                <button class="btn btn-primary">Save Event</button>
                            </form><?php include 'footer.php'; 
                            ?>