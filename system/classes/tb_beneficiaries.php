<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 13:44
 */

class tb_beneficiaries
{
    private $id_beneficiaries;
    private $str_nis;
    private $str_name_person;

    /**
     * tb_beneficiaries constructor.
     * @param $id_beneficiaries
     * @param $str_nis
     * @param $str_name_person
     */
    public function __construct($id_beneficiaries, $str_nis, $str_name_person)
    {
        $this->id_beneficiaries = $id_beneficiaries;
        $this->str_nis = $str_nis;
        $this->str_name_person = $str_name_person;
    }

    /**
     * @return mixed
     */
    public function getIdBeneficiaries()
    {
        return $this->id_beneficiaries;
    }

    /**
     * @param mixed $id_beneficiaries
     */
    public function setIdBeneficiaries($id_beneficiaries): void
    {
        $this->id_beneficiaries = $id_beneficiaries;
    }

    /**
     * @return mixed
     */
    public function getStrNis()
    {
        return $this->str_nis;
    }

    /**
     * @param mixed $str_nis
     */
    public function setStrNis($str_nis): void
    {
        $this->str_nis = $str_nis;
    }

    /**
     * @return mixed
     */
    public function getStrNamePerson()
    {
        return $this->str_name_person;
    }

    /**
     * @param mixed $str_name_person
     */
    public function setStrNamePerson($str_name_person): void
    {
        $this->str_name_person = $str_name_person;
    }
}