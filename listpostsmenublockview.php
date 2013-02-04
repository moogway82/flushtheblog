<ul>
    <?php foreach($elements['posts'] as $post): ?>
    <li>
        <a href="index.php?mode=post&slug=<?php echo $post['slug']; ?>"><strong><?php echo $post['title']; ?></strong> - <?php echo $post['date']; ?></a>
    </li>
    <?php endforeach; ?>
</ul>