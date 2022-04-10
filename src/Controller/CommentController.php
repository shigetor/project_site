<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Comment;

use App\Form\CommentFormType;

use App\Entity\Product;

use App\Repository\CommentRepository;

class CommentController extends AbstractController
{

    /**
     * @Route("/comment/{id}", name="comment")
     */
    public function commentForm(int $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $comment = new Comment();

        $form = $this->createForm(CommentFormType::class, $comment, [
            'action' => $this->generateUrl('comment', ['id' => $id])
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $comment = $form->getData();

            if($comment->getProduct())
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($comment);
                $entityManager->flush();

                return $this->redirectToRoute('product', ['id' => $comment->getProduct()->getId()]);
            }

            return $this->redirectToRoute('index');
        }

        return $this->render('comment/index.html.twig', [
            'form' => $form->createView(),
            'id' => $id,
        ]);
    }

    /**
     * @Route("/get-comments", name="get-comments")
     */
    public function getComments(ManagerRegistry $doctrine, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $current_count = $data['count'];
        $product_id = $data['product-id'];

        $comment_repository = $doctrine->getRepository(Comment::class);
        $comments = $comment_repository->getByProduct($product_id, $current_count, 2);

        foreach($comments as &$comment)
        {
            $comment = $comment->jsonSerialize();
        }

        return new Response(json_encode([
            'count' => $current_count+=2,
            'comments' => $comments,
        ]));
    }

    /**
     * @Route("/get-comments-count", name="get-comments-count")
     */
    public function getCountOfComments(Request $request, CommentRepository $comment_repository): Response
    {
        $data = json_decode($request->getContent(), true);

        return new Response(json_encode([
            'count' => $comment_repository->getCountByProduct($data['product-id']),
        ]));
    }
}