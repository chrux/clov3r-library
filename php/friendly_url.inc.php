<?php
/**
 * File: friendly_url.inc.php
 * Description: Friendly URLs
 * Author: Christian Torres <chtorrez at gmail dot com>
 * Date: 2011-04-14
 * Timestamp: 1302793466
 *
 * Thanks:
 * + to Subodh.com - http://dnnspeedblog.com/SpeedBlog/PostID/3172/Spanish-Stop-words
 * + to David Walsh - http://php.dzone.com/news/generate-search-engine-friendl
 *
 * @author Christian Torres <chtorrez at gmail dot com>
 * @category libraries
 * @package clov3r
 * @version 1.0
 */
function generate_seo_link($input,$replace = '-',$len=64,$remove_words = true) {
  // A little array of stop words in spanish, 179 words
  $stop_words = array('un','una','unas','unos','uno','sobre','todo','también','tras','otro','algún','alguno','alguna','algunos','algunas','ser','es','soy','eres','somos','sois','estoy','esta','estamos','estais','estan','como','en','para','atras','porque','por qué','estado','estaba','ante','antes','siendo','ambos','pero','por','poder','puede','puedo','podemos','podeis','pueden','fui','fue','fuimos','fueron','hacer','hago','hace','hacemos','haceis','hacen','cada','fin','incluso','primero','desde','conseguir','consigo','consigue','consigues','conseguimos','consiguen','ir','voy','va','vamos','vais','van','vaya','gueno','ha','tener','tengo','tiene','tenemos','teneis','tienen','el','la','lo','las','los','su','aqui','mio','tuyo','ellos','ellas','nos','nosotros','vosotros','vosotras','si','dentro','solo','solamente','saber','sabes','sabe','sabemos','sabeis','saben','ultimo','largo','bastante','haces','muchos','aquellos','aquellas','sus','entonces','tiempo','verdad','verdadero','verdadera','cierto','ciertos','cierta','ciertas','intentar','intento','intenta','intentas','intentamos','intentais','intentan','dos','bajo','arriba','encima','usar','uso','usas','usa','usamos','usais','usan','emplear','empleo','empleas','emplean','ampleamos','empleais','valor','muy','era','eras','eramos','eran','modo','bien','cual','cuando','donde','mientras','quien','con','entre','sin','trabajo','trabajar','trabajas','trabaja','trabajamos','trabajais','trabajan','podria','podrias','podriamos','podrian','podriais','y','yo','aquel');
  // Replace vowel with accent without them and alse rare characters
  // No accepted chars
  $na_chars = array(
    '/[áàâãªÁÀÂÃ]/u',
    '/[éèêÉÈÊ]/u',
    '/[íìîÍÌÎ]/u',
    '/[òóôõºÓÒÔÕ]/u',
    '/[úùûÚÙÛ]/u',
    '/[çÇ]/u',
    '/[Ññ]/u',
  );
  // Accepted chars
  $a_chars = array (
    'a',
    'e',
    'i',
    'o',
    'u',
    'c',
    'n',
  );
  $return = $input;
  $return = preg_replace($na_chars, $a_chars, $return);
  // First turn in low case the chars, second delete any chars that is not in a-z and 0-9
  // third, delete whitespace in the string and , fourth delete whitespace at the end and
  // begin, fifth truncate string to $len
  $return = substr(trim(preg_replace('/ +/',' ',preg_replace('/[^a-zA-Z0-9\s]/','',strtolower($return)))),0,$len);
  // Removing unnecessary words (duplicate and stop ones), words that aren't helpful to SEO
  if($remove_words) {
    $input_array = explode(' ',$return);
    $return_array = array();
    foreach($input_array as $word)
      if(!in_array($word,$stop_words) && ($unique_words ? !in_array($word,$return_array) : true))
        $return_array[] = $word;
    $return = implode($replace,$return_array);
  }
  return str_replace(' ',$replace,$return);
}
