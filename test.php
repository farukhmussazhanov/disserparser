<?php
if(preg_match('/https:\/\/kaz.tengrinews.kz\//', '#', $matches, PREG_OFFSET_CAPTURE))
echo "<pre>" ,var_dump($matches),"</pre>";