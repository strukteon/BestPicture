<?php
session_start();
require_once "../php/user.php";
require_once "../php/photo.php";
require_once "../php/contest.php";


if (get_signed_in_user_id() == -1) {
$url = "../login/needSignIn.html";
header("Location: " . $url);
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="../assets/styles/profil2.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.ico">
    <link href="../assets/styles/navbar.css" rel="stylesheet">
    <link href="../assets/styles/footer.css" rel="stylesheet">
    <link href="../assets/styles/gallery.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>BP | Profil</title>
</head>
<body>

<?php
$user = get_signed_in_user();
$userid = $user['user_id'];
$name = $user['vorname'] . ' ' . $user['nachname'];
$email = $user['email'];
$likes = get_count_likes_of_user($userid);
$posts = get_count_photos_of_user($userid);
?>
<header>
    <div class="wrapper">
        <a href="../index.php"> <img class="logo" src="../assets/images/Logo.png" alt="logo"></a>
        <nav>
            <a href="../index.php">Home</a> <a href="../login/abmelden.html">Abmelden</a> <a href="../upload/index.php">Upload</a>
            <a href="index.php"> <img class="user" src="../assets/images/user.png" alt="user"> </a>
        </nav>

    </div>
</header>
<main>
    <div class="text content-area">
        <article class="wrapper profil">
            <!--<img class="bo boimg-1" src="../assets/images/Logo_light.jpg" alt="placehold">-->
            <div class="text">
                <p id="h5"><?php echo $name ?></p>
                <p class="acc"><span class="bold"><?php echo $email ?></span></p>
                <p class="acc"><span class="bold"><?php echo $likes ?></span> Likes</p>
                <p class="acc"><span class="bold"><?php echo $posts ?></span> Posts</p>
            </div>
            <?php
            if (get_signed_in_user()['is_admin'] == 1) {
                echo '<a href="../admin%20panel.html" class="submit" id="submit">Admin Panel</a>';
            }
            ?>
        </article>
    </div>
    <div class="main gallery">
        <p class="u1">Beiträge</p>
        <div class="gallery-image">
            <?php
            $photos = get_all_photos_by_user($userid);

            foreach ($photos as $photo) {

                $id = $photo['photo_id'];
                $path = $photo['path'];
                $namePhoto = $photo['title'];
                $photografer = get_username_by_photo($photo['photo_id']);

                echo "<a href='../comment/index.php?id=$id'>
                        <div class='img-box'>
                            <img src='../$path' alt='$namePhoto'/>
                            <div class='transparent-box'>
                                <div class='caption'>
                                    <p>$namePhoto</p>
                                    <p class='opacity-low'>$photografer</p>
                                </div>
                            </div>
                        </div>
                       </a>";
            }
            ?>
        </div>
    </div>
    </div>
</main>
<footer>
    <p id="contact">Contact</p><br>
    <div class="emails">
        <p><a href="mailto:7046@htl.rennweg.at">Dietrich Kops</a></p>
        <p>●</p>
        <p><a href="mailto:7047@htl.rennweg.at">Johanna Kronfuß</a></p>
        <p>●</p>
        <p><a href="mailto:7055@htl.rennweg.at">Nils Schneider-Sturm</a></p>
        <p>●</p>
        <p><a href="mailto:7053@htl.rennweg.at">Nicoletta Sarzi Sartori</a></p>
    </div>

    <img class="logofooter" src="../assets/images/Logo.png" alt="logo">
    <a href="../rechte/rechte.php"><p class="agbs">Datenschutzerklärung | AGBs</p></a>
</footer>
</body>
</html>