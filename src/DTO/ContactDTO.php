<?php 
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO {

    #[Assert\Length(min:2)]
    public string $name;

    #[Assert\Email()]
    public string $email;

    #[Assert\Length(min:2)]
    public string $message;

    public function getName(): ?string
    {
        return $this->name;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }
    public function getMail(): ?string
    {
        return $this->email;
    }
}

?>