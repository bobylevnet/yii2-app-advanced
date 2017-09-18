



$('document').ready( 
  function () { 		
  function  pjaxrequest() { 
   					var val = $('#find').val();
  					$.pjax({url: 'http://'+ window.location.host  + '/org/orglist?nameOrg='+val, 
							push: false,
							container: '#searorg',
    						history: false,
							});
		  };		
		  
		  
   	
  //собите для выбора орагнизации из списка	
  $('#searorg').on('pjax:success', function () {
      	$('.item-list').click(function () {
				var z = $(this).find('input').val();
				var userList='';
				var userArr='';
    			$('#regisin-idorg').val(z);
    		    $('#find').val(	$(this).find('span').text());
    		    
    		    //функция заполнения dropdownlist  		    
    		    var fillDropDownList = function (data) {
    		    	$.each(data, function (index, value) {
        		    	//заполянем список людей из организации от куда письмо
        		    	$('#regisin-iduserorg').html(
        		    			$('<option></option>').val(value.idUser).html(value.nameUser)
        		    			);
        		    });
    		    }

    		    //делаем запром на получение списка рук. выбранной организации
    		    ajx('http://'+ window.location.host  + '/user/jsuser?idOrg='+z, '' , fillDropDownList );
    		    
    		   
    		    
    		
			})
       }); 	
    		
 // pjaxrequest(); 
    		
  $('#find').keyup(function () {
    		 pjaxrequest();
		});
  });