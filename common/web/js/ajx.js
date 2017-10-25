




//отображаем заголовоки выбарнного файла
$('.files a').click(function () {
   var aid =  $(this).attr("id");
    

   var  p =  $(this).parent().find('.column');
    
    var dt = {id:aid};
    ajx("show", dt, function (data) { p.html(data);});
    
    
 
    
});


//запрос на загрузку данных в бд

$('.tbl a').click( function () {
    
var sel;
var pole = [];

sel = $(this).parent().parent().parent();

    var fileSpan = $(sel).find("input:hidden[name='pathfile']").val();
    var elementCheck = $(sel).find("input:checked");
    var nameFile =$(sel).find("input:hidden[name='namefile']").val();
    var cmnt = $(sel).find("input:text[name='comment']").val();
  
    var sp  = $(sel).find("span[name='load']");
    sp.html('Идет загрузка');
    
 for (var i=0;i<elementCheck.length;i++)
    {
         pole.push(elementCheck[i].value)
     
    }
    
  
var dt =  {file: fileSpan,
                cheks: pole,
                basefile: nameFile,
                comment: cmnt};
            
var fnc= function (data) {
                 sp.html('ГОТОВО');
            };
            
            ajx('/backend/site/import', dt, fnc );
            

});







function ajx(url, dt, fnc) {
   
	var dataResult;
	$.ajax({
       url: url,
       type: 'POST',    
       data: dt,
    success: function (data)    {
        		
    	fnc(data);    	
    }
       
});
	
	
    
}