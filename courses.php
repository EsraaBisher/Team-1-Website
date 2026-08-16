<?php

include_once "header.php";

$courses = [
    [
        "id" => "web-design",
        "title" => "Web Design Fundamentals",
        "description" => "Learn the core principles of web design, including HTML, CSS, and how to build responsive layouts.",
        "duration" => "10 Hours",
        "instructor" => "Ayat Osama",
        "image" => "Web Design.JFIF",
        "avatar" => "avatars\Avatar20.png" 
    ],
    [
        "id" => "ui-ux",
        "title" => "UI / UX Design",
        "description" => "Master user interface and experience design. Learn wireframing, prototyping, and usability testing.",
        "duration" => "12 Hours",
        "instructor" => "Esraa Bisher",
        "image" => "UI UX Design.JFIF",
        "avatar" => "avatars\Avatar07.png"
    ],
    [
        "id" => "mobile-app",
        "title" => "Mobile App Development",
        "description" => "Dive into building native and cross-platform mobile applications using modern frameworks.",
        "duration" => "15 Hours",
        "instructor" => "Toka Moustafa",
        "image" => "Mobile App Development2.JFIF",
        "avatar" => "avatars\Avatar12.png"
    ],
    [
        "id" => "graphic-design",
        "title" => "Graphic Design for Beginners",
        "description" => "Discover the fundamentals of graphic design, color theory, typography, and visual communication.",
        "duration" => "8 Hours",
        "instructor" => "Tasneem Ahmed",
        "image" => "Graphic Design.jpg",
        "avatar" => "avatars\Avatar11.png"
    ],
    [
        "id" => "front-end",
        "title" => "Front-End Web Development",
        "description" => "Become proficient in front-end web development to create interactive and dynamic websites.",
        "duration" => "20 Hours",
        "instructor" => "Ziad Zidan",
        "image" => "Front-End Web Development.JFIF",
        "avatar" => "avatars\Avatar06.png"
    ],
    [
        "id" => "digital-marketing",
        "title" => "Digital Marketing",
        "description" => "Learn how to reach your audience effectively using SEO, social media, and online advertising strategies.",
        "duration" => "14 Hours",
        "instructor" => "Waleed Allam",
        "image" => "Digital Marketing.JFIF",
        "avatar" => "avatars\Avatar19.png"
    ]
];
?>

<div class="container my-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold">Courses</h2>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php foreach ($courses as $course): ?>
            <div class="col">
                
                <div class="card h-100 border-1 shadow-sm rounded-4" style="border-color: #e0e0e0;">
                    
                    <img src="<?= $course['image'] ?>" class="card-img-top rounded-top-4" alt="<?= $course['title'] ?>" style="object-fit: cover; height: 250px;">
                    
                    <div class="card-body d-flex flex-column mt-2">
                        <h5 class="card-title fw-bold text-end mb-2"><?= $course['title'] ?></h5>
                        
                        <p class="card-text text-muted text-end small mb-4">
                            <?= $course['description'] ?>
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center text-muted small mb-3 pb-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock me-1" viewBox="0 0 16 16">
                                      <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                      <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                    </svg>
                                    <?= $course['duration'] ?>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <span class="me-2"><?= $course['instructor'] ?></span>
                                    <img src="<?= $course['avatar'] ?>" class="rounded-circle border" width="30" height="30" alt="Avatar">
                                </div>
                            </div>

                            <!-- Button that triggers the modal -->
                            <button type="button" class="btn btn-outline-warning w-100 fw-semibold rounded-3 py-2 text-dark" data-bs-toggle="modal" data-bs-target="#modal-<?= $course['id'] ?>">
                                Course details
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for this specific course -->
            <div class="modal fade" id="modal-<?= $course['id'] ?>" tabindex="-1" aria-labelledby="modalLabel-<?= $course['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-bottom-0 pb-0">
                            <h5 class="modal-title fw-bold fs-4" id="modalLabel-<?= $course['id'] ?>"><?= $course['title'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pt-4">
                            <div class="row g-4">
                                <!-- Image Section inside Modal -->
                                <div class="col-md-5">
                                    <img src="<?= $course['image'] ?>" class="img-fluid rounded-4 shadow-sm" alt="<?= $course['title'] ?>" style="object-fit: cover; width: 100%; height: auto;">
                                </div>
                                <!-- Text Details inside Modal -->
                                <div class="col-md-7">
                                    <h6 class="fw-bold text-muted mb-3">About this course</h6>
                                    <p class="mb-4"><?= $course['description'] ?></p>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="<?= $course['avatar'] ?>" class="rounded-circle border me-3" width="50" height="50" alt="Avatar">
                                        <div>
                                            <p class="mb-0 fw-bold">Instructor</p>
                                            <p class="mb-0 text-muted"><?= $course['instructor'] ?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-clock text-warning" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold">Duration</p>
                                            <p class="mb-0 text-muted"><?= $course['duration'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 pt-0">
                            <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        
    </div>
</div>

<?php

include_once "footer.php";

?>
