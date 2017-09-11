$('document').ready( 
  function () { 
  console.log('loaded'); 		
  function  pjaxrequest() { 
   					var val = $('#find').val();
  					$.pjax({url: 'http://'+ window.location.host  + '/org/orglist?nameOrg='+val, 
							push: false,
							container: '#searorg',
    						history: false,
							});
		  };		    		
   	
  //собите для выбора орагниазции из списка	
  $('#searorg').on('pjax:success', function () {
      	$('.item-list').click(function () {
				var z = $(this).find('input').val();
    			$('#regisin-idorg').val(z);
    		    $('#find').val(	$(this).find('span').text());
			})
       }); 	
    		
  pjaxrequest(); 
    		
  $('#find').keyup(function () {
    		 pjaxrequest();
		});
    	});