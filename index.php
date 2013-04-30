<?php

/** POINTLESS CHANGE!! **/

/**
 *  How my blog should work:
 *  1. Nice url like www.blog.com/blog/thingie - strip it and figure out what post to show (slugs)
 *      Format: [mode]/[param1]/[param2]
 *  2. Feth the blog post or list of blog posts (controller)
 *  3. Pass the content to template (view)
 **/

/* Config file */

require "config.php";
 
/* Route */

$mode = isset($_GET['mode']) ? $_GET['mode'] : '';

switch($mode) {
    case 'post':
        post();
    break;
    case 'blog':
        blog();
    break;
    case 'savepost':
        savepost();
    break;
    case 'writepost':
        writepost();
    break;
    case 'listposts':
        listposts();
    break;
    default:
        listposts();
    break;
}

/* Controllers */

/**
 *  Post - fetch the details for a post and show it in the standard template
 **/

function post() {
    global $dbhost, $dbuser, $dbpass, $dbname;
    $postslug = isset($_GET['slug']) ? $_GET['slug'] : '';
    
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    $query = "SELECT p.title, p.content, p.date, a.name, p.tags FROM post p LEFT JOIN author a ON ( p.author = a.id ) WHERE p.slug = '".$postslug."' LIMIT 0,1";
    $result = mysql_query($query);
    $elements = mysql_fetch_assoc($result);
    
    include("postview.php");
    
}

/**
 *  Writepost - Create a new blog post
 **/

function writepost() {
    global $dbhost, $dbuser, $dbpass, $dbname;
    
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    $query = "SELECT id, name FROM author";
    $result = mysql_query($query);
    while($author = mysql_fetch_assoc($result)) {
        $elements['authors'][] = $author;
    }
    
    include("writepostview.php");
}

/**
 *  Savepost - Save a blog post
 **/

function savepost() {
    global $dbhost, $dbuser, $dbpass, $dbname;
    $title = isset($_REQUEST['title']) ? $_REQUEST['title'] : '';
    $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';
    $author = isset($_REQUEST['author']) ? $_REQUEST['author'] : '';
    $date = isset($_REQUEST['date']) ? $_REQUEST['date'] : '';
    $tags = isset($_REQUEST['tags']) ? $_REQUEST['tags'] : '';
    $slug = strtolower($title);
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/[^a-z0-9\-]+/', '', $slug);
    $slug = substr($slug, 0, 100);
    
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    $query = "INSERT INTO post(title, content, author, date, tags, slug) VALUES('$title', '$content', '$author', '$date', '$tags', '$slug')";
    $result = mysql_query($query);
    if($result === TRUE) {
        echo '<p>Yup, done.  <a href="index.php?mode=post&slug='.$slug.'">Wanna see it</a>?</p>';
    } else {
        echo '<p>Nah something went squiffy, Id go back...</p>';
    }
}

/**
 *  Show the 404 error page
 **/

function fourzerofour() {
    header("HTTP/1.0 404 Not Found");
    echo '<h1>Sorry :(</h1><p>Im just a computer, I dont know what to do with the URL Ive been given</p>';
}

/**
 *  List blog posts page
 **/

function listposts($view = false) {
    global $dbhost, $dbuser, $dbpass, $dbname;
    
    $link = mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
    $query = "SELECT p.title, p.content, p.date, a.name, p.tags, p.slug FROM post p LEFT JOIN author a ON ( p.author = a.id ) ORDER BY p.date DESC LIMIT 0, 100";
    $result = mysql_query($query);
    while($post = mysql_fetch_assoc($result)) {
        $post['content'] = substr(strip_tags($post['content']), 0, 255);
        $elements['posts'][] = $post;
    }
    
    if($view) {
        include($view);   
    } else {
        include("listpostsview.php");
    }
}

?>