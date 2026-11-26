<?php
require_once 'model/master.php';

class DestinationModel extends MasterModel {
  public function getFeaturedDestinations(int $limit = 10): array {
    $stmt = $this->conn->prepare(
      "SELECT * FROM destinations WHERE is_featured = 1 ORDER BY id ASC LIMIT :limit"
    );
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>