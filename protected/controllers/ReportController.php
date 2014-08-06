<?php

class ReportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public $menu = array(
		array('label'=>'Report books', 'url'=>array('reportBooks')),
		array('label'=>'Report authors', 'url'=>array('reportAuthors')),
		array('label'=>'Report random books', 'url'=>array('reportRandBooks')),
		array('label'=>'Search', 'url'=>array('search')),
	);

	/**
	 * Вывод списка книг, находящихся на руках у читателей, и имеющих не менее трех со-авторов.
	 */
	public function actionReportBooks()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array('readers', 'authorsAll');
		$criteria->together = true;
		$criteria->select = 't.id, t.name';
		$criteria->group = 't.id';
		$criteria->having = 'COUNT(authorsAll.author_id) > 2';
		$dataProvider=new CActiveDataProvider('Books', array(
			'criteria' => $criteria,
		));
		$this->render('report_book',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Вывод списка авторов, чьи книги в данный момент читает более трех читателей.
	 */
	public function actionReportAuthors()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array('booksAll.bookReaders');
		$criteria->together = true;
		$criteria->select = 't.id, t.name';
		$criteria->group = 't.id';
		$criteria->having = 'COUNT(bookReaders.reader_id) > 3';

		$dataProvider=new CActiveDataProvider('Authors', array(
			'criteria' => $criteria,
		));
		$this->render('report_author',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Вывод пяти случайных книг.
	 */
	public function actionReportRandBooks()
	{
		$countBook = Books::model()->count();
		if(!$countBook)
			throw new CHttpException(404,'Books not found');
		$query = array();
		$randBook = array();
		//Дабы избежать повторяющихся записей при выборке
		if($countBook >= 5){
			while (count($randBook) < 5) {
				$tmp = rand(0, $countBook-1);
				$randBook[$tmp] = $tmp;
			}
		} else
			throw new CHttpException(404,'Books count is very small');
		foreach ($randBook as $number) {
			$query[] = '(SELECT * FROM books LIMIT ' . $number . ', 1)';
		}
		$query = implode(' UNION ', $query);
		$data = Yii::app()->db->createCommand($query)->queryAll();

		$this->render('report_random_book', array('data' => $data));
	}

	/**
	 * SELECT sb.id, sb.name, sa.name FROM search_books as sb
	INNER JOIN book_author as ba ON ba.book_id = sb.id
	INNER JOIN search_author as sa ON sa.id = ba.author_id
	WHERE
	MATCH(sb.name,sa.name) AGAINST ('Yii. Сборник рецептов  М. Лассила' IN BOOLEAN MODE) >0
	ORDER BY MATCH(sb.name,sa.name) AGAINST ('Yii. Сборник рецептов  М. Лассила' IN BOOLEAN MODE) DESC
	 */
	public function actionSearch()
	{
		$data = SearchBooks::searchReport(isset($_GET['searchText']) ? $_GET['searchText'] : '');

		$this->render('report_search',array(
			'data'=>$data,
		));
	}

}