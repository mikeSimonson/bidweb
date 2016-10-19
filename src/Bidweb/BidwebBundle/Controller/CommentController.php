<?php
namespace Bidweb\BidwebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bidweb\BidwebBundle\Entity\Comment;
use Bidweb\BidwebBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newPostAction($id)
    {
        $ads = $this->getPost($id);

        $comment = new Comment();
        $comment->setPost($ads);
        $comment->setUser($this->getUser());
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('BidwebBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createPostAction(Request $request, $post_id)
    {
        $post = $this->getPost($post_id);
       
        $comment  = new Comment();
        $comment->setPost($post);
        $comment->setUser($this->getUser());
        
        $form    = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            // TODO: Persist the comment entity
             $em = $this->getDoctrine()
                       ->getManager();
             $post->setSlug($post->slugUrl($post->getTitle()));
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('bidweb_post_show', array(
                'id' => $comment->getPost()->getId(), 'slug'  => $comment->getPost()->getSlug())) .
                '#comment-' . $comment->getId()
            );
        }
//        return $this->redirect($this->generateUrl('bidweb_post_show', array(
//                            'id' => $post->getId(), 'slug' => $post->getSlug())) 
//        );
        return $this->render('BidwebBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getPost($id)
    {
        $em = $this->getDoctrine()
                    ->getManager();

        $post = $em->getRepository('BidwebBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Post.');
        }

        return $post;
    }

    
}
