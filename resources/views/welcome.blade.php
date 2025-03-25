<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Spendiary</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('landingpage/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Spendiary</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#FAQ ">FAQ</a></li>
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Managing money is fun and easy with us</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">
                            Take control of your finances effortlessly! Track your expenses, set savings goals, and manage budgets—all in one simple and intuitive platform. Start your journey towards smarter financial decisions today!
                        </p>
                        <a class="btn btn-primary btn-xl" href="#about">Try it now!</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">Smart Finance, Simplified!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">
                            Our platform gives you everything you need to manage your expenses, track savings, and stay on top of your financial goals. No more spreadsheets—just a seamless, hassle-free experience to make money management effortless!
                        </p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">What We Offer</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-wallet2 fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Expense Tracking</h3>
                            <p class="text-muted mb-0">Easily log and categorize your expenses to stay on top of your finances.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-graph-up fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Budget Planning</h3>
                            <p class="text-muted mb-0">Set budgets and track your spending to achieve your financial goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-piggy-bank fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Savings Goals</h3>
                            <p class="text-muted mb-0">Plan and save for the future with personalized savings targets.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-bell fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Smart Alerts</h3>
                            <p class="text-muted mb-0">Get reminders and insights to help you make better financial decisions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/1.jpg')}}" title="Expense Tracking">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/1.jpg')}}" alt="Expense Tracking" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Expense Tracking</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/2.jpg')}}" title="Budget Planning">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/2.jpg')}}" alt="Budget Planning" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Budget Planning</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/3.jpg')}}" title="Savings Goals">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/3.jpg')}}" alt="Savings Goals" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Savings Goals</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/4.jpg')}}" title="Financial Reports">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/4.jpg')}}" alt="Financial Reports" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Financial Reports</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/5.jpg')}}" title="Smart Alerts">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/5.jpg')}}" alt="Smart Alerts" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Smart Alerts</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="{{asset('landingpage/assets/img/portfolio/fullsize/6.jpg')}}" title="Shared Expenses">
                            <img class="img-fluid" src="{{asset('landingpage/assets/img/portfolio/thumbnails/6.jpg')}}" alt="Shared Expenses" />
                            <div class="portfolio-box-caption p-3">
                                <div class="project-category text-white-50">Feature</div>
                                <div class="project-name">Shared Expenses</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Start Managing Your Finances Today!</h2>
                <p class="mb-4">Take control of your expenses, set savings goals, and achieve financial success—all in one place.</p>
                <a class="btn btn-light btn-xl" href="#signup">Get Started Now!</a>
            </div>
        </section>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Get in Touch with Us!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Have questions about managing your finances? Need support? Send us a message, and we'll get back to you as soon as possible!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form id="contactForm">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." required />
                                <label for="name">Full Name</label>
                                <div class="invalid-feedback">A name is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" required />
                                <label for="email">Email Address</label>
                                <div class="invalid-feedback">A valid email is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" required />
                                <label for="phone">Phone Number</label>
                                <div class="invalid-feedback">A phone number is required.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" placeholder="Enter your message here..." style="height: 10rem" required></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback">A message is required.</div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>+1 (555) 123-4567</div>
                        <div>Email: support@yourexpenseapp.com</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="page-section" id="FAQ">
            <div class="container px-4 px-lg-5">
                <div class="text-center">
                    <h2 class="mt-0">Frequently Asked Questions</h2>
                    <hr class="divider" />
                </div>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How does this expense management system work?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Our system helps you track expenses, set budgets, and save efficiently. You can categorize your expenses, generate reports, and achieve financial goals easily.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Is my financial data secure?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! We use the latest security protocols to ensure your data remains safe and confidential.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I use this app for shared expenses or group savings?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Absolutely! Our app supports group savings and shared expenses, making it easy to manage finances with family, friends, or colleagues.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Is there a mobile app available?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                We are currently working on a mobile version! Stay tuned for updates on our official website.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                How can I contact customer support?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can reach out to us via email at support@yourexpenseapp.com or call us at +1 (555) 123-4567.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2025 - Spendiary</div></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <script src="{{asset('landingpage/js/scripts.js')}}"></script>

    </body>
</html>
