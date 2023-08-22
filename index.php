<?php
//turn on php error handling        
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'generate-domains.php';
include_once 'check-domain-availability.php';

$generated_domains = [];

if(isset($_POST['submit'])){
    $domains = generateDomains();
    
    if(gettype($domains)!="array"){
        exit();
    }

    foreach($domains as $domain){
      $d = ['domain'=>$domain, 'status'=>isDomainAvailable($domain)==true? "Available": "Unavailable"];
      $generated_domains[] = $d;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>AI Domain Generator</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">AI Domain Generator</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div
          class="collapse navbar-collapse"
          id="navbarSupportedContent"
          style="justify-content: flex-end"
        >
          <a class="btn btn-outline-dark" target="_blank" href="https://github.com/oldravian/ai-domain-generator">
            <i class="bi bi-github"></i>
          </a>
        </div>
      </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
      <div
        class="container px-4 px-lg-5"
        style="padding-right: 9rem !important; padding-left: 9rem !important"
      >
        <div class="text-center text-white">
          <h1 class="display-4 fw-bolder">AI-Powered Domain Genius</h1>
          <p class="lead fw-normal text-white-50 mb-0">
            Turn Your Business Idea into a Digital Identity. Enter a Description
            and Let Our Intelligent System Find Your Perfect Domain Instantly.
          </p>
          <form method="POST" action="">
            <div class="form-group">
              <textarea
                class="form-control"
                id="description"
                name="description"
                rows="5"
                required
                placeholder="Enter a description of your business like 'software company focused on web development'"
              ></textarea>
            </div>
            <div style="text-align: right; margin-top: 10px">
              <input type="submit"
              name="submit"
                class="btn btn-outline-dark mt-auto"
                style="background-color: #fff"
                value="Generate"
                />
                
            </div>
          </form>
        </div>
      </div>
    </header>
    <!-- Section-->
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-2">
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
         <?php  foreach ($generated_domains as $domain) {
         ?> 
            <div class="col mb-5">
            <div class="card h-100">
              <!-- Domain details-->
              <div class="card-body p-4">
                <div class="d-flex justify-content-between">
                  <!-- Domain name and availability-->
                  <div>
                    <h5 class="fw-bolder">
                        <?php echo $domain['domain']; ?>
                    </h5>
                    <p>
                      <?php echo $domain['status']; ?>
                    </p>
                  </div>
                </div>
              </div>
              <!-- Domain actions-->
              <div
                class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex justify-content-end"
              >
                <a class="btn btn-outline-dark mt-auto <?php echo $domain['status']=="Unavailable"? 'disabled': '' ?>" target="_blank" href="https://www.godaddy.com/en-pk/domainsearch/find?checkAvail=1&domainToCheck=<?php echo $domain['domain']; ?>"
                  >Register Now</a
                >
              </div>
            </div>
            </div>
          <?php } ?>

        </div>

      </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark mt-5">
      <div class="container">
        <p class="m-0 text-center text-white">
          Copyright &copy; AI-Domain-Generator 2023
        </p>
      </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
