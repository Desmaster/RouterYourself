<?php
class Database {

	private $db;
	private $query;

	const FETCH_ASSOC = PDO::FETCH_ASSOC;
	const FETCH_BOTH = PDO::FETCH_BOTH;
	const FETCH_BOUND = PDO::FETCH_BOUND;
	const FETCH_CLASS = PDO::FETCH_CLASS;
	const FETCH_INTO = PDO::FETCH_INTO;
	const FETCH_LAZY = PDO::FETCH_LAZY;
	const FETCH_NAMED = PDO::FETCH_NAMED;
	const FETCH_NUM = PDO::FETCH_NUM;
	const FETCH_OBJ = PDO::FETCH_OBJ;

	public function __construct() {
		$this-> db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USN, DB_PASS);
	}

	/**
	 * Creates and returns a PDOStatement
	 * @param string $query The query string
	 * @return query
	 */
	public function query($query) {
		$this-> query = $this-> db-> prepare($query);
		return $this-> query;
	}

	/**
	 * Execute the query
	 * @param array $params The paramaters needed in the query
	 */
	public function run($params = array()) {
		$this-> query-> execute($params);
	}

	/**
	 * Fetches the data from the query.
	 * @param int $fetch_style The way the data has to be fetched
	 * @see Database::FETCH_ASSOC
	 */
	public function fetch($fetch_style) {
		return $this-> query-> fetch($fetch_style);
	}

}
?>