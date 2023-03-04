<?php

namespace App\Controller;


use App\Homework\ArticleContentProviderInterface;
use App\Homework\ArticleProvider;
use Demontpx\ParsedownBundle\Parsedown;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */

    public function homepage()
    {
        return $this->render('articles/homepage.html.twig');
    }


    /**
     * @Route("/articles/{slug}", name="app_article_show")
     */

    public function show($slug, ArticleProvider $articleProvider, Parsedown $parsedown, AdapterInterface $cache, ArticleContentProviderInterface $provider)
    {


        $articleContent = <<<EOF
Lorem Lorem ipsum **кофе dolor** sit amet, consectetur adipiscing elit, sed
                            do eiusmod tempor incididunt Фронтенд Абсолютович ut labore et dolore magna aliqua.
                            Purus viverra accumsan in nisl. Diam vulputate ut pharetra sit amet aliquam. Faucibus a
                            pellentesque sit amet porttitor eget dolor morbi non. Est ultricies integer quis auctor
                            elit sed. Tristique nulla aliquet enim tortor at. Tristique et egestas quis ipsum. Consequat semper viverra nam
                            libero. Lectus quam id leo in vitae turpis. In eu mi bibendum neque egestas congue
                            quisque egestas diam. кофе blandit turpis cursus in hac habitasse platea dictumst quisque.

[Ullamcorper](/) malesuada proin libero nunc consequat interdum varius sit amet. Odio pellentesque
                            diam volutpat commodo sed egestas. Eget nunc lobortis mattis aliquam. Cursus vitae congue
                            mauris rhoncus aenean vel. Pretium viverra suspendisse potenti nullam ac tortor vitae.
                            A pellentesque sit amet porttitor eget dolor. Nisl nunc mi ipsum faucibus vitae. Purus sit amet
                            luctus venenatis lectus magna fringilla urna. Sit amet tellus cras adipiscing enim. Euismod
                            nisi porta lorem mollis aliquam ut porttitor leo.

Morbi blandit cursus risus at ultrices. Adipiscing vitae proin sagittis nisl rhoncus mattis
                            rhoncus. Sit amet commodo nulla facilisi. In fermentum et sollicitudin ac orci phasellus
                            egestas tellus. Sit amet risus nullam eget felis. Dapibus ultrices in iaculis nunc sed
                            augue lacus viverra. Dictum non consectetur a erat nam at. Odio ut enim blandit volutpat
                            maecenas. Turpis cursus in hac habitasse platea. Etiam erat velit scelerisque in. Auctor
                            neque vitae tempus quam pellentesque nec nam aliquam. Odio pellentesque diam volutpat commodo
                            sed egestas egestas. Egestas dui id ornare arcu odio ut.
EOF;

        $articleContent = $parsedown->text($articleContent);


        $word = 'КОТ!!!';
        $text_paragraph = $provider->get(2, $word, 10);
        $text_paragraph = $parsedown->text($text_paragraph);

        $item = $cache->getItem('markdown_' . md5($articleContent));

//        if(! $item->isHit()){
//            $item->set($parsedown->text($articleContent));
//            $cache->save($item);
//        }
//        $articleContent = $item->get();

        $articleContent = $cache->get('markdown_' . md5($articleContent),
            function () use ($parsedown, $articleContent)
            {
                return $parsedown->text($articleContent);
            });




        $article = $articleProvider->article();


        return $this->render('articles/show.html.twig', [
            'articleContent' => $articleContent,
            'article' => $article,
            'text_paragraph' => $text_paragraph,
        ]);
    }
}
