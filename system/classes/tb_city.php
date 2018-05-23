<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:48
 */

class tb_city
{
    private $id_city;
    private $str_name_city;
    private $str_cod_siafi_city;
    private $tb_state_id_state;

    /**
     * tb_city constructor.
     * @param $id_city
     * @param $str_name_city
     * @param $str_cod_siafi_city
     * @param $tb_state_id_state
     */
    public function __construct($id_city, $str_name_city, $str_cod_siafi_city, $tb_state_id_state)
    {
        $this->id_city = $id_city;
        $this->str_name_city = $str_name_city;
        $this->str_cod_siafi_city = $str_cod_siafi_city;
        $this->tb_state_id_state = $tb_state_id_state;
    }

    /**
     * @return mixed
     */
    public function getIdCity()
    {
        return $this->id_city;
    }

    /**
     * @param mixed $id_city
     */
    public function setIdCity($id_city): void
    {
        $this->id_city = $id_city;
    }

    /**
     * @return mixed
     */
    public function getStrNameCity()
    {
        return $this->str_name_city;
    }

    /**
     * @param mixed $str_name_city
     */
    public function setStrNameCity($str_name_city): void
    {
        $this->str_name_city = $str_name_city;
    }

    /**
     * @return mixed
     */
    public function getStrCodSiafiCity()
    {
        return $this->str_cod_siafi_city;
    }

    /**
     * @param mixed $str_cod_siafi_city
     */
    public function setStrCodSiafiCity($str_cod_siafi_city): void
    {
        $this->str_cod_siafi_city = $str_cod_siafi_city;
    }

    /**
     * @return mixed
     */
    public function getTbStateIdState()
    {
        return $this->tb_state_id_state;
    }

    /**
     * @param mixed $tb_state_id_state
     */
    public function setTbStateIdState($tb_state_id_state): void
    {
        $this->tb_state_id_state = $tb_state_id_state;
    }
}