<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/TourModel.php';
class Explore {
        public function index() {
            $tourModel = new TourModel();
            $suggestedTours = $tourModel->getFeaturedTours(6);
            $popularTours   = $tourModel->getRandomTours(4);

            require_once 'view/home/explore.php';
        }
    }
?>