<?php
function getDeviations($url, $limit = null, $start = 0) {
    $feed      = simplexml_load_file($url);
    $channel   = $feed->channel;
    $i         = 0;
    $html      = '';

    foreach($channel->item as $item) {
        if($i < $start) { $i++; continue; }
        if(isset($limit) && $i == $start + $limit) break;

        $title  = $item->title;
        $url    = $item->link;
        $date   = $item->pubDate;
        $desc   = $item->children('media', true)->description;
        $thumbS = $item->children('media', true)->thumbnail->{0}->attributes()->url;
        $thumbL = $item->children('media', true)->thumbnail->{1}->attributes()->url;
        $image  = $item->children('media', true)->content->attributes()->url;

        $html .= "<h2>$title</h2>";
        $html .= "<p><a href=\"$link\" target=\"_blank\">$link</a></p>";
        $html .= "<p><small>$date</small></p>";
        $html .= "<p>$description</p>";
        $html .= "<p>Thumb (w: 150)<br> <img src=\"$thumbS\"/></p>";
        $html .= "<p>Thumb (w: 300)<br> <img src=\"$thumbL\"/></p>";
        $html .= "<p>Image<br> <img src=\"$image\"/></p>";
        $html .= "<hr>";

        $i++;
    }
    return $html;
}