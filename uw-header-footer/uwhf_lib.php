<?
// This will pull the selected $url's contents and return it.

class webContent {
  var $content;
  function getData($url)
  {
    $this->url = $url;
    $curlInit = curl_init();
    curl_setopt($curlInit, CURLOPT_URL, "$this->url");
    curl_setopt($curlInit, CURLOPT_HEADER, 0);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
    $this->content = curl_exec($curlInit);
    return $this->content;
  }
}

?>
