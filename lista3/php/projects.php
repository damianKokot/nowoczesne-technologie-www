<?php include 'parts/head.php';?>
<?php $currentpage='projects'; ?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body">
        <?php include 'parts/header.php';?>

        <div class="projects">
            <ul>
                <li>
                    <article>
                        <header>
                            <h3>Solvro Sante</h3>
                        </header>
                        <p>
                            Developed software used to collect data on the health of the population in Papua New Guinea and perform processing necessary to generate reports with an aim of improving the living conditions of the country’s citizens.
                        </p>
                        <footer>
                            <ul class="skills-got">
                                <li>Java</li>
                                <li>MySQL</li>
                                <li>git</li>
                                <li>Maven</li>
                                <li>Docker</li>
                                <li><a href="./sante_more.php">See More...</a></li>
                            </ul>
                        </footer>
                    </article>
                </li>

                <li>
                    <article>
                        <header>
                            <h3>Podrozownik</h3>
                        </header>
                        <p>
                            I was a full-stack developer and leader in the Podrozownik project, where we were working on a platform that connects motorcyclists and enables them to participate in travel events.
                        </p>
                        <footer>
                            <ul class="skills-got">
                                <li>Javascript</li>
                                <li>React.js</li>
                                <li>git</li>
                                <li>Teamwork</li>
                                <li>Gitlab.ci</li>
                                <li><a href="./podrozownik_more.php">See More...</a></li>
                            </ul>
                        </footer>
                    </article>
                </li>

                <li>
                    <article>
                        <header>
                            <h3>Trading bot</h3>
                        </header>
                        <p>
                            Trading bot is part of the Python course in my studies. In a team of four we have created a platform for investing fictional money using one of the three algorithms created by us. This project brought me a lot of knowledge about pipeline configuration,
                            team management and Django knowledge.
                        </p>
                        <footer>
                            <ul class="skills-got">
                                <li>Python</li>
                                <li>Django</li>
                                <li>Anaconda</li>
                                <li>git</li>
                                <li>TeamLead</li>
                                <li><a href="./trading_bot_more.php">See More...</a></li>
                            </ul>
                        </footer>
                    </article>
                </li>
            </ul>
        </div>
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
