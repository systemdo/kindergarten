kindergarten = new Kindergarten();

function Kindergarten()
{
	this.buildTable = function()
	{
		$('.table').dataTable({
			 ///"order": [[ 3, "desc" ]],
			   //"sPaginationType": "full_numbers",
			   //"aoColumnDefs": [
                 //   { "sClass": "center"}
				//]
		});
	}
    
    this.layoutDate = function ()
    {	
	    $( ".birth" ).datepicker({
		inline: true,
		dateFormat: 'yy-mm-dd',
		showAnim:'clip',
		changeMonth: true,
      	changeYear: true
		});
	}
	
	this.layoutSelect = function()
	{
		$( ".selectmenu" ).selectmenu();	
	}

	this.layoutChoose = function()
	{
		 $( "#selectable" ).selectable({
      		stop: function() {
      			//console.debug(this);
      			var ui = $(this).find(".ui-selected");
      			id = ui.attr('id');
		 		url = "sessionkg";
		 		data = "id="+id;
		 		
		 		$.ajax({
                    data:  data,

                    url:   url,

                    type:  'post',

                    dataType: "json",


                    success: function(data)
                    {
                    	if(data.data == true)
                    	{
                    		location.href="/app_dev.php/children";
                    	}
                    }

                    
            		}); 	
      		}
      });
	}
	this.ClockIn = function()
	{
		 $( "#selectable" ).selectable({
      		stop: function() {
      			//console.debug(this);
      			var ui = $(this).find(".ui-selected");
      			id = ui.attr('id');	
      });
	}

	this.layoutMultiChoose = function()
	{
		 $( ".selectable" ).selectable();
      		
	}

	this.layoutTabs = function()
	{
		$( "#tabs" ).tabs({
			collapsible: true
		});

	}


	 this.layoutDrag = function (){
	  $( ".drag" ).draggable({
      //appendTo: "#attendance",
      helper: "clone",
      cursor: "move",
     //containment: "document",
      //stack: "#attendance div",
      //snap: true
    });
	}  
	  
	 this.panelAccordion = function()
	{  
	  
	  	$( ".accordion" ).accordion({
      		collapsible: true,
      		heightStyle: "content"
    	});
	}

	this.modal = function (html, tittle)
	{
		var tittle = false;
		var content = html;
		var close = "Close";
		var save = "Save";
		var modal = '<div class="modal">';
				modal += '<div class="modal-dialog">';
		    		modal +='<div class="modal-content">';
		    		modal +='  <div class="modal-header">';
		    //modal +='    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
		    		modal +=	'<h4 class="modal-title">';
		    modal+= tittle;
		   						modal+='</h4></div>';
			//modal+='</div>';
		    modal +='<div class="modal-body"><p>';
         modal+= content;
       	modal+='</p></div>';
      	//modal +='<div class="modal-footer">';
        //modal +='<button type="button" class="btn btn-default" data-dismiss="modal">'+close+'</button>';
        ///modal +='<button type="button" class="btn btn-primary">'+save+'</button>';
      	modal +='</div>';
      	modal +='</div>';
      	
	return modal;
	}

	this.infoChild = function ()
	{
		
		$('.thumbnail').on('click','.infochild', function(e){
		 e.preventDefault();
		 var id_child = $(this).attr('id-child');
		 data = "id="+id_child;
		 url = "infochild"
		 $.ajax({
                    data:  data,

                    url:   url,

                    type:  'post',

                    dataType: "html",

                    success: function(html)
                    {
                       
                        $('#modal').empty();
                        $('#modal').append(html);
                        //$('#modal').append(kindergarten.modal(html, 'Children'));
                        $('#modal').dialog({
                        	//autoOpen: false,
                        	height: 500,
      						width: 800,
                        	modal:true,
                        	 open: function() {
        						//$('.ui-widget-overlay').addClass('.modal-content');
        						$('.ui-widget-content').css('background', '#13a0aa');
        						//$('.ui-widget-content').css('back');
        						//$('#modal').css('background-color', '#f5f5f5');
        						//$('#modal').css('border', '1px solid #cccccc');
        						//$('.ui-dialog-content').addClass('modal-content');
        						$('#menu').removeClass('navbar-fixed-top');
        						$('#menu').addClass('navbar-top');
    						},
    						close: function()
    						{
    							$('#menu').addClass('navbar-fixed-top');
        						$('#menu').removeClass('navbar-top');	
        						$('#modal').empty();
    						}
                        });
                    }
            }); 	
		});
	}  
	 
} 
						