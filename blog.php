<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title'] ?> - BLOG US </title>
    <style>
        :root{
            --gren:#2ec1ac;
        }
        .pop:hover{
            border-top-color: var(--gren) !important;
            transform: scale(1.03);
            transition: all 0.3s;

        }
        .categories li{
            list-style-type: none;
        }
        .categories a{
            text-decoration: none;
            color: #6c757d;
        }
        .text a{
            text-decoration: none;
            color: black;
        }
        .meta a{
            text-decoration: none;
        }
        .meta span{
            color:burlywood;
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Blog Details</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Molestiae officiis non officia dignissimos harum delectus. <br>
            Eveniet deserunt facilis voluptatibus veniam ad dolorum odit
            magnam eaque quas alias, aut, et recusandae.
        </p>
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="./images/facilities/IMG_16629.svg" width="40px">
                        <h5 class="p-2 m-2">hạajjjjjjjjjjjj</h5>
                    </div>
                </div>
            </div>  
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path$row[icon]" width="40px">
                        <h5 class="p-2 m-2"></h5>
                    </div>
                </div>
            </div>  
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path$row[icon]" width="40px">
                        <h5 class="p-2 m-2"></h5>
                    </div>
                </div>
            </div>  
            <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="$path$row[icon]" width="40px">
                        <h5 class="p-2 m-2"></h5>
                    </div>
                </div>
            </div>                        
        </div>
    </div> -->
    <section class="ftco-section bg-light">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 my-5 mb-4 px-4">
                    <div style="font: size 14px;">
                        <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                        <span class="text-secondary"> > </span>
                        <a href="room.php" class="text-secondary text-decoration-none">BLOG</a>
                    </div>
                </div>
                <div class="col-lg-8 blog-single">
                    <h2 class="mb-3">Far far away, behind the word mountains</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis, 
                        eius mollitia suscipit, quisquam doloremque distinctio perferendis et doloribus unde architecto optio laboriosam porro adipisci sapiente officiis nemo accusamus ad praesentium? Esse minima nisi et.
                         Dolore perferendis, enim praesentium omnis, iste doloremque quia officia optio deserunt molestiae voluptates soluta architecto tempora.
                    </p>
                    <p>
                        <img src="./images/blog/bg_1.jpg.webp" alt="" class="img-fluid">
                    </p>
                    <p>
                        Molestiae cupiditate inventore animi, maxime sapiente optio, 
                        illo est nemo veritatis repellat sunt doloribus nesciunt! 
                        Minima laborum magni reiciendis qui voluptate quisquam voluptatem 
                        soluta illo eum ullam incidunt rem assumenda eveniet eaque sequi 
                        deleniti tenetur dolore amet fugit perspiciatis ipsa, odit. 
                        Nesciunt dolor minima esse vero ut ea, repudiandae suscipit!
                    </p>
                    <h2 class="mb-3 mt-5">#2. Creative WordPress Themes</h2>
                    <p>
                    Temporibus ad error suscipit exercitationem hic molestiae totam obcaecati rerum, 
                    eius aut, in. Exercitationem atque quidem tempora maiores ex architecto voluptatum aut 
                    officia doloremque. Error dolore voluptas, omnis molestias odio dignissimos culpa ex 
                    earum nisi consequatur quos odit quasi repellat qui officiis reiciendis incidunt hic non? 
                    Debitis commodi aut, adipisci.
                    </p>
                    <p>
                        <img src="./images/blog/image_3.jpg.webp" alt="" class="img-fluid">
                    </p>
                    <p>
                        Molestiae cupiditate inventore animi, maxime sapiente optio, 
                        illo est nemo veritatis repellat sunt doloribus nesciunt! 
                        Minima laborum magni reiciendis qui voluptate quisquam voluptatem 
                        soluta illo eum ullam incidunt rem assumenda eveniet eaque sequi 
                        deleniti tenetur dolore amet fugit perspiciatis ipsa, odit. 
                        Nesciunt dolor minima esse vero ut ea, repudiandae suscipit!
                    </p>
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">hotel</a>
                            <a href="#" class="tag-cloud-link">hotel</a>
                            <a href="#" class="tag-cloud-link">hotel</a>
                            <a href="#" class="tag-cloud-link">hotel</a>
                        </div>
                    </div>

                    <div class="about-author d-flex p-4 bg-light rounded">
                        <div class="bio me-md-4 img">
                            <img src="./images/about/about.jpg" class="rounded-circle" style="width: 80px; height: 80px;">
                        </div>
                        <div class="desc">
                            <h3>George Washington</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut,
                                sunt placeat nam vero culpa sapiente consectetur similique, 
                                inventore eos fugit cupiditate numquam!</p>
                        </div>
                        

                        
                    </div>

                </div>
                <div class="col-lg-4 sidebar pl-md-4">
                    <div class="sidebar-box bg-light rounded mb-4">
                        <form class="search-form">
                            <div class="form-group">
                                <span></span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box mb-2">
                        <h3 class="mb-3">Hotel Services</h3>
                        <div class="d-md-flex">
                            <ul class="categories me-md-4">
                                <li class="mb-3">
                                    <a href="">FREE WIFI</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">EASY BOOKING</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">RESTAURANT</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">SWIMMING POOL</a>
                                </li>
                            </ul>
                            <ul class="categories me-md-4">
                                <li  class="mb-3">
                                    <a href="">FREE WIFI</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">EASY BOOKING</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">RESTAURANT</a>
                                </li>
                                <li  class="mb-3">
                                    <a href="">SWIMMING POOL</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-box mb-5">
                        <h3 class="mb-4">Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a href="" class="blog-img me-4";>
                                <img src="./images/users/IMG_17792.jpeg" alt="" class="img-fuild rounded" style="height: 80px;width:80px";>
                            </a>
                            <div class="text">
                                <h6 class="heading">
                                    <a href="">Far far away, behind the word mountains</a>
                                </h6>
                                <div class="meta">
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-calendar"></i> December 24, 2020</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-person-fill"></i> Admin</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-chat-fill"></i> 19</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a href="" class="blog-img me-4";>
                                <img src="./images/users/IMG_17792.jpeg" alt="" class="img-fuild rounded" style="height: 80px;width:80px";>
                            </a>
                            <div class="text">
                                <h6 class="heading fw-bold h-font">
                                    <a href="">Far far away, behind the word mountains</a>
                                </h6>
                                <div class="meta">
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-calendar"></i> December 24, 2020</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-person-fill"></i> Admin</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-chat-fill"></i> 19</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a href="" class="blog-img me-4";>
                                <img src="./images/users/IMG_17792.jpeg" alt="" class="img-fuild rounded" style="height: 80px;width:80px";>
                            </a>
                            <div class="text">
                                <h6 class="heading">
                                    <a href="">Far far away, behind the word mountains</a>
                                </h6>
                                <div class="meta">
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-calendar"></i> December 24, 2020</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-person-fill"></i> Admin</span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="">
                                            <span><i class="bi bi-chat-fill"></i> 19</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="sidebar-box md-4">
                        <h3 class="mb-4">Tag Cloud</h3>
                        <div>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                HOTEL
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                POOL
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                TV
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                AIRCON
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                RELAX
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                COZZY
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                ROOM
                            </span>
                            <span class='badge rounded bg-light text-dark mb-3 text-wrap me-1 mb-1 text-center' style="height: 30px;width:80px;";>
                                BAR
                            </span>
                        </div>
                    </div>

                    <div class="sidebar-box">
                        <h3 class="mb-3">Paragraph</h3>
                        <p style="font-size: 18px;">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, 
                            autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero
                             culpa sapiente consectetur similique, 
                            inventore eos fugit cupiditate numquam!
                        </p>
                    </div>
                       
                        

                    
                </div>
            </div>
        </div>
    </section>
    <?php require('inc/footer.php'); ?>
</body>
</html>