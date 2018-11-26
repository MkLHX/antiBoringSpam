<?php require '../backEnd.php'; ?>
<?php require '../inc/header.php'; ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10 text-center my-5">
                <h1>Welcome To Anti Boring Spam!</h1>
                <h2>The <strong>free</strong> removing <strong>spam tool</strong></h2>
            </div>
            <div class="col-10">
                <?php
                if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
                    echo
                        '<div class="col text-center">' .
                        '<h1><strong class="text-danger">Please enter email and password!!</strong></h1>' .
                        '</div>';
                }
                if (isset($imapResponse) && !isset($boxContent)) {
                    echo
                        '<h3>Scanning for : ' . $_SESSION['email'] . '</h3>' .
                        '<h4>Inbox structure</h4>' .
                        '<div class="row">';
                    foreach ($imapResponse as $response) {
                        $label = $response['label'];
                        $status = $response['status'];
                        echo
                            "<div class='card m-1 col-2 shadow'>" .
                            "<div class='card-body'>" .
                            "<h5 class='card-title'><i class='fas fa-check'></i> $label</h5>" .
                            "<h6 class='card-subtitle mb-2 text-muted'></h6>" .
                            "<p class='card-text'><i class='fas fa-envelope'></i> $status->unseen / <i class='fas fa-envelope-open'></i> $status->messages</p>" .
                            "<a href='?box=$label' class='card-link text-center btn btn-info'>Go to</a>" .
                            "</div>" .
                            "</div>";
                    }
                    echo '</div>';
                }

                if (isset($boxContent)) {
                    echo '<div class="accordion" id="accordionExample">';
                    echo '<div class="card shadow my-3">' .
                        '<div class="card-header">' .
                        '<ul class="nav">' .
                        '<li class="nav-item">' .
                        '<a href="#" class="nav-link disabled"><i class="fas fa-envelope"></i> ' . $_SESSION['box'] . ' : ' . count($boxContent) . '</a>' .
                        '</li>' .
                        '<li class="nav-item">' .
                        '<a href="' . $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'] . '&clean=all" class="nav-link btn btn-danger"><i class="fas fa-trash"></i> Clean all</a>' .
                        '</li>' .
                        '</ul>' .
                        '</div>' .
                        '</div>';
                    foreach ($boxContent as $key => $content) {
                        //var_dump($content);
                        echo '<div class="card">' .
                            '<div class="card-header" id="' . ($key + 1) . '">' .
                            '<nav class="nav">' .
                            '<a href="#">' .
                            '<h5 class="mb-0">' .
                            '<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse' . ($key + 1) . '"' .
                            'aria-expanded="true" aria-controls="collapse' . ($key + 1) . '">' .
                            '#' . ($key + 1) . ' ' . $content['overview']->date . ' ' . $content['overview']->from .
                            '</button>' .
                            '</h5>' .
                            '</a>' .
                            '<a href="' . $_SERVER['PHP_SELF'] . $_SERVER['REQUEST_URI'] . '&clean=' . $content['overview']->uid . '" class="nav-link btn btn-danger"><i class="fas fa-trash"></i></a>' .
                            '</nav>' .
                            '</div>' .
                            '<div id="collapse' . ($key + 1) . '" class="collapse" aria-labelledby="heading' . ($key + 1) . '"' .
                            'data-parent="#accordionExample">' .
                            '<div class="card-body">' .
                            '<code>' .
                            $content['message'] .
                            '</code>' .
                            '</div>' .
                            '</div>' .
                            '</div>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

<?php require '../inc/footer.php'; ?>