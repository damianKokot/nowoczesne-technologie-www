<?php include 'parts/head.php';?>
<?php $currentpage='sante'; ?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body">
        <?php include 'parts/header.php';?>
        <article class="about-project">
            <header>
                <h3>Solvro Sante</h3>
            </header>
            <p>
                Solvro Sante is a charity project that collects and processes data on the health of the people of Papua in New Guinea. Our task was to create a system that works even in difficult conditions. My task was to create a module responsible for generating reports
                using data collected by LimeSurvey to database. Our work was described on Wrocław University. I've got a lot of experience with Java 8, git, Maven and basics of code review.
            </p>
            <pre>
              <code>
    graphFactory.generateChartPng(
      report.getGraph(),
      Paths.get(
          ReportController.tempDirResPath,
          "Graph.png"
      ).toString()
    );
              </code>
            </pre>
        </article>

        <div class="comment-list">
            <?php 
                    $project_id=2;
                    include './common/comments.php' ?>
            <?php if (isset($_SESSION['username'])) : ?>
                <form method="post" id="comment-form">
                    <textarea name="content" id="comment-content" placeholder="Enter your comment..." required></textarea>
                    <button type="submit" id="comment-submit">Comment</button>
                </form>
            <?php endif ?>
        </div>


        <?php  if (!isset($_SESSION['username'])) : ?>
            <a href="login.php" class="nav__link">Zaloguj się aby dodać komentarz</a>
        <?php endif ?>

        <?php include './parts/contact.php' ?>
    </main>
<?php include 'parts/footer.php';?>
