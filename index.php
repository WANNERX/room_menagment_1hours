<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM room WHERE room_id = $id";
    mysqli_query($conn, $sql);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT room_id, type_room.details, member.name AS member_name, owner.name AS owner_name FROM room 
            LEFT JOIN member ON room.id_member = member.id_member
            LEFT JOIN owner ON room.id_owner = owner.id_owner
            LEFT JOIN type_room ON room.id_type = type_room.id_room
            WHERE room_id = $id 
            GROUP BY room_id";

} else {
    $sql = "SELECT room_id, type_room.details, member.name AS member_name, owner.name AS owner_name FROM room 
            LEFT JOIN member ON room.id_member = member.id_member
            LEFT JOIN owner ON room.id_owner = owner.id_owner
            LEFT JOIN type_room ON room.id_type = type_room.id_room
            GROUP BY room_id";
}

$result = mysqli_query($conn, $sql);
$rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<html>
<head>
    <title>Room Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="btn btn-primary" href="index.php" role="button">Home</a>
        </li>
        
      </ul>
      <form class="mb-3" action="" method="post">
        <div class="input-group">
            <input type="text" name="id" class="form-control" placeholder="ค้นหาห้อง">
            <button type="submit" name="search" class="btn btn-primary">ค้นหา</button>
        </div>
    </form>
    </div>
  </div>
</nav>

<div class="container">
    <h1>รายการห้อง</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-primary me-md-2" type="button" href="insert.php" role="button">เพิ่มห้อง</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ห้อง</th>
                <th>ประเภทห้อง</th>
                <th>ชื่อผู้เช่า</th>
                <th>เจ้าของ</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room): ?>
                <tr>
                    <td><?php echo $room['room_id']; ?></td>
                    <td><?php echo $room['details']; ?></td>
                    <td><?php echo $room['member_name']; ?></td>
                    <td><?php echo $room['owner_name']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $room['room_id']; ?>" class="btn btn-primary">แก้ไข</a>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $room['room_id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">ลบ</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script></body>
</html>
