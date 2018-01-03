<?php
namespace App\Model;

/**
 * @Entity
 */
class Users extends AbstractModel
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @Column(name="`username`", unique=true)
     */
    private $username;

    /**
     * @Column(name="`name`", type="text")
     */
    private $name;

    /**
     * @Column(name="`password`", type="text")
     */
    private $password;

    /**
     * @Column(name="`roles`", type="text")
     */
    private $roles;

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return explode(',', $this->roles);
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = implode(',', $roles);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $this->getHashedPassword($password);
    }
    public function getHashedPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

}
