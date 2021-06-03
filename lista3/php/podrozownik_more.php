<?php include 'parts/head.php';?>

<body>
    <?php include 'parts/navbar.php';?>

    <main id="main_body">
        <?php include 'parts/header.php';?>
        <article class="about-project">
            <header>
                <h3>Podrozownik</h3>
            </header>
            <p>
                Thanks to this project I've learned a lot about project management and got familiar with technologies like Django REST Framework and React. Moreover, the project was implemented using basic DevOps techniques like - Continious Integration using a pipeline
                configured in Gitlab-ci to run separate tasks for frontend and backend, - Continious Deployment on Heroku using pipeline and dpl.
            </p>

            <pre>
            <code>
      deploy_to_production:
        stage: deploy
        script:
          - apt-get update -qy
          - apt-get install -y ruby-dev
          - gem install dpl
          - cd api/
          - dpl --provider=heroku --app=$HEROKU_APP_NAME --api-key=$HEROKU_AUTH_TOKEN
        rules:
          - if: '$CI_COMMIT_BRANCH == "master"'

            </code>
          </pre>
        </article>

        <div class="comment-list">
            <?php 
                    $project_id=1;
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
