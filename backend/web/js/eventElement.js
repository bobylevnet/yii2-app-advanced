$('#helpDrop').change(function () {
	
	
	var url = window.location.href;
	
	var arr = url.split('?');
	
	arr[1] = '?model=' + this.value;
	
	window.location.href = arr[0] + arr[1];
})




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
