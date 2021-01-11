<?php

namespace App\Controller;

use App\Utils\CategoryTreeAdminList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Utils\CategoryTreeAdminOptionList;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

/**
     * @Route("/admin")
     */

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_main_page")
     */
    public function index(): Response
    {
        return $this->render('admin/my_profile.html.twig');
    }

    /**
     * @Route("/su/categories", name="categories", methods={"GET", "POST"})
     */
    public function categories(CategoryTreeAdminList $categories, Request $request)
    {
        $categories->getCategoryList($categories->buildTree());

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $is_invalid = null;
  

        if ($this->saveCategory($category,$form,$request))
        {
            return $this->redirectToRoute('categories');

        }
        elseif($request->isMethod('post'))
        {
            $is_invalid = ' is-invalid';
        }

        return $this->render('admin/categories.html.twig', [
        'categories' => $categories->categorylist,
        'form' => $form->createView(),
        'is_invalid' => $is_invalid,
        ]);
    }

    /**
     * @Route("/videos", name="videos")
     */
    public function videos(): Response
    {
        return $this->render('admin/videos.html.twig');
    }

    /**
     * @Route("/su/upload_video", name="upload_video")
     */
    public function upload_video(): Response
    {
        return $this->render('admin/upload_video.html.twig');
    }

    /**
     * @Route("/su/users", name="users")
     */
    public function users(): Response
    {
        return $this->render('admin/users.html.twig');
    }

    /**
     * @Route("/su/edit-category/{id}", name="edit_category",methods={"GET", "POST"})
     */
    public function editCategory(Category $category, Request $request): Response
    {

        $form = $this->createForm(CategoryType::class, $category);
        $is_invalid = null;

        if ($this->saveCategory($category,$form,$request))
        {
            return $this->redirectToRoute('categories');

        }
        elseif($request->isMethod('post'))
        {
            $is_invalid = ' is-invalid';
        }

        return $this->render('admin/edit_category.html.twig',
    [
        'category' => $category,
        'form' => $form->createView(),
        'is_invalid' => $is_invalid,
        ]);
    }

    /**
     * @Route("/su/delete-category/{id}", name="delete_category")
     */
    public function deleteCategory(Category $category): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute('categories');
    }

    public function getAllCategories(CategoryTreeAdminOptionList $categories, $editedCategory = null){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $categories->getCategoryList($categories->buildTree());
        return $this->render('admin/allCategories.html.twig', 
    [
        'categories' => $categories,
        'editedCategory' => $editedCategory
    ]);
    }

    private function saveCategory($category,$form,$request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $category->setName($request->request->get('category')['name']);
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $parent = $repository->find($request->request->get('category')['parent']);
            $category->setParent($parent);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return true;

        }
            return false;
        
    }
}
