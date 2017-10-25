<?php
namespace backend\models;
use Yii;
use backend\models\Files;
use common\component\bobyii2excel\ExcelReader;
/**
 * This is the model class for table "dataexcel".
 *
 * @property integer $id
 * @property string $column1
 * @property string $column2
 * @property string $column3
 * @property string $column4
 * @property string $column5
 * @property string $column6
 * @property string $column7
 * @property string $column8
 * @property string $column9
 * @property string $column10
 * @property string $column11
 * @property string $column12
 * @property string $column13
 * @property string $column14
 * @property string $column15
 * @property string $column16
 * @property string $column17
 * @property string $column18
 * @property string $column19
 * @property string $column20
 * @property string $column21
 * @property string $column22
 * @property string $column23
 * @property string $column24
 */
class Dataexcel extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'dataexcel';
	}
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[   ['column1', 'column2', 'column3', 'column4', 'column5', 'column6', 'column7', 'column8', 'column9', 'column10', 'column11', 'column12', 'column13', 'column14', 'column15', 'column16', 'column17', 'column18', 'column19', 'column20', 'column21', 'column22', 'column23', 'column24'], 'string'],
		];
	}
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'id' => 'ID',
				'column1' => 'Column1',
				'column2' => 'Column2',
				'column3' => 'Column3',
				'column4' => 'Column4',
				'column5' => 'Column5',
				'column6' => 'Column6',
				'column7' => 'Column7',
				'column8' => 'Column8',
				'column9' => 'Column9',
				'column10' => 'Column10',
				'column11' => 'Column11',
				'column12' => 'Column12',
				'column13' => 'Column13',
				'column14' => 'Column14',
				'column15' => 'Column15',
				'column16' => 'Column16',
				'column17' => 'Column17',
				'column18' => 'Column18',
				'column19' => 'Column19',
				'column20' => 'Column20',
				'column21' => 'Column21',
				'column22' => 'Column22',
				'column23' => 'Column23',
				'column24' => 'Column24',

		];
	}


	public function insertData($file, $cheks, $baseName, $comment)
	{
		//таблица файлы
		$files = new Files();

		//сохраняем имя файла получаем id записи
		$files->name = $file;
		$files->comment = $comment;
		$files->save();
		$id =  $files->getPrimaryKey();
		 
		//данный id будет ключем в таблице dataExcel
		$xl = new ExcelReader($file,$baseName);
		//  $i=ExcelReader::$countRow;
		for ($i=0; $i<ExcelReader::$countRow; )
		{

			// if ($i>158)
			// {
			//    echo "";
			// }
			$dtExcel = new Dataexcel();
			$dtExcel->id = $id;
			$arr =  $xl->parseExcel(['first'=>false,'column'=>$cheks],$baseName);
			 
			foreach ($cheks as $key => $value)
			{
				//чтение данных из файл
				//парсим фа эксель выбранные поля
				$k = $key+1;
				$st = (string)"column".$k;
				$dtExcel[$st]= $arr[1][$value];
				 
			}

			$dtExcel->save();
		}

	}
	
	
	//$modelTo -- модель в которую будем записывать
	//$data -- поля с которых брать данные
	//$import - связь с внешней таблицей
	public function baseIntable($modelTo, $data, $import=null)
	{
		//получаем поля моедели в которую будем писать
		$attModelSave =  $modelTo->attributes;
		//получаем данные загруженные в таблицу DataExcel
		$dataExcels = Dataexcel::find()->where(['id'=>$data['id']])->all();
		
		array_shift($data);
		array_shift($attModelSave);
		$modelTo = $modelTo::className();
		//получаем именя полей таблицы DataExcel 
		$data = array_keys($data);
		
		$modelImp=null;
		$result="";
		//проверяем если есть внешние таблицы
		if (!empty($import))
		{
			$arrImp = explode('.', $import);
			$modelImpstr = 'common\\models\\'. $arrImp[0];
				$modelImp = new $modelImpstr();
			
		}
		
		//проходим по всем полученным данным из таблицы DataExcel
		foreach ($dataExcels as $dataExcelOne)
		{
			
			
			
			$modelTo = new $modelTo();
			
			reset($data);
			//проходим по полям модели и полям модели DataExcel
			foreach ($attModelSave  as $key=>$att )
			{
				
				$modelTo[$key] = $dataExcelOne[current($data)];
				//проходим по аттрибутам модели в которую сохряняем
				next($data);
			}
			
			
			//выбираем данные с внешней таблицы
			if (!empty($modelImp))
			{
				$modelImpRes = $modelImp::find()->where([$arrImp[1]=>$dataExcelOne[end($data)]])->one();
				//поле которое заполняется внешними ключем
				//if ($modelImpRes->getPrimaryKey()=='2147483647')
			//	{
				//	echo '1';
				//}
				
				if (!empty($modelImpRes))
				{
					$modelTo[$arrImp[2]] = $modelImpRes->getprimaryKey();
					$modelImpRes=null;
				}
				
			}
			
			
			if ($modelTo->save())
			{
				
			}
			else
			{
				$result =  $result. ' '. $modelTo[current(array_keys($modelTo->attributes))];
			}
		}
		
		return 'Не сохраненно - '.$result;
		
	}
	 
}