<?php
require_once 'model/master.php';

class TestimonialModel extends MasterModel {
  public function getFeaturedTestimonials(int $limit = 10): array {
    $stmt = $this->conn->prepare(
      "SELECT * FROM testimonials WHERE is_featured = 1 ORDER BY id ASC LIMIT :limit"
    );
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}