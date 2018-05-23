<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:51
 */

class tb_region
{
    private $id_region;
    private $str_name_region;

    /**
     * tb_region constructor.
     * @param $id_region
     * @param $str_name_region
     */
    public function __construct($id_region, $str_name_region)
    {
        $this->id_region = $id_region;
        $this->str_name_region = $str_name_region;
    }

    /**
     * @return mixed
     */
    public function getIdRegion()
    {
        return $this->id_region;
    }

    /**
     * @param mixed $id_region
     */
    public function setIdRegion($id_region): void
    {
        $this->id_region = $id_region;
    }

    /**
     * @return mixed
     */
    public function getStrNameRegion()
    {
        return $this->str_name_region;
    }

    /**
     * @param mixed $str_name_region
     */
    public function setStrNameRegion($str_name_region): void
    {
        $this->str_name_region = $str_name_region;
    }
}