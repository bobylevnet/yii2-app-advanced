/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#buttonload').click(
        
        
        function ()
        {
            $.ajax({
               url: 'site/fileload',
               success: function(){
                       alert('Load was performed.'); }
                       
                   } );
            
        }
        
        
        )
       
        