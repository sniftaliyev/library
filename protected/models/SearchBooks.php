<?php

/**
 * This is the model class for table "search_books".
 *
 * The followings are the available columns in table 'search_books':
 * @property integer $id
 * @property string $name
 */
class SearchBooks extends CActiveRecord
{
	public $book_name;
	public $author_name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'search_books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'authorsAll' => array(self::HAS_MANY, 'BookAuthor', 'book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria();
		$criteria->with = array('authors');
		$criteria->together = true;
		$criteria->select = 't.id, t.name, authors.name';
		$criteria->condition = 'MATCH(sb.name,sa.name) AGAINST (:searchText IN BOOLEAN MODE) >0';
		$criteria->order = 'MATCH(sb.name,sa.name) AGAINST (:searchText IN BOOLEAN MODE) DESC';
		$criteria->params = array(':searchText' => $this->searchText);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function searchReport($searchText)
	{
		if($searchText)
			$searchText = str_replace(' ', '*', $searchText);
		$searchText .= '*';
		$criteria = new CDbCriteria();
		$criteria->alias = 'sb';
		$criteria->join =
			'INNER JOIN book_author as ba ON ba.book_id = sb.id INNER JOIN search_author as sa ON sa.id = ba.author_id';
		$criteria->select = 'sb.id, sb.name as book_name, sa.name as author_name';
		$criteria->condition = 'MATCH(sb.name,sa.name) AGAINST (:searchText IN BOOLEAN MODE) >0';
		$criteria->order = 'MATCH(sb.name,sa.name) AGAINST (:searchText IN BOOLEAN MODE) DESC';
		$criteria->params = array(':searchText' => $searchText);
		$criteria->limit = 10;
		$data = SearchBooks::model()->findAll($criteria);
		if(!$data)
			return false;
		$result = array();
		foreach($data as $book){
			$result[$book['id']]['book_name'] = $book['book_name'];
			$result[$book['id']]['author_name'][] = $book['author_name'];
		}
		return $result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SearchBooks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
