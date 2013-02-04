<html>
    
<?php include('head.php'); ?>

<body>
    
    <div id="wrapper">
    
    <?php include('header.php'); ?>
    
    <div class="content">
        <h1><?php echo $elements['title']; ?></h1>
        <?php echo $elements['content']; ?>            
        <div class="blogger">
            <p><i><?php echo $elements['name']; ?></i></p>
            <p><i><?php echo $elements['date']; ?></i></p>
        </div>
    </div>
    
    <div class="aside">
        <?php listposts("listpostsmenublockview.php"); ?>
    </div>
    
    <?php include('footer.php'); ?>
    
    </div>
</body>
</html>