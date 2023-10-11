<?php
    include 'layouts/header.html';
    include '../classes/User.php';
    include 'main-nav.php';
    $user = new User;

    $user_info = $user->getUser();

    if (isset($_POST['btn_update'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $user->updateUserInfo($first_name, $last_name, $username);

        $user_id = $_SESSION['id'];
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $user->updatePhoto($user_id, $photo_name, $photo_tmp);
    }

 ?>

<div class="container mt-5">
    <div class="card border-0">
        <div class="card-body w-50 mx-auto">
            <form action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center">EDIT USER</h2>
                <?php if ($user_info['photo']): ?>
                        <div class="mb-2"><img src="../assets/images/<?=$user_info['photo']?>" alt="$<?=$user_info['photo']?>" class="profile-photo d-block mx-auto" style="width: 9rem; height: 9rem; object-fit: cover;"></div>
                <?php else: ?>
                        <div class="text-center"><i class="fa-solid fa-user display-1 mb-2 text-secondary"></i></div>
                <?php endif; ?>
                <input type="file" class="form-control w-50 mx-auto" name="photo">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" name="first_name" id="" class="form-control" value="<?= $user_info['first_name']?>">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" name="last_name" id="" class="form-control" value="<?= $user_info['last_name']?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" name="username" id="" class="form-control" value="<?= $user_info['username'] ?>">
                </div>
                <button type="submit" name="btn_update" class="btn btn-warning w-25 float-end btn-sm">Save</button>
                <a href="../views/dashboard.php" class="btn btn-secondary float-end btn-sm me-1" >Cancel</a>                           
            </form>
        </div>        
    </div>
</div>

<?php include 'layouts/footer.html' ?>