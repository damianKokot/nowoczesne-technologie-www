<?php include 'parts/head.php';?>
<?php $currentpage='trading_bot'; ?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body">
        <?php include 'parts/header.php';?>
        <article class="about-project">
            <header>
                <h3>Trading bot</h3>
            </header>
            <p>
                Trading bot is part of the Python course in my studies. In a team of four we have created a platform for investing fictional money using one of the three algorithms created by us. This project brought me a lot of knowledge about pipeline configuration,
                team management and Django knowledge.
            </p>
            <pre>
            <code>
      RUN conda create -n trade-server -y
      COPY environment.yml .
      RUN conda env update -n trade-server
      
      RUN echo "source activate trade-server" > ~/.bashrc
      ENV PATH /opt/conda/envs/trade-server/bin:$PATH
            </code>
          </pre>
        </article>

        <div class="comment-list">
            <?php 
                    $project_id=3;
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
