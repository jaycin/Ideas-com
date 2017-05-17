<?php
/**
 * Created by PhpStorm.
 * User: Jaycin
 * Date: 2016/10/23
 * Time: 3:14 AM
 */
class Database extends sqlFunctions
{
    private $root;

    public function connectRoot()
    {
        $this->root = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    }



    public function escapeStr($str,$level = "0")
    {
      return "'".mysqli_real_escape_string($this->root,$str)."'";
    }


    /**
     * @param $host
     * @param $user
     * @param $pass
     * @param $db
     * @param string $level 0 for admin 1 for site
     */
    public function connectDb($host,$user,$pass,$db)
    {

        $this->site = new mysqli($host,$user,$pass,$db);
    }

    public function query($sql,$multi = false)
    {

        return $this->runQuery($sql,$multi);
    }

    /**
     * @param $sql
     * @param string $level
     * @return array|string
     */
    private function runQuery($sql,$multi = false)
    {

        $result = "";
        $return = "";
        $insertId = 0;


                if(!$multi) {
                    $result = $this->root->query($sql);
                    $insertId = $this->root->insert_id;
                }
                else
                {
                    $this->root->multi_query($sql);
                    $insertId = $this->root->error;
                    do { $this->root->use_result(); } while( $this->root->next_result() );
                }

        //SELECT OR SHOW STATEMENTS
        if(!empty($result)&& strpos(strtolower($sql),"select") !== FALSE || strpos(strtolower($sql),"show")!==FALSE)
        {

            while($row = $result->fetch_object())
            {
                $return[] = $row;
            }
            return $return;
        }

        if(!empty($result)&& strpos(strtolower($sql),"insert") !== FALSE || strpos(strtolower($sql),"insert")!==FALSE)
        {
           return $insertId;

        }

    }
}



?>