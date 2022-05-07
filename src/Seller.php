<?php

namespace Indielab\AutoScout24;

/**
* @since 1.1
*/
class Seller
{

    private $id, $name, $street, $zip, $city, $poBox, $additionalInfo, $phone, $mobile, $email, $url;

    public function __construct(array $data)
    {
        $this->id = $data['Id'] ?: "";
        $this->name = $data['Name'] ?: "";
        $this->street = $data['Street'] ?: "";
        $this->zip = $data['Zip'] ?: "";
        $this->city = $data['City'] ?: "";
        $this->poBox = $data['PoBox'] ?: "";
        $this->additionalInfo = $data['AdditionalInfo'] ?: "";
        $this->phone = $data['Phone'] ?: "";
        $this->mobile = $data['Mobile'] ?: "";
        $this->email = $data['Email'] ?: "";
        $this->url = $data['Url'] ?: "";
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getZip() {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getPoBox() {
        return $this->poBox;
    }

    /**
     * @return mixed
     */
    public function getAdditionalInfo() {
        return $this->additionalInfo;
    }

    /**
     * @return mixed
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getUrl() {
        return $this->url;
    }

}
