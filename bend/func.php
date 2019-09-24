<?php

include_once "db.php";
// getting all data
function view_data(){
    $con = connection();
    $query = "SELECT * FROM `customers`";
    $result = mysqli_query($con, $query);
    $table = '';
    $table .= '<thead>';
    $table .= '<tr>';
    $table .= '<th>#ID</th>';
    $table .= '<th>Name</th>';
    $table .= '<th>Email</th>';
    $table .= '<th>Gender</th>';
    $table .= '<th>Date of Birth</th>';
    $table .= '<th>Education</th>';
    $table .= '<th>Address</th>';
    $table .= '<th>Action</th>';
    $table .= '</tr>';
    $table .= '</thead>';
    $table .= '<tbody>';
    if(mysqli_num_rows($result)){
        
        while($row = mysqli_fetch_assoc($result)){
            $table .= '<tr>';
            $table .= '<td>'.$row['id'].'</td>';
            $table .= '<td>' . $row['fname'] . ' '. $row['lname'].'</td>';
            $table .= '<td>' . $row['email'] . '</td>';
            $table .= '<td>' . $row['gender'] . '</td>';
            $table .= '<td>' . $row['dob'] . '</td>';
            $table .= '<td>' . $row['education'] . '</td>';
            $table .= '<td>' . $row['address'] . '</td>';
            $table .= "<td><a data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editModal' href='' id='update' class='edit'>
            <i class='fa fa-edit'></i></a>  <a data-id='" . $row['id'] . "' class='delete' id='delete' href='' data-toggle='modal' data-target='#deleteModal'><i class='fa fa-trash'></i></a> <a data-id='" . $row['id'] . "' class='view' id='view' href='' data-toggle='modal' data-target='#viewModal'><i class='fa fa-eye'></i></a></td>";
            $table .= '</tr>';
        }
        
        echo json_encode(['status'=>'success', 'table' => $table]);
    } else {
        $table .= '<tr colspan="8"';
        $table .= '<td>NO DATA!</td>';
        echo json_encode(['status' => 'success', 'table' => $table]);
    }
    $table .= '</tbody>';
}

function add_data($post){
    $con = connection();

    $fname = $post['fname'];
    $lname = $post['lname'];
    $email = $post['email'];
    $password = $post['password'];
    $gender = $post['gender'];
    $dob = $post['dob'];
    $education = $post['education'];
    $address = $post['address'];
    $bio = $post['bio'];

    $query = "INSERT INTO customers (`fname`, `lname`, `email`, `password`, `gender`, `dob`, `education`, `address`, `bio`) Values ('$fname', '$lname', '$email', '$password', '$gender', '$dob', '$education', '$address', '$bio')";

    $result = mysqli_query($con, $query);
    if($result){
        echo json_encode(['status' => 'success', 'message' => 'Data Inserted Successfully!']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Inserted failed!']);
    }


}
// get data to edit
function getData($post){
    $con = connection();
    $id = $post['id'];
    $query = "SELECT `id`,`fname`, `lname`, `email`, `gender`, `dob`, `education`, `address`, `bio` FROM `customers` WHERE `id` = $id";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    if ($result) {
        echo json_encode(['status' => 'success', $data]);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Inserted failed!']);
    }
}

// edit data
function editData($post){
    $con = connection();

    $id = $post['id'];
    $fname = $post['fname'];
    $lname = $post['lname'];
    $email = $post['email'];
    $gender = $post['gender'];
    $dob = $post['dob'];
    $education = $post['education'];
    $address = $post['address'];
    $bio = $post['bio'];

    $query = "UPDATE `customers` SET `fname` = '$fname', `lname` = '$lname', `email` = '$email', `gender` = '$gender', `dob` = '$dob', `education` = '$education', `address` = '$address', `bio` = '$bio' WHERE `customers`.`id` = $id;";
    
    $result = mysqli_query($con, $query);
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Data Updated Successfully!']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Update failed!']);
    }
}

// Delete Function

function deleteData($post){
    $con = connection();
    $id = $post['id'];

    $query = "DELETE FROM `customers` WHERE `id` = $id";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Data Successfully DELETED!']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Delete failed!']);
    }
}

?>