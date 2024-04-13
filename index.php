<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - HOME</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        .avaibility-form{
            position: relative;
            margin-top: -50px;
            z-index: 2;
        }
        .img{
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 280px;
        }
        .f5{
            
            font-size: 30px;
        }
        @media screen and (max-width:575px){
            .avaibility-form{
                margin-top: 25px;
                padding: 0 35px;
            }
            
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <!-- Phần Slide -->
    <div class="container-fluid px-lg-4 mt-4">
        <!-- Swiper -->
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');
                    while($row = mysqli_fetch_assoc($res)){
                        $path = CAROUSEL_IMG_PATH;
                        echo <<<data
                            <div class="swiper-slide">
                                <img src="$path$row[image]" class="w-100 d-block"/>
                            </div>
                        data;
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Kết thúc phần slide -->

    <!-- Check avaibility form -->
    <div class="container avaibility-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rouned">
                <h5 class="mb-4">Check Booking Avaibility</h5>
                <form>
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight:500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight:500;">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Kết thúc Check avaibility form -->

    <!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-blod h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
                <?php
                    $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

                    while($room_data = mysqli_fetch_assoc($room_res)){
                        //get feature of room
                        $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f 
                            INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                            WHERE rfea.room_id='$room_data[id]';");

                        $features_data="";
                        while($fea_row = mysqli_fetch_assoc($fea_q)){
                            $features_data .="
                            <span class='badge rounded-pill bg-light text-dark mb-3 text-wrap me-1 mb-1'>
                                $fea_row[name]
                            </span>
                            ";
                        } 

                        // get facilities of room
                        $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f 
                            INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id 
                            WHERE rfac.room_id='$room_data[id]';");
                        $facilities_data="";
                        while($fac_row = mysqli_fetch_assoc($fac_q)){
                            $facilities_data .="
                                <span class='badge rounded-pill bg-light text-dark mb-3 text-wrap me-1 mb-1'>
                                    $fac_row[name]
                                </span>
                            ";
                        }
                        
                        //get image of room
                        $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                        $thumb_q = mysqli_query($con,"SELECT * FROM `room_images`
                         WHERE `room_id`='$room_data[id]' 
                         AND `thumb`='1'");

                        if(mysqli_num_rows($thumb_q)>0){
                            $thumb_res = mysqli_fetch_assoc($thumb_q);
                            $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];

                        }

                        $book_btn ="";
                        if(!$settings_r['shutdown']){
                            $book_btn = "<a href='#' class='btn btn-sm text-white custom-bg shadow-none'>Book Now</a>";
                        };

                        //print room card

                        echo <<<data
                            <div class="col-lg-4 col-md-6 my-3">
                                <div class="card border-0 shadow" style="max-width: 400px;margin: auto;">
                                    <img src="$room_thumb" class="card-img-top img">
                                    <div class="card-body">
                                    <h5 class="text-center f5 h-font">$room_data[name]</h5>
                                    <h6 class="mb-4">$$room_data[price] for one night</h6>
                                    <div class="features mb-4">
                                        <h6 class="mb-1">Features</h6>
                                        $features_data
                                    </div>
                                    <div class="facilities mb-4">
                                        <h6 class="mb-1">Facilities</h6>
                                        $facilities_data
                                    </div>
                                    <div class="guests mb-4">
                                        <h6 class="mb-1">Guests</h6>
                                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                            $room_data[adult] Adults
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">
                                            $room_data[children] Children
                                        </span>
                                    </div>
                                    <div class="rating mb-4">
                                        <h6 class="mb-1">Rating</h6>
                                        <span class="badge rounded-pill bg-light">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-evenly mb-2">
                                        $book_btn
                                        <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        data;

                    }
                ?>

            <div class="col-lg-12 text-center mt-5">
                <a href="room.php" class="btn btn-sm btn-outline-dark rouned-0 fw-blod shadow-none">More Rooms >>></a>
            </div>
        </div>
    </div>

    <!-- Our Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-blod h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5 ">
            <?php
                $res = mysqli_query($con,"SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5 ");
                $path = FACILITIES_IMG_PATH;
                while($row = mysqli_fetch_assoc($res)){
                    echo <<<query
                        <div class="col-lg-2 col-md-2 text-center bg-white rouned shadow py-4 my-3">
                            <img src="$path$row[icon]" width="50px">
                            <h5 class="mt-3">$row[name]</h5>
                        </div>
                    query;
                }
            ?>
            <div class="col-lg-12 text-center mt-5">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rouned-0 fw-blod shadow-none">More Facilities >>></a>
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Testmonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-blod h-font">TESTIMONIALS</h2>
    <div class="container mt-5">
        <!-- Swiper -->
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/features/OIP.jpg" width="50px">
                        <div>
                            <h5 class="m-0 ms-2 mb-1">Randow User1</h5>
                            <h6 class="m-0 ms-2">Randow User1</h6>
                        </div>
                    </div>
                    
                    <p>
                        Đó là một trải nghiệm tuyệt vời.
                        Phòng đó thật là tốt và chất lượng dịch vụ rất ổn
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/features/OIP.jpg" width="50px">
                        <div>
                            <h5 class="m-0 ms-2 mb-1">Randow User1</h5>
                            <h6 class="m-0 ms-2">Randow User1</h6>
                        </div>
                    </div>
                    <p>
                        Đó là một trải nghiệm tuyệt vời.
                        Phòng đó thật là tốt và chất lượng dịch vụ rất ổn
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/features/OIP.jpg" width="50px">
                        <div>
                            <h5 class="m-0 ms-2 mb-1">Randow User1</h5>
                            <h6 class="m-0 ms-2">Randow User1</h6>
                        </div>
                    </div>
                    <p>
                        Đó là một trải nghiệm tuyệt vời.
                        Phòng đó thật là tốt và chất lượng dịch vụ rất ổn
                    </p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>

                
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rouned-0 fw-blod shadow-none">Know More >>></a>
        </div>
    </div>
    <!-- End Testimonials -->

    <!-- BLOG -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-blod h-font">BLOG</h2>
    <div class="container-xl mt-5">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000"></div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="blog-entry justify-content-end aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <a href="blog-detail.php" class="block-20 img d-flex align-items-end mb-2 rounded" style="background-image: url('./images/rooms/IMG_17358.webp');"></a>
                    <div class="text">
                        <p class="meta" style="color:dimgrey;">
                            <span>ADMIN</span>
                            <span>March. 13, 2024</span>
                            <a href="#" class="text-decoration-none text-info">3 Comments</a>
                        </p>
                        <h3 class="heading mb-3">
                            <a href="#" class="text-decoration-none text-dark">Best Hotel Near Beach in Hawaii</a>
                        </h3>
                        <p style="font-size: 15px; font-weight:500;color:darkgray;">
                            A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="blog-entry justify-content-end aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <a href="blog-detail.php" class="block-20 img d-flex align-items-end mb-2 rounded" style="background-image: url('./images/rooms/IMG_17358.webp');"></a>
                    <div class="text">
                        <p class="meta" style="color:dimgrey;">
                            <span>ADMIN</span>
                            <span>March. 13, 2024</span>
                            <a href="#" class="text-decoration-none text-info">3 Comments</a>
                        </p>
                        <h3 class="heading mb-3">
                            <a href="#" class="text-decoration-none text-dark">Best Hotel Near Beach in Hawaii</a>
                        </h3>
                        <p style="font-size: 15px; font-weight:500;color:darkgray;">
                            A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="blog-entry justify-content-end aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <a href="blog-detail.php" class="block-20 img d-flex align-items-end mb-2 rounded" style="background-image: url('./images/rooms/IMG_17358.webp');"></a>
                    <div class="text">
                        <p class="meta" style="color:dimgrey;">
                            <span>ADMIN</span>
                            <span>March. 13, 2024</span>
                            <a href="#" class="text-decoration-none text-info">3 Comments</a>
                        </p>
                        <h3 class="heading mb-3">
                            <a href="#" class="text-decoration-none text-dark">Best Hotel Near Beach in Hawaii</a>
                        </h3>
                        <p style="font-size: 15px; font-weight:500;color:darkgray;">
                            A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 d-flex">
                <div class="blog-entry justify-content-end aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <a href="blog-detail.php" class="block-20 img d-flex align-items-end mb-2 rounded" style="background-image: url('./images/rooms/IMG_17358.webp');"></a>
                    <div class="text">
                        <p class="meta" style="color:dimgrey;">
                            <span>ADMIN</span>
                            <span>March. 13, 2024</span>
                            <a href="#" class="text-decoration-none text-info">3 Comments</a>
                        </p>
                        <h3 class="heading mb-3">
                            <a href="#" class="text-decoration-none text-dark">Best Hotel Near Beach in Hawaii</a>
                        </h3>
                        <p style="font-size: 15px; font-weight:500;color:darkgray;">
                            A small river named Duden flows by their place and supplies it with the necessary regelialia.
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
       

        
        <div class="col-lg-12 text-center mt-5">
            <a href="about.php" class="btn btn-sm btn-outline-dark rouned-0 fw-blod shadow-none">Know More >>></a>
        </div>
    </div>
    <!-- End BLOG -->

    <!-- React US -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-blod h-font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rouned">
                <iframe class="w-100 rouned" height="320"  src="<?php echo $contact_r['iframe'] ?>" ></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rouned mb-4">
                    <h5 class="text-muted">Call Us</h5>
                    <!-- Cách 1 -->
                    <a href="tel: + <?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-danger">
                        <i class="bi bi-telephone-fill"></i> + <?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <!-- Cách 2 -->
                    <?php
                        if($contact_r['pn2']!=''){
                            echo <<<data
                                <a href="tel: + $contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-danger">
                                    <i class="bi bi-telephone-fill"></i> + $contact_r[pn2]
                                </a>
                            data;
                        }
                    ?>
                    
                </div>
                <div class="bg-white p-4 rouned mb-4">
                    <h5 class="text-muted">Follow Us</h5>
                    <?php
                        if($contact_r['tw']!=''){
                            echo <<<data
                                <a href="$contact_r[tw]" class="d-inline-block mb-3">
                                    <span class="badge bg-light text-dark fs-6 p-2">
                                        <i class="bi bi-twitter me-1"></i> Twitter
                                    </span>
                                </a>
                            data;
                        }
                    ?>
                    
                    <br>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Insatagram
                        </span>
                    </a>

                </div>

            </div>
        </div>
    </div>
    <!-- End React Us -->

    <!-- Password reset modal -->
    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="recovery_form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-shield-lock fs-3 me-2"></i>  Mật khẩu mới
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">New Password</label>
                            <input type="password" name="pass" required class="form-control shadow-none">
                            <input type="hidden" name="email">
                            <input type="hidden" name="token">

                        </div>
                        <div class="mb-2 text-end">
                            <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END -->

    <?php require('inc/footer.php'); ?>

    <?php
        if(isset($_GET['account_recovery'])){
            $data = filteration($_GET);

            $t_data = date('Y-m-d');

            $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
             [$data['email'],$data['token'],$t_data],'sss');
            
            if(mysqli_num_rows($query) ==1){
                echo<<<showModal
                <script>
                    var myModal = document.getElementById('recoveryModal');
                    myModal.querySelector("input[name='email']").value = '$data[email]';
                    myModal.querySelector("input[name='token']").value = '$data[token]';


                    var modal = bootstrap.Modal.getOrCreateInstance(myModal);
                    modal.show();
                </script>
                showModal;
            }
            else{
                alert("error","Invalid or Expired Link!");
            }

        }
    ?>

   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

     <!-- Link JS -->
    <script src="./JS/index.js"></script>
    <!-- Kết thúc link JS -->

    <script>
        var swiper = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            loop: true,
            coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
            },
            pagination: {
            el: ".swiper-pagination",
            },
            breakpoints: {
                320:{
                    slidesPerView:1,

                },
                640:{
                    slidesPerView:1,

                },
                768:{
                    slidesPerView:2,

                },
                1024:{
                    slidesPerView:3,

                },
            },
        });
    </script>
    

</body>
</html>