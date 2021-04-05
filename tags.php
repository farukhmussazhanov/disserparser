<?php
ini_set('max_execution_time', '300');
require "vendor/autoload.php";
require "class/autoload.php";
use PHPHtmlParser\Dom;
if(empty($_POST))
{
//    $tengriurl = $_POST['url'];
    $dom0 = new Dom;
    $dom0->loadFromUrl('https://kaz.tengrinews.kz/');
    $a = $dom0->find('.tn-list-grid');
    foreach ($a as $b)
    {
        $dom20 = new Dom;
        {
            $dom20->loadStr($b->innerHtml);
            $tt = $dom20->find('a');
            foreach ($tt as $content)
            {
            echo "<pre>",var_dump( $content->href),"</pre>";
                $dom = new Dom;
                $dom->loadFromUrl(''.$content->href);
                $a = $dom->find('.tn-link');
//                echo count($a);
                foreach ($a as $b)
                {
                    $dom2 = new Dom;
                    echo $b->href;
                    if(!preg_match('/http[s]:/',    $b->getAttribute('href'), $matches, PREG_OFFSET_CAPTURE)   )
                    {
                        echo "<pre>",var_dump( $b->getAttribute('href')),"</pre>";
                        $dom2->loadFromUrl( 'https://kaz.tengrinews.kz'.$b->getAttribute('href'));
//    $dom2->loadFromUrl('https://kaz.tengrinews.kz/football/islamhan-kayrat-sapyinda-jattyigadyi-317035/');
                        $tt = $dom2->find('.tn-news-content');

                        foreach ($tt as $content2)
                        {
                            $dom3 = new Dom;
                            $dom3->loadStr($content2->innerHtml);
                            if(count($dom3->find('img'))!= 0) {
                                $imgData = file_get_contents('https://kaz.tengrinews.kz' . $dom3->find('img')->src);
                                $imgType = Helper::get_image_mime_type('https://kaz.tengrinews.kz' . $dom3->find('img')->src);
//                                $imgAlt = $dom3->find('img')->alt;
                                $texts = '';
                                foreach ($dom3->find('.tn-news-text')[0]->find('p') as $text)
                                {
//                    if($text->text!='<')
                                    $texts .= ' ' . $text->text;
                                }
                                echo $texts;
                                echo "<pre>", var_dump(Data::insertData($imgType, $imgData, $texts)), "</pre>";
                            }
//        exit();
                        }
                    }
//    exit();
                }
            }
        }

    }
}
?><?php
