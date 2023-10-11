<?php
    include 'layouts/header.html';
    include '../classes/User.php';
    include 'main-nav.php';
    $user = new User;

    $all_users = $user->displayUsers();
    $user_info = $user->getUser();
?>


<div class="container">
    <table class="table mt-5 table-bordered">
        <thead class="table-dark">
            <th></th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>USERNAME</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($all_users as $user): ?>
                <tr>
                    <?php if ($user['photo'] ) : ?>
                    
                            <td><div class="mb-2"><img src="../assets/images/<?=$user['photo']?>" alt="$<?=$user_info['photo']?>" class="profile-photo d-block mx-auto" style="width: 5rem; height: 5rem; object-fit: cover;"></div></td>
                    <?php else : ?>
                            <td class="text-center"><i class="fa-solid fa-circle-user fs-2"></i></td>
                    <?php endif; ?>
                    <td><?= $user['first_name'] ?></td>
                    <td><?= $user['last_name'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td>
                        <?php if($_SESSION['id'] == $user['id']) : ?>
                            <a href="../views/edit-user.php" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="../actions/delete-user.php" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>    
        </tbody>
    </table>
</div>

<?php include 'layouts/footer.html' ?>