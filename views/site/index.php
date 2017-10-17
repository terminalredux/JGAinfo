<?php

libxml_use_internal_errors(true);
$dom = new DomDocument;
$dom->loadHTMLFile('http://www.jelonka.com/news,single,init,article,71403');
$xpath = new DomXPath($dom);

$title = $xpath->query("//a[@class='wiadomosci-title']");
$content = $xpath->query("//div[@class='wiadomosci-contener']");
$pubDateTime = $xpath->query("//div[@class='wiadomosci-data']/strong");
$updateDateTime = $xpath->query("//div[@class='wiadomosci-data'][1]");
$author = $xpath->query("//span[@class='autor']/span/strong");

//$title[0]->nodeValue;
//$content[0]->nodeValue;
//$pubDateTime[0]->nodeValue
//ostatnia aktualizacja:
//if there is strong "ostatnia aktualizacja:" it means there was an update
//trim(explode('ostatnia aktualizacja:', $updateDateTime[0]->nodeValue)[1])
//$author[0]->nodeValue

/*
$textContent = [];
for ($i = 0; $i <= $content[0]->childNodes->length; $i++) {
  if (isset($content[0]->childNodes->item($i)->attributes) &&
      ($content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h2-tekst' ||
      $content[0]->childNodes->item($i)->attributes[0]->value == 'wiadomosc-h1-tekst')) {
    $textContent[] = $content[0]->childNodes->item($i)->nodeValue;
  }
}
echo implode('<br><br>', $textContent);
*/


?>
<h1>Witamy na stronie !</h1>
