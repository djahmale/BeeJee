jQuery(function($) {

  var TasksHandler = function() {
    $( document.body )
      .on( 'click', '.admin-role', this.onClickEditTask )
      .on( 'submit', '#modalAddForm form', this.onSubmitAddForm )
      .on( 'submit', '#modalEditForm form', this.onSubmitEditForm )
      .on( 'click', '.pagi a:not(.current-page)', this.onChangeOrderPagi )
      .on( 'change', '.order form select', this.onChangeOrderPagi );                                
  };


    TasksHandler.prototype.onClickEditTask = function( e ) {
    	e.preventDefault();
    	var id = $(this).attr('item-id'),
        	$form = $('#modalEditForm'),
        	content = $(this).find('.txt-task').html(),
        	status = $(this).find('.status').html(),
        	status_edited = $(this).find('.status-edited').html();
        	console.log(content);
        if(status == "Выполнено"){
        	$form.find('input[name=status]').attr('checked', 'checked');
        } else {
        	$form.find('input[name=status]').removeAttr('checked');
        }	
       	$form.find('textarea[name=content]').val(content);
        $form.find('input[name=task-id]').val(id);
        $form.find('input[name=status_edited]').val(status_edited);
        $.cookie('old_content', content);
        $form.show();
        $form.animate({ opacity: 1 }, "normal");  
    };


	TasksHandler.prototype.onSubmitAddForm = function( e ) {
        e.preventDefault();
        var form = $(this); 
        var error = false; 
        form.find('.requred').each( function(){ 
            $(this).removeClass('error-input');
            $('.error-field').html('');
            if ($(this).val() == '') {
                $(this).addClass('error-input');            
                error = true;
            }
        });
        if (!error) {
            var data = form.serialize();             
            $.ajax({
                type: 'POST', 
                url: 'add-task.php', 
                data : data,
                beforeSend: function(data) {
                    $('#loader-wrapper').removeClass('deactive');
                  },
                success: function(data){					
                    if (data == 'error') {
                        $('input[name=email]').addClass('error-input');
                        $('.error-field').html('Не верный формат E-mail');                                                                                                                                                                                    
                    } else {
                    	$('.content-table').html(data);
				        $('.modal').animate({ opacity: 0 }, "fast");
				        $('.modal').hide();                     	
				        var $form = $('#modalSuccessForm');
				        $form.show();
				        $form.animate({ opacity: 1 }, "normal");                                                                                                                                                           
                    }
                 },
                complete: function(data) {
                	$('#loader-wrapper').addClass('deactive');
                 }
                          
            });
        } else {
            $('.error-field').html('Заполните обязательные поля');            
        }
        return false;
	};


	TasksHandler.prototype.onSubmitEditForm = function( e ) {
        e.preventDefault();
        var form = $(this); 
        var data = form.serializeArray();
    	var sort = $('.order select').val();
    	var page = $('.current-page').html(); 
    	data.push({name : 'sort', value : sort});
    	data.push({name : 'page', value : page});                         
        $.ajax({
            type: 'POST', 
            url: 'edit-task.php', 
            data : $.param(data),
            beforeSend: function(data) {
                $('#loader-wrapper').removeClass('deactive');
              },
            success: function(data){	
		        $('.modal').animate({ opacity: 0 }, "fast");
		        $('.modal').hide();   				
                if (data == 'error') {
			        var $form = $('#modalLoginForm');
			        $form.show();
			        $form.animate({ opacity: 1 }, "normal");                                                                                                                                                                                     
                } else {
                	$('.content-table').html(data);                                                                                                                                                           
                }
             },
            complete: function(data) {
            	$('#loader-wrapper').addClass('deactive');
             }
                      
        });
        return false;
	}

	TasksHandler.prototype.onChangeOrderPagi = function( e ) {
    	e.preventDefault();	
    	var $thisbutton = $( this );
    	var sort = $('#orderby select').val();
    	var order = $('#order select').val();
    	var page = $('.current-page').html();
    	if($thisbutton.parent().parent().hasClass('pagi')){
    		page = $(this).html();
    	}
        $.ajax({
            type: 'POST', 
            url: 'loop.php', 
            data : {
            	sort : sort,
            	page : page,
            	order : order
            },            
            beforeSend: function(data) {
                $('#loader-wrapper').removeClass('deactive');
              },
            success: function(data){				
            	$('.content-table').html(data);
             },
            complete: function(data) {
            	$('#loader-wrapper').addClass('deactive');
             }
                      
        });   
	}

	new TasksHandler();




  $(document).ready(function(){
    $(".login button").on('click', function(e) {
    	e.preventDefault();
        var $form = $('#modalLoginForm');
        $form.show();
        $form.animate({ opacity: 1 }, "normal");  
	});  

    $(".add-task button").on('click', function(e) {
    	e.preventDefault();
        var $form = $('#modalAddForm');
        $form.show();
        $form.animate({ opacity: 1 }, "normal");  
	})

    $(".logout button").on('click', function(e) {
    	e.preventDefault();
    	$.cookie('open_login', '');
        location.reload();  
	});  	

    $("#modalLoginForm form").on('submit', function(e) {
        e.preventDefault();
        var form = $(this); 
        var error = false; 
        form.find('.requred').each( function(){ 
            $(this).removeClass('error-input');
            $('.error-field').html('');
            if ($(this).val() == '') {
                $(this).addClass('error-input');            
                error = true;
            }
        });
        if (!error) {
            var data = form.serialize();             
            $.ajax({
                type: 'POST', 
                url: 'auth.php', 
                dataType: 'json', 
                data : data,
                beforeSend: function(data) {
                    $('#loader-wrapper').removeClass('deactive');
                  },
                success: function(data){					
                    if (data['error']) {
                        $('input[name=login]').addClass('error-input');
                        $('input[name=pwd]').addClass('error-input');
                        $('.error-field').html('Не верный Логин или Пароль');                                                                                                                                                                                    
                    } else {
                    	$.cookie('open_login', 'yes');
                        location.reload();                                                                                                                                                          
                    }
                 },
                complete: function(data) {
                	$('#loader-wrapper').addClass('deactive');
                 }
                          
            });
        } else {
            $('.error-field').html('Заполните обязательные поля');            
        }
        return false;
    });     
  

    $(".close-btn, #modalSuccessForm button").on('click', function(e) {
        e.preventDefault();
        $('.modal').animate({ opacity: 0 }, "fast");
        $('.modal').hide(); 

    });      


  });

});