<?php
function loop_tasks() {
	$admin_role = $_COOKIE["open_login"] ? 'admin-role' : '';
	$page = $_POST['page'] ? $_POST['page'] : 1;
	$sort = $_POST['sort'] ? $_POST['sort'] : 'name';
	$order = $_POST['order'] ? $_POST['order'] : 'ASC';
	if($sort == 'status') $sort = 'status '.$order.', status_edited';
	$pages =  ceil(mysql_num_rows(mysql_query("SELECT * FROM tasks")) / 3);
	$limit_from = ($page-1)*3;
	$result = mysql_query("SELECT ID, name, email, content, status, status_edited FROM tasks ORDER BY ".$sort." ".$order." LIMIT ".$limit_from.", 3");
	?>
	<div class="item row">
		<div class="col-sm-2">Имя</div>
		<div class="col-sm-2">E-mail</div>
		<div class="col-sm-6">Текст задачи</div>
		<div class="col-sm-2">Статус</div>
	</div>  
	<?php
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {?>
		<div class="item row <?php echo $admin_role; ?>" item-id="<?php echo $row["ID"]; ?>">
			<div class="col-sm-2"><?php echo $row["name"]; ?></div>
			<div class="col-sm-2"><?php echo $row["email"]; ?></div>
			<div class="col-sm-6 txt-task"><?php echo $row["content"]; ?></div>
			<div class="col-sm-2">
				<div class="status"><?php echo $row["status"]; ?></div>
				<div class="status-edited"><?php echo $row["status_edited"]; ?></div>
			</div>
		</div>
	<?php }	
	if($pages > 1){ ?>
		<div class="item row pagi no-paddings">
			<div class="col-sm-12">
				<?php for ($i=1; $i <= $pages; $i++) { ?>
					<a href="" class="<?php echo ($i==$page) ? 'current-page' : ''; ?>"><?php echo $i; ?></a>
				<?php } ?>
			</div>
		</div> 
		<?php
	}
}

