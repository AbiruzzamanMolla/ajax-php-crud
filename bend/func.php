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
            $table .= '<td>' . $row['fname'] . '</td>';
            $table .= '<td>' . $row['email'] . '</td>';
            $table .= '<td>' . $row['gender'] . '</td>';
            $table .= '<td>' . $row['dob'] . '</td>';
            $table .= '<td>' . $row['education'] . '</td>';
            $table .= '<td>' . $row['address'] . '</td>';
            $table .= "<td><a href='edit.php?id=" . $row['id'] . "' data-toggle='modal' data-target='#editModal'><i class='fa fa-edit'></i>
                </a> || <a class='delete' d-id='' href='delete.php?id=" . $row['id'] . "' data-toggle='modal' data-target='#deleteModal'><i
                class='fa fa-trash'></i></a> </td>";
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

    $q = "INSERT INTO customers (`fname`, `lname`, `email`, `password`, `gender`, `dob`, `education`, `address`, `bio`) Values ('$fname', '$lname', '$email', '$password', '$gender', '$dob', '$education', '$address', '$bio')";

    $result = mysqli_query($con, $q);
    if($result){
        echo json_encode(['status' => 'success', 'message' => 'Data Inserted Successfully!']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Data Inserted failed!']);
    }


}
?>