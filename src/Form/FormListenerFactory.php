<?php 

namespace App\Form;

use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\String\Slugger\AsciiSlugger;

class FormListenerFactory{

    public function autoSlug(string $field): callable
    {
        return function (PreSubmitEvent $event) use ($field){
            $data = $event->getData();
            $slugger = new AsciiSlugger();
            $slug = $slugger->slug($data[$field]);
            $data['slug'] = $slug;
            $event->setData($data);
        };
    }

    public function autoDate(): callable
    {
        return function (PostSubmitEvent $event){
            $data = $event->getData();
            $data->setUpdatedAt(new \DateTimeImmutable);
            if($data->getId() == null){
                $data->setCreatedAt(new \DateTimeImmutable);
            }
        };
    }
}

?>