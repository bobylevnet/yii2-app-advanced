



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
    			$('#reg-idorg').val(z);
    			
    			//берем названия организации
    			var txtOrg = $(this).find('span').text();
    			//вставляем в поле поиск выбранное поле 
    		  //  $('#find').val(txtOrg);
    		    
    		   //инормационное поле указывает какая организация текущая
    		    $('[for="reg-idorg"]').html('Выбрано - '+ txtOrg);
    		    
    		    
    		    $('.list-view').remove();
    		    var path =  location.pathname.toString();
    		    //проверяем если мы на входящих тогда нужен запрос на заполнения листа с юзерами предприятия
    		  //  if (path.indexOf("regisin")>0)
    		   // {
    		    
    		    //функция заполнения dropdownlist  		    
    		    var fillDropDownList = function (data) {
    		    	$('#userorg').html('');	
    		    	$.each(data, function (index, value) {
        		    	//заполянем список людей из организации от куда письмо
        		    	$('#userorg').append(
        		    			$('<option></option>').val(value.idUser).html(value.nameUser)
        		    			);
        		    });
    		     //  }
    		    
    		    //делаем запром на получение списка рук. выбранной организации
    		    };
    		    ajx(window.location.protocol + '/user/jsuser?idOrg='+z, '' , fillDropDownList );
    		   
    		    
    		
			})
       }); 	
    		
 // pjaxrequest(); 
    		
  $('#find').keyup(function () {
    		 pjaxrequest();
		});
  });