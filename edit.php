<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $room_id = $_POST['id_room'];
    $id_type = $_POST['id_type'];
    $id_member = $_POST['id_member'];
    $id_owner = $_POST['id_owner'];
    $sql = "UPDATE room SET room_id = '$room_id', id_type = '$id_type', id_member = '$id_member', id_owner = '$id_owner'
    WHERE room_id = $id";
    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM room 
    WHERE room_id = $id";
    $result = mysqli_query($conn, $sql);
    $room = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
    exit();
}
?>

<html>
<head>
    <title>Edit Room</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>แก้ไขห้อง</h1>
    <form method="post">
    <div class="mb-3">
            <label for="id_room" class="form-label">ห้อง</label>
            <input type="text" class="form-control" id="id_room" name="id_room" value="<?php echo $room['room_id']; ?>">
        </div>
        <div class="mb-3">
            <label for="id_type" class="form-label">ID ประเภทห้อง</label>
            <input type="text" class="form-control" id="id_type" name="id_type" value="<?php echo $room['id_type']; ?>">
        </div>
        <div class="mb-3">
            <label for="id_member" class="form-label">ID ชื่อผู้เช่า</label>
            <input type="text" class="form-control" id="id_member" name="id_member" value="<?php echo $room['id_member']; ?>">
        </div>
        <div class="mb-3">
            <label for="id_owner" class="form-label">ID เจ้าของ</label>
            <input type="text" class="form-control" id="id_owner" name="id_owner" value="<?php echo $room['id_owner']; ?>">
        </div>

        <input type="hidden" name="id" value="<?php echo $room['room_id']; ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script></body>
</html>
