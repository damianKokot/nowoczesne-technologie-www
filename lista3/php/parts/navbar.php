    <noscript>
        <nav>
            <div class="nav-links">
                <a <?php if($currentpage == "about" ) { echo ' class="active"';} else { echo 'href="./index.php"'; } ?>>/about</a>
                <a <?php if($currentpage == "interests" ) { echo ' class="active"';} else { echo 'href="./interests.php"'; } ?>>/interests</a>
                <a <?php if($currentpage == "projects" ) { echo ' class="active"';} else { echo 'href="./projects.php"'; } ?>>/projects</a>
            </div>
        </nav>
    </noscript>

    <nav class="top-nav">
        <div class="nav-list">
            <a <?php if($currentpage == "about" ) { echo ' class="nav-link active"';} else { echo ' class="nav-link" href="./index.php"'; } ?>>/about</a>
            <a <?php if($currentpage == "interests" ) { echo ' class="nav-link active"';} else { echo ' class="nav-link" href="./interests.php"'; } ?>>/interests</a>
            <a <?php if($currentpage == "projects" ) { echo ' class="nav-link active"';} else { echo ' class="nav-link" href="./projects.php"'; } ?>>/projects</a>
            <?php  if (!isset($_SESSION['username'])) : ?>
                <a href="./login.php" class="nav-link">/login</a>
                <a href="./register.php" class="nav-link">/register</a>
            <?php endif ?>
            <?php  if (isset($_SESSION['username'])) : ?>
                <a href="./logout.php" class="nav-link">/logout</a>
            <?php endif ?>
        </div>
    </nav>
    <div class="menu-toggler">
        <div class="bar half start"></div>
        <div class="bar"></div>
        <div class="bar half end"></div>
    </div>