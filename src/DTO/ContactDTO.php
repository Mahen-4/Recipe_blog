<?php 
namespace App\DTO;

use App\Validator\DotCom;
use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO {

    #[Assert\NotBlank()]
    #[Assert\Length(min:2)]
    public string $name = '';

    #[Assert\NotBlank()]
    #[Assert\Email()]
    #[DotCom()]
    public string $email = '';
    
    #[Assert\NotBlank()]
    #[Assert\Length(min:2)]
    public string $message = '';

    #[Assert\NotBlank()]
    public string $services = '';
    
}

?>