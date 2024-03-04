<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'recipe.index')]
    public function index(Request $request, RecipeRepository $repository): Response
    {
        $recipes = $repository->findByDurationTime(40);
        return $this->render('recipe/index.html.twig', ['recipes' => $recipes]);
    }

    #[Route('/recipe/{slug}-{id}', name: 'recipe.show', requirements:['id' => '\d+', 'slug' => '[a-z0-9-A-Z]+'])]
    public function show(Request $request, string $slug, int $id, RecipeRepository $repository): Response
    {

        $recipe = $repository->find($id);
        if ($recipe->getSlug() !== $slug){
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }
    
    #[Route('recipe/{id}/edit', name: 'recipe.edit', methods: ['GET', 'POST'])]
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em): Response{
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            $this->addFlash('success', 'Recipe Updated');
            return $this->redirectToRoute('recipe.index');
        }
        return $this->render('recipe/edit.html.twig', ['recipe' => $recipe, 'form' => $form]);
    }

    #[Route('/recipe/create', name:'recipe.create')]
    public function create(Request $request,EntityManagerInterface $em): Response{

        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($recipe);
            $em->flush();
            $this->addFlash('success', 'Recipe Added');
            return $this->redirectToRoute('recipe.index');
        }

        return $this->render('recipe/create.html.twig', ['form' => $form]);
    }

    
    #[Route('recipe/{id}/delete', name: 'recipe.delete', methods: ['DELETE'])]
    public function delete(Recipe $recipe,  EntityManagerInterface $em): Response{
        $em->remove($recipe);
        $em->flush();
        $this->addFlash('success', 'Recipe Deleted');
        return $this->redirectToRoute('recipe.index');
        
    }
}
