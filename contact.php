<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - CONTACT US </title>
    <style>
        :root{
            --gren:#2ec1ac;
        }
        .custom-alert{
            position: fixed;
            top: 80px;
            right: 25px;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Molestiae officiis non officia dignissimos harum delectus. <br>
            Eveniet deserunt facilis voluptatibus veniam ad dolorum odit
            magnam eaque quas alias, aut, et recusandae.
        </p>
    </div>

    <?php
        $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
        $values = [1];
        $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 px-4">
                <div class="bg-white rounded shadow p-4">
                    <iframe class="w-100 rouned mb-4" height="320"  src="<?php echo $contact_r['iframe']?>" ></iframe>
                    <h5 class="text-muted">Address</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
                    </a>

                    <h5 class="text-muted mt-4">Call Us</h5>
                    <a href="tel: + <?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-danger">
                        <i class="bi bi-telephone-fill"></i> + <?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php
                        if($contact_r['pn2']!=''){
                            echo <<<data
                                <a href="tel: + $contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-danger">
                                    <i class="bi bi-telephone-fill"></i> + $contact_r[pn2]
                                </a>
                            data;
                        }
                    ?>
                    <h5 class="text-muted mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-envelope"></i> <?php echo $contact_r['email'] ?>
                    </a>

                    <h5 class="text-muted mt-4">Follow Us</h5>

                    <?php
                        if($contact_r['tw']!=''){
                            echo <<<data
                                <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">
                                    <i class="bi bi-twitter me-1"></i>
                                </a>
                            data;
                        }
                    ?>

                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">
                                Name
                            </label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">
                                Email
                            </label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">
                                Subject
                            </label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">
                                Message
                            </label>
                            <textarea name="message" class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3 shadow-none">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($_POST['send'])){
            $frm_data = filteration($_POST);
            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
            $res = insert($q,$values,'ssss');
            if($res == 1){
                alert('success','Gửi thành công!');
            }
            else{
                alert('error','Gửi thất bại.! Vui lòng gửi lại.!');
            }
        }
    ?>

    <?php require('inc/footer.php'); ?>
</body>
</html>