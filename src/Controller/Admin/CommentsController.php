<?php

namespace App\Controller\Admin;


use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
     * @Route("/admin/comments", name="admin_comments")
     */
    public function index(Request $request): Response
    {

        //dd($q);
        $comments = [
            [
                'articleTitle' => 'Есть ли жизнь после девятой жизни?',
                'comment' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Phasellus faucibus scelerisque eleifend donec pretium. Ut tristique et egestas quis ipsum. Tristique et egestas quis ipsum suspendisse ultrices gravida dictum. Velit scelerisque in dictum non. Pharetra sit amet aliquam id diam maecenas ultricies mi. Augue mauris augue neque gravida. Tempor orci eu lobortis elementum nibh tellus molestie. Eget magna fermentum iaculis eu non diam. Lectus magna fringilla urna porttitor. Ut faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Egestas sed sed risus pretium quam vulputate dignissim suspendisse in. Nisl nisi scelerisque eu ultrices vitae auctor eu. Diam sit amet nisl suscipit adipiscing bibendum est ultricies integer. A condimentum vitae sapien pellentesque. Volutpat sed cras ornare arcu dui. Ipsum nunc aliquet bibendum enim. Eget mauris pharetra et ultrices neque. Lectus nulla at volutpat diam ut. Convallis a cras semper auctor neque vitae tempus quam pellentesque. ',
                'createdAt' => new \DateTime('-4 hourse'),
                'authorName' => 'Сметанка',
            ],
            [
                'articleTitle' => 'Есть ли жизнь после девятой жизни?',
                'comment' => 'Amet consectetur adipiscing elit duis tristique sollicitudin. Egestas tellus rutrum tellus pellentesque eu. Dolor morbi non arcu risus quis varius quam quisque id. Lorem ipsum dolor sit amet consectetur adipiscing elit. Adipiscing elit duis tristique sollicitudin nibh sit amet. Mauris nunc congue nisi vitae suscipit. Accumsan sit amet nulla facilisi morbi tempus iaculis. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis. Sapien eget mi proin sed. Vitae proin sagittis nisl rhoncus mattis rhoncus. Aliquam purus sit amet luctus.',
                'createdAt' => new \DateTime('-3 hourse'),
                'authorName' => 'Варька',
            ],
            [
                'articleTitle' => 'Есть ли жизнь после девятой жизни?',
                'comment' => 'Morbi non arcu risus quis. Adipiscing elit duis tristique sollicitudin. Vestibulum mattis ullamcorper velit sed ullamcorper morbi. In eu mi bibendum neque. Aliquam ultrices sagittis orci a scelerisque purus semper eget. Tempor nec feugiat nisl pretium. Massa vitae tortor condimentum lacinia quis vel eros. Facilisis magna etiam tempor orci eu lobortis. Nulla pharetra diam sit amet. Nulla at volutpat diam ut venenatis tellus in metus. Ut etiam sit amet nisl purus. Mollis aliquam ut porttitor leo a. In hac habitasse platea dictumst vestibulum rhoncus. Diam quam nulla porttitor massa id neque. Sit amet justo donec enim diam vulputate ut pharetra sit. Elementum facilisis leo vel fringilla est ullamcorper eget. Dictum fusce ut placerat orci nulla. Ridiculus mus mauris vitae ultricies leo integer malesuada nunc.',
                'createdAt' => new \DateTime('-5 hourse'),
                'authorName' => 'Барсик',
            ],
        ];



        $q = $request->query->get('q');
        if($q){
            $comments = array_filter($comments, function($comment) use ($q){
                return stripos($comment['comment'], $q) !== false;
            });
        }

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }
}
