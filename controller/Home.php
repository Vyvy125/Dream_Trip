<?php
require_once "config/db.php";
require_once "model/TourModel.php";
require_once "model/DestinationModel.php";
require_once "model/TestimonialModel.php";

class Home {
  public function index() {
    $tourModel = new TourModel();
    $featuredTours = $tourModel->getFeaturedTours(4);

    $destinationModel = new DestinationModel();
    $featuredDestinations = $destinationModel->getFeaturedDestinations(20);

    $testimonialModel = new TestimonialModel();
    $testimonials = $testimonialModel->getFeaturedTestimonials(10);

    require_once "view/home/index.php";
  }
}
?>