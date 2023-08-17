<?php

function createLINK($content, $href, $extra = null)
{

  return "<a href='$href' class='btn' style='$extra'>
    <!--<span class='circle'></span>-->
    <span class='btn-text'>$content</span>
  </a>";
}

function createBUTTON($content, $type, $href)
{
  return "<button href='$href' type='$type'>$content</button>";
}

function createTAG($content, $href, $extra = null)
{
  return "<a href='$href' class='tag' style='$extra'>$content</a>";
}

function convertDESC($content, $limit)
{
  if (strlen($content) > $limit) {
    $content = substr($content, 0, $limit) . "...";
  }
  return $content;
}

function getSeparator()
{
  return "<hr style='width:65%;background-color:blue'/>";
}

function convertGEO($data)
{
  $code = $data['departement']['code'];
  $name = join("-", explode(" ", strtolower($data['departement']['nom'])));
  $src = $code . "-logo-" . $name . ".png";
  echo "<img src='src/LOGODEPFR/icones-300px/$src' />";
}

?>