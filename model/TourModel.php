<?php
require_once __DIR__ . '/master.php';

class TourModel extends MasterModel {
  public function getFeaturedTours(int $limit = 4): array {
    $stmt = $this->conn->prepare("SELECT * FROM tours ORDER BY id ASC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getRandomTours(int $limit = 4): array {
    $sql = "SELECT id, image, title, departure_location, vehicle, departure_date, tour_code, duration, price
            FROM tours
            ORDER BY RAND()
            LIMIT :limit";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
  }
}