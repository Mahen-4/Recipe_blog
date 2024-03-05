<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact.index')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        $contact = new ContactDTO();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            try{
                $email = (new TemplatedEmail())
                    ->from($contact->email)
                    ->to($contact->services)
                    ->subject('Mail send by Symfony')
                    ->htmlTemplate('emails/contact.html.twig')
                    ->context(['data' => $contact]);
                $mailer->send($email);

                $this->addFlash('success', 'Mail send successfully');
                return $this->redirectToRoute('contact.index');
            }
            catch(\Exception $e){
                $this->addFlash('danger', 'Mail not send / ERROR !');
            }
            
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form,
        ]);
    }
}
