<html>

<?php include('head.php'); ?>

<body>
    <div id="wrapper">
    <?php include('header.php'); ?>
    
    <div class="content">
        <ul>
            <?php foreach($elements['posts'] as $post): ?>
            <li>
                <p><a href="index.php?mode=post&slug=<?php echo $post['slug']; ?>"><strong><?php echo $post['title']; ?></strong> - <?php echo $post['name']; ?> - <?php echo date("F j, Y, g:i a", strtotime($post['date'])); ?> - <?php echo $post['tags']; ?></a></p>
                <p><?php echo $post['content']; ?></p>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <div class="aside">
        <?php listposts("listpostsmenublockview.php"); ?>
    </div>
    
    <?php include('footer.php'); ?>
    </div>
</body>
</html>