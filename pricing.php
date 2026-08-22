<?php
include "header.php";
?>

<!-- Pricing Section -->
<section class="py-5 bg-light">

    <div class="container">

        <!-- Header -->
        <div class="row align-items-center pb-4 border-bottom">

            <div class="col-lg-4">
                <h2 class="fw-bold mb-0">Our Pricings</h2>
            </div>

            <div class="col-lg-6 offset-lg-2">
                <p class="text-secondary small mb-0">
                    Choose the perfect plan for your learning journey with Course System.
                    Get access to high-quality courses, learning resources, instructor support,
                    and certificates to help you develop your skills and achieve your goals.
                </p>
            </div>

        </div>


        <!-- Monthly / Yearly -->
        <div class="text-center my-5">

            <div class="bg-white d-inline-flex p-1 rounded-2 shadow-sm">

                <button id="monthlyBtn" class="btn btn-warning text-white px-4">
                    Monthly
                </button>

                <button id="yearlyBtn" class="btn btn-light px-4">
                    Yearly
                </button>

            </div>

        </div>


        <!-- Pricing Cards Container -->
        <div class="bg-white rounded-3 p-4 p-lg-5">

            <div class="row g-4">


                <!-- FREE PLAN -->
                <div class="col-lg-6">

                    <div class="border rounded-3 p-3 h-100">

                        <!-- Plan -->
                        <div class="bg-light border rounded-2 text-center py-2 mb-3">
                            <span class="fw-medium">
                                Free Plan
                            </span>
                        </div>


                        <!-- Price -->
                        <div class="text-center my-4">

                            <span
                                class="display-5 fw-bold price"
                                data-monthly="$0"
                                data-yearly="$0">
                                $0
                            </span>

                            <small class="text-secondary period">
                                /month
                            </small>

                        </div>


                        <!-- Features Box -->
                        <div class="border rounded-3 p-4">

                            <h6 class="text-center fw-semibold mb-4">
                                Available Features
                            </h6>


                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Access to selected free courses.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Limited course materials and resources.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Basic community support.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                No certification upon completion.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Ad-supported platform.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small text-secondary">
                                <span class="me-2">✕</span>
                                Access to exclusive Pro Plan community forums.
                            </div>

                            <div class="border rounded-2 p-2 small text-secondary">
                                <span class="me-2">✕</span>
                                Early access to new courses and updates.
                            </div>

                        </div>


                        <!-- Button -->
                        <a href="register.php?plan=free"
                           class="btn btn-warning text-white w-100 mt-3 py-2">
                            Get Started
                        </a>

                    </div>

                </div>



                <!-- PRO PLAN -->
                <div class="col-lg-6">

                    <div class="border rounded-3 p-3 h-100">

                        <!-- Plan -->
                        <div class="bg-light border rounded-2 text-center py-2 mb-3">
                            <span class="fw-medium">
                                Pro Plan
                            </span>
                        </div>


                        <!-- Price -->
                        <div class="text-center my-4">

                            <span
                                class="display-5 fw-bold price"
                                data-monthly="$79"
                                data-yearly="$790">
                                $79
                            </span>

                            <small class="text-secondary period">
                                /month
                            </small>

                        </div>


                        <!-- Features Box -->
                        <div class="border rounded-3 p-4">

                            <h6 class="text-center fw-semibold mb-4">
                                Available Features
                            </h6>


                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Unlimited access to all courses.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Unlimited course materials and resources.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Priority support from instructors.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Course completion certificates.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Ad-free experience.
                            </div>

                            <div class="border rounded-2 p-2 mb-2 small">
                                <span class="me-2">✓</span>
                                Access to exclusive Pro Plan community forums.
                            </div>

                            <div class="border rounded-2 p-2 small">
                                <span class="me-2">✓</span>
                                Early access to new courses and updates.
                            </div>

                        </div>


                        <!-- Button -->
                        <a href="register.php?plan=pro"
                           class="btn btn-warning text-white w-100 mt-3 py-2">
                            Get Started
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Monthly / Yearly JavaScript -->
<script>

    const monthlyBtn = document.getElementById("monthlyBtn");
    const yearlyBtn = document.getElementById("yearlyBtn");

    const prices = document.querySelectorAll(".price");
    const periods = document.querySelectorAll(".period");


    // Monthly
    monthlyBtn.addEventListener("click", function () {

        prices.forEach(function(price) {
            price.textContent = price.dataset.monthly;
        });

        periods.forEach(function(period) {
            period.textContent = "/month";
        });


        monthlyBtn.classList.remove("btn-light");
        monthlyBtn.classList.add("btn-warning", "text-white");

        yearlyBtn.classList.remove("btn-warning", "text-white");
        yearlyBtn.classList.add("btn-light");

    });


    // Yearly
    yearlyBtn.addEventListener("click", function () {

        prices.forEach(function(price) {
            price.textContent = price.dataset.yearly;
        });

        periods.forEach(function(period) {
            period.textContent = "/year";
        });


        yearlyBtn.classList.remove("btn-light");
        yearlyBtn.classList.add("btn-warning", "text-white");

        monthlyBtn.classList.remove("btn-warning", "text-white");
        monthlyBtn.classList.add("btn-light");

    });

</script>


<?php
include "footer.php";
?>