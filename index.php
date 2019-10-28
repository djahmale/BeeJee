
<html>
    <head>    	
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php 
		include $_SERVER['DOCUMENT_ROOT']. "/db.php";		 		
		$open_login = $_COOKIE["open_login"];
        ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
        <script src="/base.js"></script>
        <link href="/bootstrap.min.css" rel="stylesheet">
        <link href="/index.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
        	<div class="order">
        		<div class="row no-paddings">
        			<div class="col-sm-2">
						<form id="orderby" method="POST">
							<span>Сортировать по: </span>
							<select>
								<option value="name" <?php if($_POST['sort']=='name') echo 'selected'?>>имени</option>
								<option value="email" <?php if($_POST['sort']=='email') echo 'selected'?>>email</option>
								<option value="status" <?php if($_POST['sort']=='status') echo 'selected'?>>статусу</option>
							</select>
						</form>  
					</div>
        			<div class="col-sm-8">
						<form id="order" method="POST">
							<span>Порядок сортировки: </span>
							<select>
								<option value="ASC" <?php if($_POST['order']=='ASC') echo 'selected'?>>прямой</option>
								<option value="DESC" <?php if($_POST['DESC']=='email') echo 'selected'?>>обратный</option>
							</select>
						</form>  
					</div>					
					<div class="add-task col-sm-1">
						<button>Добавить</button>
					</div>
					<?php if($open_login){ ?>
						<div class="right-btn logout col-sm-1">
							<button>Выйти</button>
						</div>    
					<?php } else {?>
						<div class="right-btn login col-sm-1">
							<button>Войти</button>
						</div>  						
					<?php }?>
				</div>  		
        	</div>
        	<div class="content-table">      		
	        	<?php loop_tasks(); ?>
        	</div>
        </div>

		<div class="modal" id="modalLoginForm">
		  <div class="modal-dialog" role="document">
		  	<a href="" class="close-btn"></a>
		    <div class="modal-content">
		    	<form method="POST">
				    <div class="modal-header text-center">
				        <h4>Вход</h4>
				    </div>

				    <div class="modal-body">
			          	<input type="text" name="login"  class="requred" placeholder="Логин">
			          	<input type="password" name="pwd"  class="requred" placeholder="Пароль">
			        </div>

				    <div class="modal-footer">
				        <button type="submit">Войти</button>
				    </div>
				    <div class="error-field"></div>
			  </form>
		    </div>
		  </div>
		</div>

		<div class="modal" id="modalAddForm">
		  <div class="modal-dialog" role="document">
		  	<a href="" class="close-btn"></a>
		    <div class="modal-content">
		    	<form method="POST">
				    <div class="modal-header text-center">
				        <h4>Создайте задачу</h4>
				    </div>
				    <div class="modal-body">
			          	<input type="text" name="name"  class="requred" placeholder="Имя">
			          	<input type="text" name="email"  class="requred" placeholder="E-mail">		          	
			        </div>
			        <div><textarea name="content" class="requred" placeholder="Текст задачи"></textarea></div>

				    <div class="modal-footer">
				        <button type="submit">Создать</button>
				    </div>
				    <div class="error-field"></div>
			  </form>
		    </div>
		  </div>
		</div>	

		<?php if($open_login){ ?>
			<div class="modal" id="modalEditForm">
			  <div class="modal-dialog" role="document">
			  	<a href="" class="close-btn"></a>
			    <div class="modal-content">
			    	<form method="POST">
					    <div class="modal-header text-center">
					        <h4>Измените задачу</h4>
					    </div>
					    <div class="modal-body">
					    	<input type="hidden" name="task-id">
					    	<input type="hidden" name="status_edited">
					    	<label for="status">Выполнено</label>
				          	<input type="checkbox" name="status" id="status">		          	
				        </div>
				        <div><textarea name="content"></textarea></div>

					    <div class="modal-footer">
					        <button type="submit">Сохранить</button>
					    </div>
					    <div class="error-field"></div>
				  </form>
			    </div>
			  </div>
			</div>	
		<?php } ?>	

		<div class="modal" id="modalSuccessForm">
		  <div class="modal-dialog" role="document">
		  	<a href="" class="close-btn"></a>
		    <div class="modal-content">
		    	<form method="POST">
				    <div class="modal-header text-center">
				        <h4></h4>
				    </div>
				    <div class="modal-body">
						<h4>Задача добавлена успешно</h4>	          	
			        </div>
				    <div class="modal-footer">
				        <button>ОК</button>
				    </div>
				    <div class="error-field"></div>
			  </form>
		    </div>
		  </div>
		</div>				


    </body>

<?php
// SetCookie("Partner_id", '111', time()+120);
?>

<div id="loader-wrapper" class="deactive">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
     	<div class="loader-section section-right"></div>
</div>
	<?php mysql_free_result($result); ?>    
</html>

