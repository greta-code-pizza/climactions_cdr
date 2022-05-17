<?php

namespace Climactions\Models;

class ContactModel extends Manager
{
    public function postMail($lastname, $firstname, $email, $phone, $object, $message)
    {
        $bdd = $this->connect();
        $req = $bdd->prepare('INSERT INTO contact (lastname, firstname, email, phone, object, message) VALUES (:lastname, :firstname, :email, :phone, :object, :message)');
        
        $req->execute(array(
            ':lastname' => $lastname,
            ':firstname' => $firstname,
            ':email' => $email,
            ':phone' => $phone,
            ':object' => $object,
            ':message' => $message));
        return $req;
    }

}