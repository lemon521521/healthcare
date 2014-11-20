<?php

require_cache(CORE_PATH . 'Driver/Db/DbMysql.class.php');

/**
 * Mysql for session
 */
class DbMysqlsession extends DbMysql {

	public function __destruct() {
		
	}

}
