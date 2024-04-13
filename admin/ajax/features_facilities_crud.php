<?php

    require('../inc/db_config.php');
    require('../inc/enssentials.php');
    adminLogin();

    if(isset($_POST['add_features'])){
        $frm_data = filteration($_POST);

        try{
            $q= "INSERT INTO `features`(`name`) VALUES (?)";
            $values = [$frm_data['name']];
            $res = insert($q,$values,'s');
            echo $res;
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
       
    }

    if(isset($_POST['get_features'])){
        $res = selectAll('features');
        $i = 1;

        while($row = mysqli_fetch_assoc($res)){
            echo <<<data

                <tr class="text-center align-middle">
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>
                        <button type="button" onclick="rem_features($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_features'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_features']];

        $check_q = select('SELECT * FROM `room_features` WHERE `features_id`=?',[$frm_data['rem_features']],'i');

        if(mysqli_num_rows($check_q)==0){
            $q = "DELETE FROM `features` WHERE `id`=?";
            $res = delete($q,$values,'i');
            echo $res;
        }
        else{
            echo 'room_added';
        }
        
        
       
    }

    if(isset($_POST['add_facility'])){
        $frm_data = filteration($_POST);

        try {
            $img_r = uploadSVGImage($_FILES['icon'], FACILITIES_FOLDER);
            if ($img_r == 'inv_img') {
                throw new Exception('Chỉ cho phép hình ảnh SVG!');
            } else if ($img_r == 'inv_size') {
                throw new Exception('Hình ảnh phải nhỏ hơn 1MB!');
            } else if ($img_r == 'upd_failed') {
                throw new Exception('Tải hình ảnh không thành công. Server Down!');
            } else {
                $q = "INSERT INTO `facilities`(`icon`,`name`,`desciption`) VALUES (?,?,?)";
                $values = [$img_r, $frm_data['name'], $frm_data['desc']];
                $res = insert($q, $values, 'sss');
                echo $res;
            }
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if(isset($_POST['get_facilities'])){
        $res = selectAll('facilities');
        $i = 1;
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res)){
            echo <<<data

                <tr class="text-center align-middle">
                    <td>$i</td>
                    <td><img src="$path$row[icon]" width="40px"></td>
                    <td>$row[name]</td>
                    <td>$row[desciption]</td>
                    <td>
                        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_facility'])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_facility']];

        $check_q = select('SELECT * FROM `room_facilities` WHERE `facilities_id`=?',[$frm_data['rem_facility']],'i');

        if(mysqli_num_rows($check_q)==0){
            $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
            $res = select($pre_q,$values,'i');
            $img = mysqli_fetch_assoc($res);

            if(deleteImage($img['icon'],FACILITIES_FOLDER)){
                $q = "DELETE FROM `facilities` WHERE `id`=?";
                $res = delete($q,$values,'i');
                echo $res;
            }
            else{
                echo 0;
            }
        }
        else{
            echo 'room_added';
        }

        
        
    }

?>