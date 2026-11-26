<?php
require_once 'model/master.php';

class TourModel extends MasterModel {
  public function getFeaturedTours(int $limit = 4): array {
    $stmt = $this->conn->prepare("SELECT * FROM tours ORDER BY id ASC LIMIT :limit");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}