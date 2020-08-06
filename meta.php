<?php
function metadata($title){
    echo "
    <meta property='og:title' content='Engineer.tf - $title' />
    <meta property='og:url' content='http://engineer.tf/' />
    <meta property='og:image' content='http://engineer.tf/assets/engineer-avatar-simple.png' />
    <meta property='og:description' content='$title for Engie Mains' />
    <meta name='theme-color' content='#004fa0' />
    <meta name='twitter:card' content='http://engineer.tf/assets/engineer-avatar-simple.png'>
    ";
}
function metadata_post($title, $desc){
    echo "
    <meta property='og:title' content='Engineer.tf - $title' />
    <meta property='og:url' content='http://engineer.tf/' />
    <meta property='og:image' content='http://engineer.tf/assets/engineer-avatar-simple.png' />
    <meta property='og:description' content='$desc' />
    <meta name='theme-color' content='#004fa0' />
    <meta name='twitter:card' content='http://engineer.tf/assets/engineer-avatar-simple.png'>
    ";
}
?>