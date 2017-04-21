/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('.tbl a').click( function () 
{
    
var sel;
var pole = [];

sel = $(this).parent().parent().parent();

    var fileSpan = $(sel).find("input:hidden[name='pathfile']").val();
    var elementCheck = $(sel).find("input:checked");
    var nameFile =$(sel).find("input:hidden[name='namefile']").val();
    var cmnt = $(sel).find("input:text[name='comment']").val();
  
    var im = $(sel).find("img[name='load']");
    im.show();
    
 for (var i=0;i<elementCheck.length;i++)
    {
    pole.push(elementCheck[i].value)
     
    }
$.ajax({
       url: '/site/import',
       type: 'POST',    
       data: {
                file: fileSpan,
                cheks: pole,
                basefile: nameFile,
                comment: cmnt,
                
    },
    success: function (data)    {
        
        im.hide();
        alert('all ok');
    }
       
});

});
