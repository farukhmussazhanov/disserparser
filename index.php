<?php
ini_set('max_execution_time', '300');
require "vendor/autoload.php";
require "class/autoload.php";
use PHPHtmlParser\Dom;
//if(!empty($_POST))
//{
//    $tengriurl = $_POST['url'];
$dom = new Dom;
$dom->loadFromUrl('https://kaz.tengrinews.kz/');
$a = $dom->find('.tn-link');
foreach ($a as $b)
{
    $dom2 = new Dom;
    if(!preg_match('/http[s]:/',    $b->getAttribute('href'), $matches, PREG_OFFSET_CAPTURE)   )
    {
    echo "<pre>",var_dump( $b->getAttribute('href')),"</pre>";
        $dom2->loadFromUrl( 'https://kaz.tengrinews.kz'.$b->getAttribute('href'));
//    $dom2->loadFromUrl('https://kaz.tengrinews.kz/crime/altyin-ordadagyi-tobeles-okiganyin-tolyik-videosyi-320707/');
        $tt = $dom2->find('.tn-news-content');

        foreach ($tt as $content)
        {
            $dom3 = new Dom;
//    $dom2->loadFromUrl($b->href);
            $dom3->loadStr($content->innerHtml);
//        echo "<pre>",var_dump('https://kaz.tengrinews.kz'.$dom3->find('img')->src),"</pre>";
//            $src1 = $dom3->find('img')->src;
//            if(isset($dom3->find('img')->src))
            {
//                echo count($dom3->find('img'));
//                echo "<pre>",var_dump($dom3->find('img')),"</pre>";
            }

            if(count($dom3->find('img'))!= 0)
            {

                $imgData = file_get_contents('https://kaz.tengrinews.kz'.$dom3->find('img')->src);
                $imgType = Helper::get_image_mime_type('https://kaz.tengrinews.kz'.$dom3->find('img')->src);
//                $imgAlt = $dom3->find('img')->alt;
//                echo "<pre>",var_dump( count($dom3->find('.tn-news-text')[0]->find('p'))),"</pre>";
                $texts = '';
                foreach ($dom3->find('.tn-news-text')[0]->find('p') as $text)
                {
//                    if($text->text!='<')
                    $texts .= ' ' . $text->text;
                }
                echo $texts;
                echo "<pre>",var_dump(Data::insertData($imgType,$imgData,$texts)),"</pre>";
            }

//        exit();
        }
    }
//    exit();
}
//}
//else{
//    echo 'flase';
//}
//$a->href; // "click here"
?>