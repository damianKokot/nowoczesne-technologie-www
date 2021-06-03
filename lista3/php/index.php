<?php include 'parts/head.php';?>
<?php $currentpage='about'; ?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body">
        <?php include 'parts/header.php';?>

        <article class="about">
            <header>
                <h2>About me</h2>
            </header>
            <p>
                I am a third year student at the Wrocław University of Technology. I don't like to stand still and that's why I'm a member of the Solvro scientific circle. I took part in two projects in Solvro - the application for TK Games and the application for Papua.
                Thanks to that I gained a lot of knowledge in writing applications in NodeJs, Python and Java. Moreover, I learned how to use Docker, create Dockerfile and docker-compose.
            </p>
        </article>

        <section class="contact">
            <h2>Contact</h2>
            <ul class="social-media">
                <li>
                    <a href="https://www.facebook.com/damian.kokot.18" target="_blank" class="icon-link">
                        <i class="fab fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/damianKokot" target="_blank" class="icon-link">
                        <i class="fab fa-github-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.linkedin.com/in/damian-kokot-18bb841b0" target="_blank" class="icon-link">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </section>
    </main>
<?php include 'parts/footer.php';?>
