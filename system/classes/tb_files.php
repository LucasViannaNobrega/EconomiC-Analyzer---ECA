<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:42
 */

class tb_files
{
    private $id_file;
    private $str_name_file;
    private $str_month;
    private $str_year;

    /**
     * tb_files constructor.
     * @param $id_file
     * @param $str_name_file
     * @param $str_omonth
     * @param $str_year
     */
    public function __construct($id_file, $str_name_file, $str_month, $str_year)
    {
        $this->id_file = $id_file;
        $this->str_name_file = $str_name_file;
        $this->str_month = $str_month;
        $this->str_year = $str_year;
    }

    /**
     * @return mixed
     */
    public function getIdFile()
    {
        return $this->id_file;
    }

    /**
     * @param mixed $id_file
     */
    public function setIdFile($id_file): void
    {
        $this->id_file = $id_file;
    }

    /**
     * @return mixed
     */
    public function getStrNameFile()
    {
        return $this->str_name_file;
    }

    /**
     * @param mixed $str_name_file
     */
    public function setStrNameFile($str_name_file): void
    {
        $this->str_name_file = $str_name_file;
    }

    /**
     * @return mixed
     */
    public function getStrMmonth()
    {
        return $this->str_month;
    }

    /**
     * @param mixed $str_omonth
     */
    public function setStrMonth($str_month): void
    {
        $this->str_month = $str_month;
    }

    /**
     * @return mixed
     */
    public function getStrYear()
    {
        return $this->str_year;
    }

    /**
     * @param mixed $str_year
     */
    public function setStrYear($str_year): void
    {
        $this->str_year = $str_year;
    }
}