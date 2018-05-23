<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:49
 */

class tb_state
{
    private $id_state;
    private $str_uf;
    private $str_name;
    private $tb_region_id_region;

    /**
     * tb_state constructor.
     * @param $id_state
     * @param $str_uf
     * @param $str_name
     * @param $tb_region_id_region
     */
    public function __construct($id_state, $str_uf, $str_name, $tb_region_id_region)
    {
        $this->id_state = $id_state;
        $this->str_uf = $str_uf;
        $this->str_name = $str_name;
        $this->tb_region_id_region = $tb_region_id_region;
    }

    /**
     * @return mixed
     */
    public function getIdState()
    {
        return $this->id_state;
    }

    /**
     * @param mixed $id_state
     */
    public function setIdState($id_state): void
    {
        $this->id_state = $id_state;
    }

    /**
     * @return mixed
     */
    public function getStrUf()
    {
        return $this->str_uf;
    }

    /**
     * @param mixed $str_uf
     */
    public function setStrUf($str_uf): void
    {
        $this->str_uf = $str_uf;
    }

    /**
     * @return mixed
     */
    public function getStrName()
    {
        return $this->str_name;
    }

    /**
     * @param mixed $str_name
     */
    public function setStrName($str_name): void
    {
        $this->str_name = $str_name;
    }

    /**
     * @return mixed
     */
    public function getTbRegionIdRegion()
    {
        return $this->tb_region_id_region;
    }

    /**
     * @param mixed $tb_region_id_region
     */
    public function setTbRegionIdRegion($tb_region_id_region): void
    {
        $this->tb_region_id_region = $tb_region_id_region;
    }

}