function ajaxApp(data, url, success)
{
	$.ajax({
                data:  data,

                url:   url,

                type:  'post',

                dataType: "json",

                success: success
        });

}

$(document).ready(function() {
    	
   	$('.table').dataTable();
    
    	
    $( ".birth" ).datepicker({
	inline: true,
	dateFormat: 'yy-mm-dd',
	showAnim:'clip'
	});

	
	$( ".selectmenu" ).selectmenu();	

	 $( "#tabs" ).tabs();

	  $( ".accordion" ).accordion({
      collapsible: true
    });

	  $( ".drag" ).draggable({
      //appendTo: "#attendance",
      helper: "clone",
      cursor: "move",
     //containment: "document",
      //stack: "#attendance div",
      //snap: true
    });

	  var atten =  $( "#attendance" );
	  var noatten =  $( "#noattendance" );

	  atten.droppable({
	  accept: ".drag",	
      drop: function( event, ui ) {
        //console.debug(ui.draggable.find('thumbnail'));
        //console.log(ui.draggable.find('.thumbnail'));
        item = ui.draggable;
        var thumb =item.find('.thumbnail');
        var data = "accion="+thumb.attr('data-accion')+"&child_id="+thumb.attr('id-child');
        var url ="create";
        $.ajax({
                data:  data,

                url:   url,

                type:  'post',

                dataType: "json",

                success: function(data)
                {
                	becomeOnline(ui.draggable,data.data);
                }
        });
        //becomeOnline(ui.draggable);
      }
    });

	  noatten.droppable({
	  accept: ".drag",	
      drop: function( event, ui ) {
      	item = ui.draggable;
        var thumb =item.find('.thumbnail');
        var data = "accion="+thumb.attr('data-accion')+"&child_id="+thumb.attr('id-child');
        var url ="create";
        $.ajax({
                data:  data,

                url:   url,

                type:  'post',

                dataType: "json",

                success: function(data)
                {
                	becomeOffline(ui.draggable, data.data)
                }
        });
        //alert(thumb.attr('id-child'));
    }
    });


	  function becomeOnline(item,data)
	  {
	
	  	if(data == true)
	  	{
	  		item.appendTo(atten);
		  	$( ".accordion" ).accordion( "refresh" );
		  	//item.find('.status').remove();
		  	item.find('.status').removeClass(' label-info');
		  	item.find('.status').addClass(' label-danger');
		  	item.find('.status').text('online');
	  		//item.remove();
	  	}else{
	  			alert(data);
	  			return false;
	  		}	
	  }

	  function becomeOffline(item,data)
	  {
	  	
	  	if(data == true)
	  	{	
	  		item.appendTo(noatten);
		  	$( ".accordion" ).accordion( "refresh" );
		  	item.find('.status').removeClass(' label-danger');
		  	item.find('.status').addClass(' label-info');
		  	item.find('.status').text('offline');
	  	//item.remove();
	  	}else{
	  			alert(data);
	  			return false;
	  		}	
	  }
} );