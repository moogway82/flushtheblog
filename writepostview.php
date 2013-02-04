<html>
<?php include('head.php'); ?>
<body>
    <div id="wrapper">
    <?php include('header.php'); ?>
    
    <h1>Write New Blog Post</h1>
    <form action="index.php?mode=savepost" method="post">
        <p><label>Title: <input type="text" name="title" /></label></p>
        <p><label>Content: <textarea name="content"></textarea></label></p>
        <p><label>Author:
            <select name="author">
                <?php foreach($elements['authors'] as $author): ?>
                <option value="<?php echo $author['id']; ?>"><?php echo $author['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </label></p>
        <p><label>Date: <input type="text" name="date" /></label></p>
        <p><label>Tags: <input type="text" name="tags" /></label></p>
        <p><input type="submit" value="Submit"/></p>
    </form>
    
    <div class="aside">
        <?php listposts("listpostsmenublockview.php"); ?>
    </div>
    
    <?php include('footer.php'); ?>
    </div>
</body>
</html>