$('#helpDrop').change(function () {
	
	changeParameters( this.value);
	
})



function changeParameters(value)
{
	var url = window.location.href;
	
	var arr = url.split('?');
	
	arr[1] = '?model=' + value;
	
	window.location.href = arr[0] + arr[1];	
}



function fillForm(a)
{
	
	
	//строка грида
	var trow =  $(a).parent().parent();
	//имя таблицы 
	var tableName = $('input[name="tablename"]'	)	.val().toLowerCase();
	//
	var keyModel = $('input[name="keymodel"]').val().toLowerCase();
	//получаем ключе поле модели
	var js = JSON.parse(keyModel);
	//изем все td в текущией td
	var elements	= $(trow).find('td');
	//начинаем с 1 пропускаем поле выбор
	var i=1;
	for(var k in js)
	{
		var element = $('#'+tableName + '-' + k);
		
		if (element[0].tagName == 'SELECT')
			{
				element.find('option:contains('+$(elements[i]).html() + ')')[0].selected=true;
			}
		else
			{
			element.val($(elements[i]).html());
			}
		
		i++;
	}	
//	js.forEach( function (item, i, js) { alert(i);}	 );
 //  $('').
}




function resetCss(id, parentId)
{
	var append = $('#'+ id);
	//var elem = $('.column');
	//сбрасываем положение элемента в первоночальное
	$('#'+id).css({'top': '0px', 'left': '0px'});
	$('.'+ id).remove();
	//добавялем элемент где он был раньше только в  конец
	$('#' + parentId).append(append);
	
	
}