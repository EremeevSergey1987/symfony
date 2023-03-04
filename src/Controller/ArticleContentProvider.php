<?php

namespace App\Controller;
use App\Homework\ArticleContentProviderInterface;

class ArticleContentProvider implements ArticleContentProviderInterface
{
    public function __construct($word_with_bold)
    {
        $this->word_with_bold  = $word_with_bold;
    }
    public $count_paragraphs;
    public function get(int $paragraphs, string $word = null, int $wordsCount = 0): string
    {
        if($this->word_with_bold == true){
            $word = '_'.$word.'_';
        }else{
            $word = '**'.$word.'**';
        }
        $text = [
'Таким образом, **социально-экономическое** развитие влечет за собой процесс внедрения и модернизации системы масштабного изменения ряда параметров. Значимость этих проблем настолько очевидна, что сложившаяся структура организации влечет за собой процесс внедрения и модернизации модели развития.',
'Дорогие друзья, __дальнейшее развитие различных форм деятельности__ позволяет выполнить важнейшие задания по разработке дальнейших направлений развития проекта? Задача организации, в особенности же повышение уровня гражданского сознания обеспечивает актуальность ключевых компонентов планируемого обновления.',
'###С другой стороны рамки и место обучения кадров 
создаёт предпосылки качественно новых шагов для экономической целесообразности...',
'Таким образом, курс на ~~социально-ориентированный~~ национальный проект в значительной степени обуславливает создание форм воздействия!',
'>С другой стороны выбранный нами инновационный путь п
озволяет выполнить важнейшие задания по разработке дальнейших направлений развития проекта. Дорогие друзья, начало повседневной работы по формированию позиции напрямую зависит от позиций, занимаемых участниками в отношении поставленных задач!',
'Разнообразный и [богатый опыт](http://ya.ru) рамки и место обучения кадров требует от нас системного анализа дальнейших направлений развитая системы массового участия? Практический опыт показывает, что выбранный нами инновационный путь требует от нас системного анализа новых предложений.',
'Задача организации, в особенности же рамки и место обучения кадров играет важную роль в формировании системы...',
];


        for ($i = 0; $i <= $paragraphs; $i++) {
            $this->count_paragraphs .= $text[rand(0,6)] . PHP_EOL;
        }

        $articleContent = $this->count_paragraphs;
        $array = explode(" ", $articleContent);

        for ($i = 0; $i < $wordsCount;  $i++) {
            $h = rand(0, count($array) - 1);
            $array = array_merge(array_slice($array, 0, $h), array($word), array_slice($array, $h));
        }
        $articleContent = implode(' ', $array);

        return nl2br($articleContent);
    }
}